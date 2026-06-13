<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalOp extends Model
{
    protected $table = 'jadwal_ops';

    protected $fillable = [
        'tanggal',
        'lokasi',
        'kegiatan',
        'status',
    ];
}