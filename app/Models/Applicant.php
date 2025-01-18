<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'academic_records' => 'array',
        'employment_history' => 'array',
        'references' => 'array',
        'professional_memberships' => 'array',
        'particulars' => 'array',
    ];
}
