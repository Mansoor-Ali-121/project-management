<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return response()->json([
            'status' => true,
            'data' => $tasks
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        $task = $this->taskService->createTask($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Task created successfully!',
            'data' => $task
        ], 201);
    }

    public function update(Request $request, Task $task)
    {
        $updatedTask = $this->taskService->updateTask($task, $request->all());

        return response()->json([
            'status' => true,
            'message' => 'Task updated successfully!',
            'data' => $updatedTask
        ]);
    }

    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);

        return response()->json([
            'status' => true,
            'message' => 'Task deleted successfully!'
        ]);
    }
}
