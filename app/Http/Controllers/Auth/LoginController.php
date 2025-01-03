<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect based on role
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } 
            elseif (auth()->user()->role === 'user') {
                return redirect()->route('index');
            }
            elseif (auth()->user()->role === 'owner') {
                return redirect()->route('owner.dashboard');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}