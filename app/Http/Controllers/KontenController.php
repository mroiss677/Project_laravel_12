<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konten;
use App\Models\Kategori;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $kontens = Konten::with('kategori')->latest()->get();
    return view('konten.index', compact('kontens')); // <-- ini HARUS ada
}

public function create()
{
    $kategoris = Kategori::all();
    return view('konten.create', compact('kategoris'));
}

public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'isi' => 'required',
        'kategori_id' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('gambar', 'public');
    }

    Konten::create($data);
    return redirect()->route('konten.index')->with('success', 'Konten berhasil ditambahkan');
}

public function edit(Konten $konten)
{
    $kategoris = Kategori::all();
    return view('konten.edit', compact('konten', 'kategoris'));
}

public function update(Request $request, Konten $konten)
{
    $request->validate([
        'judul' => 'required',
        'isi' => 'required',
        'kategori_id' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('gambar', 'public');
    }

    $konten->update($data);
    return redirect()->route('konten.index')->with('success', 'Konten berhasil diubah');
}

public function destroy(Konten $konten)
{
    $konten->delete();
    return redirect()->route('konten.index')->with('success', 'Konten berhasil dihapus');
}
}
