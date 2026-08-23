<?php

namespace App\Http\Controllers;

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
        return view('projects.index', compact('projects'));
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
        $this->projectService->createProject($request->all());
        return redirect()->back()->with('success', 'Project successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Details bhi hum Modal mein dikhayenge, isliye iski zaroorat nahi
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Edit form bhi Modal mein aayega
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->projectService->updateProject($id, $request->all());
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
