<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index()
    {
        $activeProjectsCount = Project::count();
        $pendingTasksCount = Task::where('status', '!=', 'completed')->count();
        $recentTasks = Task::with('project')->latest()->take(3)->get();

        // System Metrics Environment Data
        $environment = strtoupper(app()->environment());

        // Real-Time API Endpoints Count / Status
        $totalRoutes = count(Route::getRoutes()->getRoutes());
        $apiStatus = $totalRoutes > 0 ? 'ONLINE (' . $totalRoutes . ')' : 'OPTIMIZED';

        // Monthly Workflow Analytics Data (Jan to Jun 2026)
        $monthlyData = [];
        for ($m = 1; $m <= 6; $m++) {
            $count = Task::whereYear('created_at', 2026)
                ->whereMonth('created_at', $m)
                ->count();
            $monthlyData[$m] = $count;
        }
        
        $maxCount = max(array_sum($monthlyData) > 0 ? $monthlyData : [1]) ?: 1;
        $chartHeights = [];
        foreach ($monthlyData as $month => $count) {
            $chartHeights[$month] = max(20, min(100, ($count / $maxCount) * 100));
        }

        return view('maindashboard', compact(
            'activeProjectsCount', 
            'pendingTasksCount', 
            'recentTasks', 
            'environment', 
            'apiStatus',
            'chartHeights'
        ));
    }

    public function clearCache()
    {
        // Real-time server cache clearing commands
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return redirect()->back()->with('success', 'Application cache cleared successfully!');
    }
}