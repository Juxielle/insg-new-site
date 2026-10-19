<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'image',
        'is_featured',
        'published_at',
        'views_count',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeCategory($query, $category)
    {
        if (!empty($category)) {
            return $query->where('category', $category);
        }
        return $query;
    }

    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->translatedFormat('d F Y') : null;
    }

    public function getImageUrlAttribute()
    {
        $img = $this->image ?: 'assets/images/1759791578740.jpg.jpeg';
        return str_starts_with($img, 'http') ? $img : '/' . ltrim($img, '/');
    }
}

