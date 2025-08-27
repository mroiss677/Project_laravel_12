<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $role
 * @method static create(array $attributes)
 */

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role', // ✅ ganti dari level ke role
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ✅ Helper untuk cek admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // ✅ Helper untuk cek user biasa
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function kontens()
    {
        return $this->hasMany(Konten::class);
    }
}
