@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <button class="back-button" onclick="window.location.hre='{{ route('index') }}'">Kembali</button>
        <h1>RIWAYAT RATING</h1>
    </div>
    <div class="content">
        @if ($transactions->isNotEmpty())
        @foreach ($transactions as $transaction)
        <div class="transaction">
            <img src="{{ asset('img/' . $transaction->photo) }}" alt="{{ $transaction->name }}"
                style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
            <p><strong>Nama Produk:</strong> {{ $transaction->name }}</p>
            <p><strong>Tanggal Transaksi:</strong>
                {{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y H:i') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $transaction->payment_method }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>

            <!-- Rating Produk -->
            @if (empty($transaction->product_rating))
            <form action="{{ route('rate.product') }}" method="POST">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">
                <input type="hidden" name="product_id" value="{{ $transaction->product_id }}">
                <label for="product_rating"><strong>Rating Produk:</strong></label>
                <select name="product_rating" required>
                    <option value="">Pilih Rating</option>
                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }} ⭐</option>
                        @endfor
                </select>
                <button type="submit">Kirim Rating Produk</button>
            </form>
            @else
            <p><strong>Rating Produk:</strong> {{ $transaction->product_rating }} ⭐</p>
            @endif

            <!-- Rating Toko -->
            @if (empty($transaction->store_rating))
            <form action="{{ route('rate.store') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">
                <input type="hidden" name="store_id" value="{{ $transaction->store_id }}">
                <label for="store_rating"><strong>Rating Toko:</strong></label>
                <select name="store_rating" required>
                    <option value="">Pilih Rating</option>
                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }} ⭐</option>
                        @endfor
                </select>
                <button type="submit">Kirim Rating Toko</button>
            </form>
            @else
            <p><strong>Rating Toko:</strong> {{ $transaction->store_rating }} ⭐</p>
            @endif
        </div>
        @endforeach
        @else
        <p>Belum ada riwayat transaksi.</p>
        @endif
    </div>
</div>
@endsection