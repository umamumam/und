<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'type',
        'date',
        'start_time',
        'end_time',
        'location_name',
        'location_address',
        'google_maps_url',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
