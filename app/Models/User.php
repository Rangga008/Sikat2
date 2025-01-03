<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'email', 'password', 'role', 'nama_toko', 'rating_toko', 'kontak', 'reset_token', 'token_expires_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'token_expires_at' => 'datetime',
    ];

    // Optional: To cast role to a readable string
    public function getRoleAttribute($value)
    {
        return ucfirst($value); // Capitalize role name
    }
}