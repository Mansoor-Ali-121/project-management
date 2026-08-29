<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sirf current logged-in user (chahe student ho ya admin) ki apni notifications nikalein
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard.notifications.index', compact('notifications'));
    }

    // Delete all notification 
    public function markAllRead()
    {
        // Current logged-in user (admin ya student) ki sari notifications delete kar dein
        Notification::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'All notifications cleared successfully.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
