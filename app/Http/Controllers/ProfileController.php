<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman profil pengguna
        return view('profile.index'); // Pastikan Anda memiliki view profile/index.blade.php
    }
}