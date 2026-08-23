<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $projectService;

    // Service ko inject kiya
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
        
        return response()->json([
            'success' => true,
            'message' => 'Projects retrieved successfully.',
            'data' => $projects
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = $this->projectService->createProject($request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Project created successfully.',
            'data' => $project
        ], 201); // 201 Created status code
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Note: Apni ProjectService mein ek chota sa function 'getProjectById' bana lein
        $project = $this->projectService->getProjectById($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Project retrieved successfully.',
            'data' => $project
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = $this->projectService->updateProject($id, $request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully.',
            'data' => $project
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->projectService->deleteProject($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully.'
        ], 200);
    }
}