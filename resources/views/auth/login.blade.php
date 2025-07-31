<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="{{ asset('desain/auth.css') }}" rel="stylesheet" />
    <style>
        .alert {
            background-color: #ffe6e6;
            color: #d8000c;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #f5c2c2;
            font-size: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Login</h2>

        {{-- Alert error tampil elegan di atas form --}}
        @if (session('error'))
            <div class="alert">
                email atau password salah.
            </div>
        @endif

        <form method="POST" action="{{ route('proseslogin') }}">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="bottom-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>

    <div class="footer">
         &copy; {{ date('Y') }} <strong>DESAKU</strong>. All rights reserved.
    </div>
</body>
</html>
