<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'wedding_date',
        'cover_photo',
        'quote_verse',
        'quote_source',
        'video_url',
        'live_streaming_url',
        'dress_code',
        'bg_music',
        'is_active',
    ];

    protected $casts = [
        'wedding_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function couples(): HasMany
    {
        return $this->hasMany(Couple::class);
    }

    public function coupleGroom()
    {
        return $this->hasOne(Couple::class)->where('gender', 'male');
    }

    public function coupleBride()
    {
        return $this->hasOne(Couple::class)->where('gender', 'female');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function loveStories(): HasMany
    {
        return $this->hasMany(LoveStory::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class);
    }

    public function wishes(): HasMany
    {
        return $this->hasMany(Wish::class);
    }
}
