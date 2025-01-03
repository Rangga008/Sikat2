<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        // Ambil data produk berdasarkan ID
        $product = Product::with('user')->findOrFail($id);
        return view('product.show', compact('product'));
    }
}