<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Models\Project;
use App\Models\User;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        // Sirf woh projects fetch karein jinka status 'Approved' ho
        $projects = Project::where('status', 'approved')->get();
        $volunteers = User::all();   // Ya approved volunteers ki query

        return view('dashboard.tasks.add', compact('projects', 'volunteers'));
    }

    public function show()
    {
        $tasks = $this->taskService->getAllTasks();
        return view('dashboard.tasks.show', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::all();
        $volunteers = User::whereHas('applications', function ($q) {
            $q->where('status', 'Approved');
        })->get();

        return view('dashboard.tasks.create', compact('projects', 'volunteers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        $this->taskService->createTask($request->all());

        return redirect()->route('tasks.show')->with('success', 'Task successfully assigned!');
    }
}
