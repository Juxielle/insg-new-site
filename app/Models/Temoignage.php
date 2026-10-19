<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'promotion',
        'content',
        'avatar',
        'rating',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'rating' => 'integer',
        'order' => 'integer',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->orderBy('order', 'asc');
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && str_starts_with($this->avatar, 'http')) {
            return $this->avatar;
        }
        return $this->avatar ? asset($this->avatar) : asset('assets/images/directeur-1.png');
    }
}

