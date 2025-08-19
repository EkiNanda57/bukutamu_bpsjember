<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Menunjuk ke tabel 'admin' di database.
     */
    protected $table = 'admin';

    /**
     * Kolom yang bisa diisi secara massal.
     * Sesuai dengan file SQL Anda.
     */
    protected $fillable = [
        'nama',
        'username',
        'password',
    ];

    /**
     * Kolom yang harus disembunyikan saat di-serialisasi.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Menonaktifkan timestamps (created_at & updated_at)
     * karena tabel Anda tidak memilikinya.
     */
    public $timestamps = false;
}
