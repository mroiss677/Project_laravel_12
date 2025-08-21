<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi massal
     */
    protected $fillable = [
        'name',
        'username', // wajib agar tidak error
        'email',
        'password',
        'level', // ganti role menjadi level
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting kolom
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Helper cek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->level === 'admin';
    }

    /**
     * Helper cek apakah user biasa
     */
    public function isUser(): bool
    {
        return $this->level === 'user';
    }

    /**
     * Relasi ke konten
     */
    public function kontens()
    {
        return $this->hasMany(Konten::class);
    }
}
