<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageAttribute($image)
    {
        return $image ? asset('storage/' . $image) : null;
    }

    public function mediaCategory()
    {
        return $this->belongsTo(MediaCategory::class);
    }
}
