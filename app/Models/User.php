<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Konten;


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
        'role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function kontens()
    {
        return $this->hasMany(Konten::class);
    }
}
