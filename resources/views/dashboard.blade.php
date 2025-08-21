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
            vertical-align: top;
        }

        tr:hover {
            background-color: #FAFAFA;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .pagination svg {
            width: 20px;
            height: 20px;
        }

        .pagination .hidden {
            display: none;
        }
    </style>

    <div class="form-container">
        <h2>Selamat Datang di Dashboard</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kontens as $index => $konten)
                    <tr>
                        {{-- nomor urut tetap sesuai pagination --}}
                        <td>{{ $kontens->firstItem() + $index }}</td>
                        <td>{{ $konten->judul }}</td>
                        <td>{{ $konten->isi }}</td>
                        <td>{{ $konten->kategori->nama }}</td>
                        <td>
                            @if($konten->gambar)
                                <img src="{{ asset('storage/' . $konten->gambar) }}" width="80">
                            @else
                                <span style="color:#999;">-</span>
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

        {{-- ✅ Pagination link --}}
        <div class="pagination">
            {{ $kontens->links() }}
        </div>
    </div>
@endsection
