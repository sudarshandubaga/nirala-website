<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    public $casts = [
        'offices' => 'array'
    ];

    public function getLogoAttribute($logo)
    {
        return $logo ? asset('storage/' . $logo) : null;
    }

    public function getFaviconAttribute($favicon)
    {
        return $favicon ? asset('storage/' . $favicon) : null;
    }

    public function getWelcomeImageAttribute($image)
    {
        return $image ? asset('storage/' . $image) : null;
    }
}
