<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESAKU - @yield('title')</title>
    <link href="{{ asset('desain/dashboard.css') }}" rel="stylesheet" />
</head>

<body>

    <nav class="topnav">
        <div class="brand"><a href="{{ url('/dashboard') }}">DESAKU</a></div>

        <div class="search-global">
            <form action="{{ url()->current() }}" method="GET" class="search-form">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul atau kategori..." class="search-input">
                <button type="submit" class="search-btn">Cari</button>
            </form>
        </div>
    </nav>

    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-header">Menu</div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}">🏠 Dashboard</a></li>
                <li><a href="{{ route('konten.index') }}">📁 Konten</a></li>
                <li><a href="{{ route('kategori.index') }}">📂 Kategori</a></li>
            </ul>
            <div class="info-box">
                <p class="user-name">👤 {{ Auth::user()->name }}</p>
                <p class="user-email">{{ maskEmail(Auth::user()->email) }}</p>
            </div>

            @php
                function maskEmail($email)
                {
                    [$name, $domain] = explode('@', $email);
                    $maskedName = substr($name, 0, 2) . str_repeat('*', max(strlen($name) - 2, 3));
                    return $maskedName . '@' . $domain;
                }
            @endphp
            <div class="nav-right mt-4">
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <h1 class="page-title">@yield('title')</h1>
            @yield('content')
        </main>
    </div>

    <footer class="footer">
        &copy; {{ date('Y') }} <strong>DESAKU</strong>. All rights reserved.
    </footer>
</body>

</html>
