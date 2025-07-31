@extends('layouts.dashboard')

@section('title', 'Kategori')

@section('content')
<style>
    .kategori-container {
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        font-family: Arial, sans-serif;
    }

    .kategori-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .kategori-header h2 {
        font-size: 24px;
        color: #333;
        font-weight: bold;
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
        border-radius: 5px;
        color: white;
        font-size: 12px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit {
        background-color: #FFC107;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-delete {
        background-color: #DC3545;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }
</style>

<div class="kategori-container">
    <div class="kategori-header">
        <h2>Manajemen Kategori</h2>
        <a href="{{ route('kategori.create') }}" class="btn-primary">+ Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoris as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn-action btn-edit">✏️ Edit</a>
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center; color: #999;">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
