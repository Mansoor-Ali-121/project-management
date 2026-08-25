<?php

namespace App\Services;

use App\Models\ProjectApplication;
use App\Models\Project;

class ApplicationService
{
    public function getFilteredProjects($request)
    {
        $query = Project::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('location') && $request->location != '') {
            $query->where('location', $request->location);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        return $query->paginate(5);
    }

    public function applyForProject($data)
    {
        // Check for duplicate application
        $existing = ProjectApplication::where('project_id', $data['project_id'])
            ->where('user_id', $data['user_id'])
            ->first();

        if ($existing) {
            return ['success' => false, 'message' => 'You have already applied for this project.'];
        }

        $application = ProjectApplication::create([
            'project_id' => $data['project_id'],
            'user_id' => $data['user_id'],
            'status' => 'pending',
        ]);

        return ['success' => true, 'data' => $application];
    }

    public function updateStatus($id, $status)
    {
        $application = ProjectApplication::find($id);
        if (!$application) {
            return null;
        }

        $application->update(['status' => $status]);
        return $application;
    }
}