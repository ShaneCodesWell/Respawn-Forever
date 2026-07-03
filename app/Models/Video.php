<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'youtube_id',
        'category',
        'duration',
        'description',
        'is_short',
        'published_at',
    ];

    protected $casts = [
        'is_short' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Handy accessor so Blade templates can just do $video->thumbnail_url
    public function getThumbnailUrlAttribute(): string
    {
        return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
    }

    // Handy accessor for the embeddable player URL
    public function getEmbedUrlAttribute(): string
    {
        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }
}