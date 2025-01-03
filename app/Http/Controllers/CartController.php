<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // Mengecek apakah pengguna sudah login
        if (Auth::check()) {
            $user_id = Auth::id();  // Mendapatkan ID pengguna yang sedang login

            // Mengambil data keranjang berdasarkan user_id
            $cartItems = Cart::where('user_id', $user_id)
                             ->join('products', 'cart.product_id', '=', 'products.id')
                             ->select('cart.id AS cart_id', 'products.id AS product_id', 'products.name', 'products.photo', 'products.price', 'products.stock', 'cart.quantity', 'cart.condiments')
                             ->get();

            return view('cart.index', compact('cartItems'));
        } else {
            return redirect()->route('login');
        }
    }
    public function update(Request $request)
{
    $cart = Cart::findOrFail($request->cart_id);
    if ($request->action == 'increase') {
        $cart->quantity++;
    } elseif ($request->action == 'decrease' && $cart->quantity > 1) {
        $cart->quantity--;
    }
    $cart->condiments = $request->condiments;
    $cart->save();

    return redirect()->route('cart');
}

public function delete(Request $request)
{
    Cart::findOrFail($request->cart_id)->delete();
    return redirect()->route('cart');
}
}