<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductRating;
use App\Models\StoreRating;

class TransactionController extends Controller
{
    public function index()
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            $user_id = Auth::id();

            // Ambil riwayat transaksi pengguna
            $transactions = Transaction::where('user_id', $user_id)
                ->join('transaction_items', 'transactions.id', '=', 'transaction_items.transaction_id')
                ->join('products', 'transaction_items.product_id', '=', 'products.id')
                ->join('users', 'products.user_id', '=', 'users.id')
                ->leftJoin('product_ratings', 'product_ratings.transaction_id', '=', 'transactions.id')
                ->leftJoin('store_ratings', 'store_ratings.transaction_id', '=', 'transactions.id')
                ->select(
                    'transactions.id AS transaction_id',
                    'transactions.total_price',
                    'transactions.payment_method',
                    'transactions.created_at',
                    'products.id AS product_id',
                    'products.photo',
                    'products.name',
                    'users.id AS store_id',
                    'users.store_name',
                    'product_ratings.rating AS product_rating',
                    'store_ratings.rating AS store_rating'
                )
                ->orderBy('transactions.created_at', 'desc')
                ->get();

            return view('transactions.index', compact('transactions'));
        } else {
            return redirect()->route('login');
        }
    }
    public function rateProduct(Request $request)
{
    // Simpan rating produk
    $request->validate([
        'product_rating' => 'required|integer|between:1,5',
    ]);

    ProductRating::create([
        'transaction_id' => $request->transaction_id,
        'product_id' => $request->product_id,
        'rating' => $request->product_rating,
    ]);

    return redirect()->route('transactions');
}

public function rateStore(Request $request)
{
    // Simpan rating toko
    $request->validate([
        'store_rating' => 'required|integer|between:1,5',
    ]);

    StoreRating::create([
        'transaction_id' => $request->transaction_id,
        'store_id' => $request->store_id,
        'rating' => $request->store_rating,
    ]);

    return redirect()->route('transactions');
}

}