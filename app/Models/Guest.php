<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'invitation_id',
        'name',
        'attendance',
        'message',
        'guest_count',
        'is_opened'
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
