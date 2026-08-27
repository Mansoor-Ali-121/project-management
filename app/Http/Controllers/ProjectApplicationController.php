<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ProjectApplication;
use App\Services\ApplicationService;
use Illuminate\Http\Request;

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
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Application ke sath project relation load karein (agar relation ka naam 'project' hai)
        $application = $this->applicationService->updateStatus($id, $request->status);

        if (!$application) {
            return back()->with('error', 'Application not found.');
        }

        // Project ka title nikal lete hain (check kar lein agar relation ka naam project ya kuch aur hai)
        $projectTitle = $application->project->title ?? 'the project';

        // Ab notification mein project ka naam bhi shamil hoga
        Notification::create([
            'user_id' => $application->user_id,
            'title'   => 'Application ' . ucfirst($request->status),
            'message' => 'Your application for "' . $projectTitle . '" has been ' . $request->status . '.',
            'is_read' => false,
        ]);

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
