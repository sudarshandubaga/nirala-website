<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhaseNewPriceList extends Model
{
    use HasFactory;
    protected $fillable = ['phase_id','title', 'size', 'price'];
}
