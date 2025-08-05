<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use Notifiable;

    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    public $timestamps = true;

    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
        'telp',
        'level',
    ];

    protected $hidden = ['password'];
}
