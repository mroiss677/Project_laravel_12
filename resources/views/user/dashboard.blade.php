{{-- resources/views/user/dashboard.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'User Dashboard')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4">Selamat Datang, {{ Auth::user()->name }}</h2>
            <p>Ini adalah halaman <strong>User Dashboard</strong>.</p>

            <div class="mt-3">
                <a href="{{ route('konten.index') }}" class="btn btn-primary">
                    Kelola Konten Saya
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
