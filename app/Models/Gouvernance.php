<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gouvernance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'division',
        'bio',
        'quote',
        'photo',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order', 'asc');
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo && str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }
        return $this->photo ? asset($this->photo) : asset('assets/images/directeur-1.png');
    }
}

