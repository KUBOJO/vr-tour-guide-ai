<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuery extends Model
{
    protected $fillable = [
        'user_name',
        'question',
        'ai_response',
        'audio_path',
        'status',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location360::class);
    }
}