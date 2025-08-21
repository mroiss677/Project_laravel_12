<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konten;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword pencarian dari request
        $search = $request->input('search');

        // Query konten beserta relasi kategori
        $query = Konten::with('kategori');

        // 🔎 Jika ada pencarian berdasarkan judul atau kategori
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function ($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        // Ambil data konten terbaru dengan pagination
        $kontens = $query->latest()->paginate(5); // ✅ tampil 5 per halaman

        // Hitung total data (selalu berdasarkan seluruh tabel, bukan hasil filter)
        $totalKonten = Konten::count();
        $totalKategori = Kategori::count();

        // Kirim ke view
        return view('dashboard', compact(
            'kontens',
            'totalKonten',
            'totalKategori',
            'search'
        ));
    }
}
