<main>
    <div class="content">
        <!-- PHP untuk menampilkan semua produk -->
        @foreach($products as $product)
        <div class="partner-item">
            <!-- Gunakan class .partner-item untuk setiap produk -->
            <a href="{{ route('product.show', $product->id) }}">
                <img src="{{ asset('img/' . $product->photo) }}" alt="{{ $product->name }}" class="product-img">
                <div class="content-text">
                    <h3>{{ $product->name }}</h3>
                    <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p>Rating Produk: {{ $product->rating ? number_format($product->rating, 1) : 'N/A' }} ⭐</p>
                    <p>Terjual: {{ $product->sales_count }}</p>

                    <!-- Nama toko -->
                    <p>Nama Toko: {{ $product->nama_toko ?? 'Tidak Diketahui' }}</p>

                    <!-- Rating toko -->
                    <p>Rating Toko: {{ $product->rating_toko ? number_format($product->rating_toko, 1) : 'N/A' }} ⭐</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</main>