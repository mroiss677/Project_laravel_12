@extends('layouts.dashboard')

@section('title', 'Tambah Konten')

@section('content')
    <style>
        .form-container {
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .form-container h2 {
            text-align: center;
            font-size: 28px;
            color: #2d3436;
            margin-bottom: 35px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }


        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #34495e;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dfe6e9;
            border-radius: 10px;
            transition: all 0.3s ease;
            background-color: #fdfdfd;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: #0984e3;
            box-shadow: 0 0 6px rgba(9, 132, 227, 0.3);
        }

        .text-danger {
            color: #d63031;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #019875;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>

    <div class="form-container">
        <h2>Tambah Konten</h2>

        <form action="{{ route('konten.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}"
                    placeholder="Masukkan judul konten">
                @error('judul')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="isi">Isi Konten</label>
                <textarea name="isi" id="isi" class="form-control" rows="5" placeholder="Tulis isi konten di sini...">{{ old('isi') }}</textarea>
                @error('isi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-control">
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="gambar">Gambar (Opsional)</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
                @error('gambar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('konten.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
