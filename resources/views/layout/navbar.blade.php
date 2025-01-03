<header>
    <div class="header-container">
        <div class="logo">
            <a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo"></a>
        </div>
        <form action="{{ url('/') }}" method="GET">
            <div class="search-bar">
                <select name="category" style="border-radius: 5px; padding: 8px; border: none; margin-right: 5px;">
                    <option value="">Semua Kategori</option>
                    @if(isset($categories) && $categories->count())
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                    @endif
                </select>
                <input type="text" name="query" placeholder="Cari produk..." value="{{ request('query') }}"
                    style="flex-grow: 1; padding: 8px; border: none; border-radius: 5px; margin-right: 5px;">
                <button type="submit"
                    style="padding: 0px; border: none; border-radius: 0px; background-color: #ffcc00;">
                    <img src="{{ asset('img/search.png') }}" alt="Search Icon" style="width: 30px; height: 30px;">
                </button>
            </div>
        </form>
        <div class="header-icons">
            <a href="{{ route('cart') }}"><img src="{{ asset('img/cart.png') }}" alt="Cart Icon" /></a>
            <a href="{{ route('messages') }}"><img src="{{ asset('img/chat.png') }}" alt="Chat Icon" /></a>
            <a href="{{ route('profile') }}"><img src="{{ asset('img/setting.png') }}" alt="Settings Icon" /></a>


            @auth
            <!-- Periksa jika pengguna memiliki peran admin atau owner -->
            <!-- Periksa kondisi peran -->
            @if(auth()->user()->role === 'owner')
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('img/inbox.png') }}" alt="Inbox Icon" /></a>
            <a href="{{ route('admin.manager') }}"><img src="{{ asset('img/manager.png') }}" alt="Manager Icon" /></a>
            @elseif(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('img/inbox.png') }}" alt="Inbox Icon" /></a>
            @endif
            @endauth
        </div>

        <div class="login">
            @auth
            <p>{{ auth()->user()->username }}!</p>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    style="background:none; border:none; color: #007bff; text-decoration: underline;">Logout</button>
            </form>
            @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">SignUp</a>
            @endauth
        </div>
    </div>
</header>