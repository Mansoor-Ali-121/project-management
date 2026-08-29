<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProjectService
{
    public function getAllProjects()
    {
        return Project::latest()->get();
    }

    public function getProjectById($id)
    {
        return Project::findOrFail($id);
    }

    public function createProject(array $data)
    {
        // 1. Validation Logic Yahin Likh Diya
        $validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'status' => 'required|in:approved,reject,completed',
            'deadline' => 'required|date',
        ]);

        // 2. Agar validation fail ho jaye toh exception throw karein
        // Laravel isko khud handle kar ke API ko JSON aur Web ko Redirect bhej dega
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // 3. Agar sab theek hai toh save kar dein
        return Project::create($validator->validated());
    }

    public function updateProject($id, array $data)
    {
        $project = Project::findOrFail($id);

        $validator = Validator::make($data, [
            'user_id' => 'sometimes|exists:users,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'category' => 'sometimes|required|string|max:100',
            'location' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:pending,approved,rejected,completed',
            'deadline' => 'sometimes|required|date',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $project->update($validator->validated());
        return $project;
    }

    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);
        return $project->delete();
    }
}
