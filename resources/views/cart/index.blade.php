@extends('layouts.app')

@section('content')
<div class="header">
    <div class="header-container">
        <div class="logo">
            <a href="{{ route('index') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo"></a>
        </div>
        <div class="header-icons">
            <a href="{{ route('cart') }}"><img src="{{ asset('img/cart.png') }}" alt="Cart Icon" /></a>
            <a href="messages.php"><img src="{{ asset('img/chat.png') }}" alt="Chat Icon" /></a>
            <a href="profile.php"><img src="{{ asset('img/setting.png') }}" alt="Settings Icon" /></a>
            @if (Auth::check())
            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'owner')
            <a href="admin/dashboard.php"><img src="{{ asset('img/inbox.png') }}" alt="Inbox Icon" /></a>
            @endif

            @if (Auth::user()->role === 'owner')
            <a href="admin/manager.php"><img src="{{ asset('img/manager.png') }}" alt="Manager Icon" /></a>
            @endif
            @endif
        </div>
        <div class="payment-section">
            <a href="{{ route('checkout') }}" class="pay-now-header">Bayar Sekarang</a>
        </div>
        <div class="login">
            @if (Auth::check())
            <p>{{ Auth::user()->username }}!</p>
            <a href="{{ route('logout') }}">Logout</a>
            @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">SignUp</a>
            @endif
        </div>
    </div>
    <h1>KERANJANG</h1>
</div>

<div class="container">
    <div class="content">
        @if ($cartItems->isNotEmpty())
        @foreach ($cartItems as $item)
        <div class="cart-item">
            <img src="{{ asset('img/' . $item->photo) }}" alt="{{ $item->name }}">
            <div class="item-info">
                <h2>{{ $item->name }}</h2>
                <p>Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                <p><strong>Stok:</strong> {{ $item->stock }} unit</p>
            </div>
            <div class="actions">
                <form method="POST" action="{{ route('update.cart') }}">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                    <div class="quantity">
                        <button name="action" value="decrease">-</button>
                        <span>{{ $item->quantity }}</span>
                        <button name="action" value="increase">+</button>
                    </div>

                    <!-- Condiments radio buttons -->
                    <div class="condiments">
                        <label>
                            <input type="radio" name="condiments" value="sambal"
                                {{ strpos($item->condiments, 'sambal') !== false ? 'checked' : '' }}>
                            Sambal
                        </label>
                        <label>
                            <input type="radio" name="condiments" value="bawang"
                                {{ strpos($item->condiments, 'bawang') !== false ? 'checked' : '' }}>
                            Sayuran
                        </label>
                        <label>
                            <input type="radio" name="condiments" value="lauk"
                                {{ strpos($item->condiments, 'lauk') !== false ? 'checked' : '' }}>
                            Lauk Lainnya
                        </label>
                    </div>
                </form>
                <form method="POST" action="{{ route('delete.cart') }}">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                    <button type="submit" class="delete-button">HAPUS</button>
                </form>
            </div>
        </div>
        @endforeach
        @else
        <p>Keranjang Anda kosong.</p>
        @endif
    </div>
</div>
@endsection