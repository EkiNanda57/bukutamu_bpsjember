<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bt extends Model
{
    protected $table = 'bt';

    protected $fillable = [
        'tahun', 
        'bulan', 
        'hari', 
        'waktu', 
        'nama', 
        'email', 
        'alamat', 
        'no_hp', 
        'umur', 
        'asal', 
        'jk', 
        'pendidikan', 
        'pekerjaan', 
        'keperluan', 
        'k_lain'
    ];

    public $timestamps = false;
}
