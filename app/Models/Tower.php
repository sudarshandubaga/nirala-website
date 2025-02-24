<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    use HasFactory;

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function flats()
    {
        return $this->hasMany(Flat::class);
    }
}
