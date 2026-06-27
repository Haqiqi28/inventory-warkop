<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'name_user',
        'username',
        'password',
        'role',
    ];

    /**
     * Hidden Attribute
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute Casting
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Username sebagai credential login
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}