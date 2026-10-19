<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'logo',
        'website_url',
        'description',
        'order',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    public function getLogoUrlAttribute()
    {
        $logo = $this->logo ?: 'assets/images/partners/bgfi.png';
        return str_starts_with($logo, 'http') ? $logo : '/' . ltrim($logo, '/');
    }

    public function getImageUrlAttribute()
    {
        return $this->logo_url;
    }
}

