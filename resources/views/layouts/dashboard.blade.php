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
    </nav>

    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-header">Menu</div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}">🏠 Dashboard</a></li>
                <li><a href="{{ route('konten.index') }}">📁 Konten</a></li>
                <li><a href="{{ route('kategori.index') }}">📂 Kategori</a></li>
            </ul>
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
