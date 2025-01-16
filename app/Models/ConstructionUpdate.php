<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionUpdate extends Model
{
    use HasFactory;

    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    public function images()
    {
        return $this->hasMany(ConstructionUpdateImage::class);
    }
}
