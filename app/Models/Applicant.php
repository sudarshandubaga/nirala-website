<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'records' => 'array',
        'employment_history' => 'array',
        'references' => 'array',
        'professional_membership' => 'array',
        'particulars' => 'array',
    ];

    public function career_post()
    {
        return $this->belongsTo(CareerPost::class, 'career_post_id');
    }
}
