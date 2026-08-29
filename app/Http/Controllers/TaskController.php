<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function show(Request $request)
    {
        $user = Auth::user();
        $query = Task::with(['project', 'assignee']);

        // Agar user admin ya project manager nahi hai, toh sirf usay assigned tasks dikhao
        if ($user->role !== 'admin' && $user->role !== 'project_manager' && !$user->is_admin) {
            // Yahan 'assignee_id' ki jagah 'assigned_to' likhein jo aapke Model mein hai
            $query->where('assigned_to', $user->id);
        }

        // Search by title filter
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tasks = $query->paginate(10);

        return view('dashboard.tasks.show', compact('tasks'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:todo,in_progress,completed',
        ]);

        $task = Task::findOrFail($id);

        $task->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
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
