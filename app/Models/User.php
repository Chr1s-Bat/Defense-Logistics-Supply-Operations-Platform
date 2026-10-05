<?php

namespace App\Models;

// 1. Import the trait at the top
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // 2. Include HasApiTokens in the use statement inside the class
    use HasApiTokens, HasFactory, Notifiable;

    // ... rest of your User model code

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // admin or officer
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }

    // One-to-One relation with Personnel profile[cite: 10]
    public function personnel() {
        return $this->hasOne(Personnel::class);
    }
}
