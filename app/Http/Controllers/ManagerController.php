<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang sudah login yang bisa mengakses
    }

    public function index()
    {
        // Pastikan user memiliki role owner
        if(auth()->user()->role !== 'owner'){
            return redirect()->route('dashboard.index');
        }

        $users = User::all(); // Ambil semua data user
        return view('manager.index', compact('users'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin,owner',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('manager.index')->with('success', 'User berhasil dibuat!');
    }

    public function updateUserRole(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|in:user,admin,owner',
        ]);

        $user = User::findOrFail($userId);
        $user->update([
            'role' => $request->role
        ]);

        return redirect()->route('manager.index')->with('success', 'Role user berhasil diperbarui!');
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);

        // Prevent user from deleting their own account
        if ($user->id === auth()->id()) {
            return redirect()->route('manager.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $user->delete(); // Hapus user
        return redirect()->route('manager.index')->with('success', 'User berhasil dihapus!');
    }
}