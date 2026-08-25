<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAllTasks()
    {
        return Task::with(['project', 'assignee'])->paginate(10);
    }

    public function createTask(array $data)
    {
        return Task::create([
            'project_id' => $data['project_id'],
            'assigned_to' => $data['assigned_to'],
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? 'todo',
            'deadline' => $data['deadline'],
        ]);
    }

    public function updateTask(Task $task, array $data)
    {
        $task->update([
            'project_id' => $data['project_id'] ?? $task->project_id,
            'assigned_to' => $data['assigned_to'] ?? $task->assigned_to,
            'title' => $data['title'] ?? $task->title,
            'description' => $data['description'] ?? $task->description,
            'status' => $data['status'] ?? $task->status,
            'deadline' => $data['deadline'] ?? $task->deadline,
        ]);

        return $task;
    }

    public function deleteTask(Task $task)
    {
        return $task->delete();
    }
}
