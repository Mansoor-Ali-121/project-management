<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource (e.g., all users table blade).
     */
    public function index()
    {
        // Yahan users ki list wala blade aayega
        // $users = $this->userService->getAllUsers();
        return view('dashboard.auth.register'); // ya users.index blade
    }

    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }
    /**
     * Show the form for creating a new resource (Create blade).
     */
    public function create()
    {
        // return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage (Using Service).
     */
    public function store(Request $request)
    {
        try {
            $this->userService->registerUser($request);

            // Agar request AJAX/Fetch ki hai toh JSON return karo
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Account created successfully!'
                ], 201);
            }

            // Agar normal request hai toh redirect karo
            return redirect()->route('login')->with('success', 'Account created successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 400);
            }

            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // show profile 
    // show profile
    public function profile()
    {
        $user = Auth::user(); // Currently logged-in user
        return view('dashboard.auth.profile', compact('user'));
    }


    /**
     * Display the specified resource (Single user view blade).
     */
    public function show(string $id)
    {
        // $user = $this->userService->getUserById($id);
        // return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource (Edit blade).
     */
    public function edit(string $id)
    {
        // $user = $this->userService->getUserById($id);
        // return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage (Using Service).
     */
    public function update(Request $request, string $id)
    {
        try {
            // $this->userService->updateUser($request, $id);
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage (Using Service).
     */
    public function destroy(string $id)
    {
        try {
            // $this->userService->deleteUser($id);
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
