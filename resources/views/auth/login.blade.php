@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-box">
        <a href="{{ url('/') }}" class="close-button">&times;</a>
        <h2>LOGIN</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-button">LOGIN</button>
        </form>

        <p>Don't have an Account? <a href="{{ route('register') }}">SignUp</a></p>
    </div>
</div>
@endsection