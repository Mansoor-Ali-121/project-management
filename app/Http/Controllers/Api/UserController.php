<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return response()->json([
            'success' => true,
            'message' => 'Users fetched successfully',
            'data'    => $users
        ], 200);
    }

    public function store(Request $request)
    {
        $user = $this->userService->registerUser($request);

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data'    => $user
        ], 201);
    }

    public function show(string $id)
    {
        $user = $this->userService->getUserById($id);

        return response()->json([
            'success' => true,
            'message' => 'User fetched successfully',
            'data'    => $user
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $this->userService->updateUser($request, $id);
        $updatedUser = $this->userService->getUserById($id);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data'    => $updatedUser
        ], 200);
    }

    public function destroy(string $id)
    {
        $this->userService->deleteUser($id);

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}
