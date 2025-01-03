<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle the login attempt.
     */
    public function store(Request $request)
    {
        // Validate the incoming request for email and password
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        
        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Regenerate session after successful login
            $request->session()->regenerate();

            // Redirect to the intended page or default to /dashboard
            return redirect()->intended('/');
        }

        // If authentication fails, throw validation exception
        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle the user logout.
     */
    public function destroy(Request $request)
    {
        // Logout the user and invalidate the session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the homepage
        return redirect('/');
    }
    /**
     * Show the login form.
     */
    public function create()
{
    return view('auth.login');
}
}