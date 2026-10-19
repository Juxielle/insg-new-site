<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date_start',
        'date_end',
        'location',
        'summary',
        'description',
        'image',
        'organizer',
    ];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];

    public function scopeUpcoming($query)
    {
        return $query->where('date_start', '>=', now()->startOfDay())
            ->orderBy('date_start');
    }

    public function getFormattedPeriodAttribute()
    {
        if (!$this->date_start) return '';
        if (!$this->date_end || $this->date_start->isSameDay($this->date_end)) {
            return $this->date_start->translatedFormat('d F Y');
        }
        return 'Du ' . $this->date_start->translatedFormat('d F') . ' au ' . $this->date_end->translatedFormat('d F Y');
    }

    public function getImageUrlAttribute()
    {
        $img = $this->image ?: 'assets/images/insg-back-8.jpeg';
        return str_starts_with($img, 'http') ? $img : '/' . ltrim($img, '/');
    }
}

