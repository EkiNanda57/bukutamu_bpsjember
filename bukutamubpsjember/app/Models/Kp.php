<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kp extends Model
{
    protected $table = 'kp';

    protected $fillable = [
        'tahun',
        'bulan',
        'hari',
        'waktu',
        'email',
        'kepuasan'
    ];

    public $timestamps = false;
}
