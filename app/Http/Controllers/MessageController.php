<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan pesan, bisa ambil data dari database atau API
        return view('messages.index');
    }
}