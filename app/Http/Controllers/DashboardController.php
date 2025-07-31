<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konten;

class DashboardController extends Controller
{
    public function index()
{
    $kontens = Konten::with('kategori')->get();
    $totalKonten = $kontens->count();
    $totalKategori = \App\Models\Kategori::count();

    return view('dashboard', compact('kontens', 'totalKonten', 'totalKategori'));
}
}
