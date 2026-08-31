<?php

namespace App\Http\Middleware;

IncomingRequest;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check karein user login hai ya nahi
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Agar user ka role allowed roles mein match karta hai
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Agar access na ho toh unauthorized ya home par redirect kar dein
        abort(403, 'Unauthorized access.');
    }
}
