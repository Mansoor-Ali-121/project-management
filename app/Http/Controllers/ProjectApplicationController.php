<?php

namespace App\Http\Controllers;

use App\Events\NewNotificationEvent;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectApplication;
use App\Models\User;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * Display a listing of the resource (Manager view for Applications Approval)
     */
    public function index(Request $request)
    {
        $applications = ProjectApplication::with(['project', 'user'])->paginate(10);

        // Saari applications ki list yahan show hogi
        return view('dashboard.applications.show', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage (Student applies for a project)
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $result = $this->applicationService->applyForProject($request->all());

        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }

        // --- YAHAN NOTIFICATION OR BROADCAST KA CODE ADD KAREIN ---
        // 1. Project ki details nikal lein (agar result mein project ya application object aa raha hai)
        $project = Project::find($request->project_id);
        $projectTitle = $project->title ?? 'the project';
        $studentName = Auth::user()->name;

        // 2. Sabhi admins aur project managers ko find karein
        $adminsAndManagers = \App\Models\User::whereIn('role', ['admin', 'project_manager'])->get();

        // 3. Har ek ko notification bhejein aur live broadcast karein
        foreach ($adminsAndManagers as $admin) {
            $notification = Notification::create([
                'user_id' => $admin->id,
                'title'   => 'New Project Application',
                'message' => $studentName . ' has applied for the project "' . $projectTitle . '".',
                'is_read' => false,
            ]);

            // Reverb live broadcast
            broadcast(new NewNotificationEvent($notification));
        }
        // -----------------------------------------------------------

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $query = ProjectApplication::with(['project', 'user']);

        // Agar search kiya gaya ho (Project Title ke mutabiq)
        if ($request->filled('search')) {
            $query->whereHas('project', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        // Agar status filter select kiya gaya ho
        if ($request->filled('status') && $request->status !== 'All Status') {
            $query->where('status', $request->status);
        }

        $applications = $query->paginate(10);

        return view('dashboard.applications.show', compact('applications'));
    }

    public function activeVolunteers()
    {
        $applications = ProjectApplication::with(['project', 'user'])
            ->where('status', 'approved')
            ->get();

        return view('dashboard.applications.active', compact('applications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage (Approve or Reject application)
     */
    // Ensure this is imported at the top of your controller

    public function update(Request $request, string $id)
    {
        $application = ProjectApplication::find($id);

        if (!$application) {
            return back()->with('error', 'Application not found.');
        }

        // 1. Status update karne ki aapki jo bhi logic hai (e.g., update status)
        $application->update([
            'status' => $request->status,
        ]);

        $projectTitle = $application->project->title ?? 'the project';

        // 2. Sirf aur sirf us student ko notification bheji jaye gi jisne apply kiya tha
        $notification = Notification::create([
            'user_id' => $application->user_id, // Yeh student ki ID hai (Admin ki nahi)
            'title'   => 'Application ' . ucfirst($request->status),
            'message' => 'Your application for "' . $projectTitle . '" has been ' . $request->status . '.',
            'is_read' => false,
        ]);

        // 3. Student ke live private channel par broadcast karein
        broadcast(new NewNotificationEvent($notification));

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $application = ProjectApplication::find($id);
        if ($application) {
            $application->delete();
        }

        return redirect()->back()->with('success', 'Application deleted successfully.');
    }
}
