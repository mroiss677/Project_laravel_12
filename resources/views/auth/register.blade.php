<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Register</title>
    <link href="{{ asset('desain/auth.css') }}" rel="stylesheet"/>
</head>
<body>
    <div class="register-box">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input class="form-control" name="name" type="text" placeholder="Nama Lengkap" required>
            <input class="form-control" name="username" type="text" placeholder="Username" required>
            <input class="form-control" name="email" type="email" placeholder="Email" required>

            <input class="form-control" name="password" type="password" placeholder="Password" required>
            <input class="form-control" name="password_confirmation" type="password" placeholder="Konfirmasi Password" required>

            <button type="submit" class="btn-register">Create Account</button>
        </form>

        <div class="bottom-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} <strong>DESAKU</strong>. All rights reserved.
    </div>
</body>
</html>
