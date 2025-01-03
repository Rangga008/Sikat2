<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori dari database
        $categories = DB::table('categories')->get();

        // Ambil produk berdasarkan kategori dan pencarian
        $query = DB::table('produk')
                    ->join('users', 'produk.user_id', '=', 'users.id')
                    ->select('produk.id', 'produk.name', 'produk.photo', 'produk.price', 'produk.sales_count', 'produk.rating', 'users.nama_toko', 'users.rating_toko')
                    ->orderByDesc('produk.sales_count')
                    ->limit(3);

        if ($request->has('category') && $request->category != '') {
            $query->where('produk.category_id', $request->category);
        }

        if ($request->has('query') && $request->query != '') {
            $query->where('produk.name', 'like', '%' . $request->query . '%');
        }

        $products = $query->get();

        return view('index', compact('categories', 'products'));
    }
}