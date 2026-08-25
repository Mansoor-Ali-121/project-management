<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $projectService;

    // 1. Constructor ke zariye service inject ki
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->projectService->getAllProjects();
        return view('dashboard.projects.add', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hum form Modal mein dikhayenge, isliye iski zaroorat nahi
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Project create kar ke variable mein save karein
        $project = $this->projectService->createProject($request->all());

        // Ab JSON response return karein jo fetch API easily read kar le
        return response()->json([
            'success' => true,
            'message' => 'Project created successfully.',
            'data' => $project
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $query = Project::query();

        // Agar user Student hai (admin ya project manager nahi hai), toh sirf Approved projects dikhao
        if (auth()->check() && !(auth()->user()->role === 'admin' || auth()->user()->role === 'project_manager' || auth()->user()->is_admin)) {
            $query->where('status', 'Approved');
        }

        // Baaki aapki filtering logic (Search, Category waghera)
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', 'like', '%' . $request->category . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Status filter agar student ke ilawa koi aur use kar raha ho
        if ($request->filled('status') && auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'project_manager' || auth()->user()->is_admin)) {
            $query->where('status', $request->status);
        }

        $projects = $query->paginate(10);

        return view('dashboard.projects.show', compact('projects'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = $this->projectService->getProjectById($id);
        return view('dashboard.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->projectService->updateProject($id, $request->all());

        // Check karein ke request AJAX hai ya nahi
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Project successfully updated!'
            ]);
        }

        return redirect()->back()->with('success', 'Project successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->projectService->deleteProject($id);
        return redirect()->back()->with('success', 'Project successfully deleted!');
    }
}
