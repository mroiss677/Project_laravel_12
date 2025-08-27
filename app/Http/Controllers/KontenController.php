<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konten;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Konten::with('kategori')->latest();

        
        if (Auth::user()->email !== 'admin@gmail.com') {
            $query->where('user_id', Auth::id());
        }

        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function ($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $kontens = $query->paginate(10); 
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
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul','isi','kategori_id']);
        $data['user_id'] = Auth::id(); 

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('konten', 'public');
        }

        Konten::create($data);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil ditambahkan');
    }

    public function edit(Konten $konten)
    {
       
        if (Auth::user()->email !== 'admin@gmail.com' && $konten->user_id !== Auth::id()) {
            return redirect()->route('konten.index')->with('error', 'Anda tidak boleh mengedit konten ini');
        }

        $kategoris = Kategori::all();
        return view('konten.edit', compact('konten', 'kategoris'));
    }

    public function update(Request $request, Konten $konten)
    {
        
        if (Auth::user()->email !== 'admin@gmail.com' && $konten->user_id !== Auth::id()) {
            return redirect()->route('konten.index')->with('error', 'Anda tidak boleh mengubah konten ini');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul','isi','kategori_id']);

        if ($request->hasFile('gambar')) {
            
            if ($konten->gambar && Storage::disk('public')->exists($konten->gambar)) {
                Storage::disk('public')->delete($konten->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('konten', 'public');
        }

        $konten->update($data);

        return redirect()->route('konten.index')->with('success', 'Konten berhasil diubah');
    }

    public function destroy(Konten $konten)
    {
        
        if (Auth::user()->email !== 'admin@gmail.com' && $konten->user_id !== Auth::id()) {
            return redirect()->route('konten.index')->with('error', 'Anda tidak boleh menghapus konten ini');
        }

        if ($konten->gambar && Storage::disk('public')->exists($konten->gambar)) {
            Storage::disk('public')->delete($konten->gambar);
        }

        $konten->delete();

        return redirect()->route('konten.index')->with('success', 'Konten berhasil dihapus');
    }
}
