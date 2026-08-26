<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ImpactReportController extends Controller
{
    public function index()
    {
        // Real counts from database
        $totalProjects = Project::count();
        $activeVolunteers = User::where('status', 'active')->count(); // agar status column hai, warna sirf Volunteer::count()
        $completedTasks = Task::where('status', 'completed')->count();
        $systemUsers = User::count();

        return view('dashboard.impact-reports.index', compact(
            'totalProjects',
            'activeVolunteers',
            'completedTasks',
            'systemUsers'
        ));
    }

    
}
