@extends('layouts.dashboard')
@section('title', 'Konten')
@section('content')
<style>
     .konten-container {
        border-radius: 12px;
        padding: 15px;
        background-color: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        font-family: Arial, sans-serif;
     }

     .container-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        padding: 5px;
        border-radius: 10px;
     }

     .btn-primary {
        background-color: #007BFF;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s ease;
     }

     .kategori-header h2 {
        font-size: 24px;
        color: #333;
        font-weight: bold;
    }
     
     .btn-primary:hover {
        background-color: #0056b3;
     }

     .alert-success {
        background-color: #D1FAE5;
        color: #065F46;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 14px;
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

    .btn-action {
        padding: 6px 10px;
        border: none;
        margin: 5px;
        border-radius: 5px;
        color: white;
        font-size: 13px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit {
        background-color: #FFC107;
    }

    .btn-edit:hover {
        background-color: #e0a800;
        color: black;
    }

    .btn-delete {
        background-color: #DC3545;
    }

    .btn-delete:hover {
        background-color: #c82333;
        color: black;
    }
</style>
    <div class="konten-container">
        <div class="container-header">
    <h2>Data Konten</h2>
    <a href="{{ route('konten.create') }}" class="btn-primary">+ Tambah Konten</a>
        </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>no</th>
                <th>Judul</th>
                <th>isi</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
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
                    <td>
                        <a href="{{ route('konten.edit', $konten->id) }}" class="btn-action btn-edit">✏️ Edit</a>
                        <form action="{{ route('konten.destroy', $konten->id) }}" method="POST"  style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus konten ini?')">
                            @csrf @method('DELETE')
                            <button class="btn-action btn-delete">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; color: #999;">Belum ada konten.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
@endsection