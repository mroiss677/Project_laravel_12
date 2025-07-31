@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    <style>
        .form-container {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', sans-serif;
        }

        .form-container h2 {
            text-align: center;
            font-size: 28px;
            color: #2d3436;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .info-box {
            background-color: #f1f2f6;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }

        .info-box p {
            font-size: 18px;
            margin: 10px 0;
            color: #2f3542;
        }

        .label {
            font-weight: bold;
            color: #57606f;
        }

          table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

     thead {
        background-color: #F3F4F6;
        text-transform: uppercase;
        color: #555;
    }

    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    tr:hover {
        background-color: #FAFAFA;
    }
    </style>

    <div class="form-container">
        <h2>Selamat Datang di Dashboard</h2>
        <p style="text-align: center;">Ini adalah halaman utama setelah login.</p>
         <table class="table">
        <thead>
            <tr>
                <th>no</th>
                <th>Judul</th>
                <th>isi</th>
                <th>Kategori</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kontens as $index => $konten)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $konten->judul }}</td>
                    <td>{{ $konten->isi }}</td>
                    <td>{{ $konten->kategori->nama }}</td>
                    <td>
                        @if($konten->gambar)
                            <img src="{{ asset('storage/' . $konten->gambar) }}" width="80">
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; color: #999;">Belum ada konten.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
        <div class="info-box">
    <p><span class="label">Nama Pengguna:</span> {{ Auth::user()->name }}</p>

    @php
        $email = Auth::user()->email;
        $emailParts = explode('@', $email);
        $usernamePart = $emailParts[0];
        $domainPart = $emailParts[1];
        
        $emailMasked = substr($usernamePart, 0, 1)
                     . str_repeat('**', max(strlen($usernamePart) - 2, 1))
                     . substr($usernamePart, -1)
                     . '@' . $domainPart;
    @endphp

    <p><span class="label">Email:</span> {{ $emailMasked }}</p>
    <p><span class="label">Password:</span> {{ str_repeat('•', 10) }}</p>
</div>

    </div>
@endsection
