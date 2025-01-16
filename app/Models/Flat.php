<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    public function constructionUpdates()
    {
        return $this->hasMany(ConstructionUpdate::class);
    }
}
