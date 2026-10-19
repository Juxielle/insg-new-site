<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'level',
        'department',
        'duration',
        'summary',
        'description',
        'admission_requirements',
        'career_opportunities',
        'curriculum',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLevel($query, $level)
    {
        if (!empty($level)) {
            return $query->where('level', $level);
        }
        return $query;
    }

    public function scopeDepartment($query, $department)
    {
        if (!empty($department)) {
            return $query->where('department', $department);
        }
        return $query;
    }

    public function getImageUrlAttribute()
    {
        $img = $this->image ?: 'assets/images/insg-back-4.jpeg';
        return str_starts_with($img, 'http') ? $img : '/' . ltrim($img, '/');
    }
}

