<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime: d.m.y | h:i A',
        'updated_at' => 'datetime: d.m.y | h:i A',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageAttribute($image)
    {
        return $image ? asset('storage/' . $image) : null;
    }

    public function getBgImageAttribute($image)
    {
        return $image ? asset('storage/' . $image) : null;
    }
}
