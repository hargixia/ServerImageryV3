<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'foto',
        'password',
        'id_role',
        'id_bidang',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
