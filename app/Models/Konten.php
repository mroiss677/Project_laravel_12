<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Konten extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi massal
     */
    protected $fillable = [
        'judul',
        'isi',
        'kategori_id',
        'gambar',
        'user_id',
    ];

    /**
     * Relasi ke kategori
     * Konten milik satu kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi ke user
     * Konten ditulis oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
