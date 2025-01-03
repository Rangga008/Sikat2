<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang sudah login yang bisa mengakses
    }

    public function index()
    {
        $user = auth()->user(); // Ambil data user yang sedang login
        $products = Product::where('user_id', $user->id) // Ambil produk yang dimiliki oleh user
                            ->with('category') // Mengambil relasi kategori
                            ->orderByDesc('sales_count') // Urutkan berdasarkan jumlah penjualan
                            ->get();

        return view('dashboard.index', compact('user', 'products'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'username' => 'required|string|max:255',
            'nama_toko' => 'required|string|max:255',
            'kontak' => 'required|string',
            'email' => 'required|email',
        ]);

        // Update profil user
        $user->update([
            'username' => $request->username,
            'nama_toko' => $request->nama_toko,
            'kontak' => $request->kontak,
            'email' => $request->email,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Profil berhasil diperbarui!');
    }
}