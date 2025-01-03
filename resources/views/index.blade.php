@extends('layouts.app')
<!-- Menggunakan layout app.blade.php -->

@section('content')
<div class="carousel">
    @foreach(['1.png', '2.png', '3.png'] as $image)
    <img src="{{ asset('img/' . $image) }}" alt="Food {{ $loop->iteration }}" />
    @endforeach
</div>

<main>
    <div class="content">
        <!-- Menampilkan produk terlaris -->
        @forelse($products as $product)
        <div class="partner-item">
            <a href="{{ route('product.show', $product->id) }}">
                <img src="{{ asset('img/' . $product->photo) }}" alt="{{ $product->name }}" class="product-img">
                <div class="content-text">
                    <h3>{{ $product->name }}</h3>
                    <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p>Rating Produk: {{ $product->rating ? number_format($product->rating, 1) : 'N/A' }} ⭐</p>
                    <p>Terjual: {{ $product->sales_count }}</p>
                    <p>Nama Toko: {{ $product->nama_toko ?? 'Tidak Diketahui' }}</p>
                    <p>Rating Toko: {{ $product->rating_toko ? number_format($product->rating_toko, 1) : 'N/A' }} ⭐</p>
                </div>
            </a>
        </div>
        @empty
        <p>No products found.</p>
        @endforelse
    </div>
</main>
@endsection