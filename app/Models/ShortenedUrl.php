<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShortenedUrl extends Model
{
    protected $fillable = [
        'original_url',
        'short_code',
        'clicks'
    ];

    /**
     * Generate a unique short code
     */
    public static function generateShortCode(): string
    {
        do {
            $shortCode = Str::random(6);
        } while (self::where('short_code', $shortCode)->exists());

        return $shortCode;
    }

    /**
     * Increment the click count
     */
    public function incrementClicks(): void
    {
        $this->increment('clicks');
    }

    /**
     * Get the full shortened URL
     */
    public function getShortUrlAttribute(): string
    {
        return url('/' . $this->short_code);
    }
}
