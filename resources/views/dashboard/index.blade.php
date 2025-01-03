<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <h2>Profil</h2>
    <form action="{{ route('dashboard.updateProfile') }}" method="POST">
        @csrf
        <div>
            <label for="username">Nama:</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" required>
        </div>
        <div>
            <label for="nama_toko">Nama Toko:</label>
            <input type="text" name="nama_toko" value="{{ old('nama_toko', $user->nama_toko) }}" required>
        </div>
        <div>
            <label for="kontak">Kontak:</label>
            <input type="text" name="kontak" value="{{ old('kontak', $user->kontak) }}" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <button type="submit">Update Profil</button>
    </form>

    <h2>Produk</h2>
    <ul>
        @foreach ($products as $product)
        <li>{{ $product->name }} - {{ $product->category->name }} - Rp.
            {{ number_format($product->price, 0, ',', '.') }}</li>
        @endforeach
    </ul>
</div>
@endsection