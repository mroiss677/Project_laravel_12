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
     public function index(Request $request)
    {
        $query = Konten::with('kategori')->latest();

        // ✅ Tambahkan fitur pencarian judul & kategori
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function ($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }

        $kontens = $query->paginate(10); // ✅ pakai paginate biar lebih rapi
        return view('konten.index', compact('kontens'));
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
        if ($konten->gambar && file_exists(public_path('storage/' . $konten->gambar))) {
            unlink(public_path('storage/' . $konten->gambar));
        }

        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/gambar'), $filename);
        $data['gambar'] = 'gambar/' . $filename;
    } else {
        unset($data['gambar']);
    }

    $konten->update($data);

    return redirect()->route('konten.index')->with('success', 'Konten berhasil diubah');
    }


    public function destroy(Konten $konten)
    {
        if ($konten->gambar && file_exists(public_path('storage/' . $konten->gambar))){
            unlink(public_path('storage/' . $konten->gambar));
        }

        $konten->delete();
        return redirect()->route('konten.index')->with('success', 'Konten berhasil dihapus');
    }
}
