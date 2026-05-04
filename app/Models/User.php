<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Required for Auth
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // These fields are allowed to be filled during registration
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'address',
    ];

    // This hides the password when you fetch user data
    protected $hidden = [
        'password',
        'remember_token',
    ];
}