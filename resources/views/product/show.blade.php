<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $product->name }} - Detail Produk</title>
    <link rel="stylesheet" href="{{ asset('css/stylecontent.css') }}" />
</head>

<body>
    @include('layout.navbar')
    <!-- Menyertakan navbar -->

    <div class="product-detail">
        <img src="{{ asset('img/' . $product->photo) }}" alt="{{ $product->name }}" class="product-img">
        <div class="product-info">
            <h2>{{ $product->name }}</h2>
            <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p>Rating Produk: {{ $product->rating ? number_format($product->rating, 1) : 'N/A' }} ⭐</p>
            <p>Terjual: {{ $product->sales_count }}</p>
            <p>Nama Toko: {{ $product->user->nama_toko ?? 'Tidak Diketahui' }}</p>
            <p>Rating Toko: {{ $product->user->rating_toko ? number_format($product->user->rating_toko, 1) : 'N/A' }} ⭐
            </p>
        </div>
    </div>

    @include('layout.footer')
    <!-- Footer -->
</body>

</html>