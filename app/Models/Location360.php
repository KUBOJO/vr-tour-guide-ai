<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location360 extends Model
{
    // Tambahkan ini supaya Laravel tidak bingung mencari tabel
    protected $table = 'locations_360'; 

    protected $fillable = [
        'name',
        'image_path',
        'ai_description',
    ];
}