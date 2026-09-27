<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'invitation_id',
        'name',
        'whatsapp',
        'attendance',
        'message',
        'guest_count',
        'is_opened',
        'is_wa_sent',
    ];

    protected $casts = [
        'is_opened' => 'boolean',
        'is_wa_sent' => 'boolean',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
