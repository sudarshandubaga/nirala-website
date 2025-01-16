<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return "slug";
    }

    // public function phase()
    // {
    //     return $this->belongsTo(Phase::class);
    // }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function images()
    // {
    //     return $this->hasMany(ProjectImage::class);
    // }

    // public function downloads()
    // {
    //     return $this->hasMany(ProjectDownload::class);
    // }

    // public function unit_plans()
    // {
    //     return $this->hasMany(ProjectUnitPlan::class);
    // }

    // public function payment_plans()
    // {
    //     return $this->hasMany(ProjectPaymentPlan::class);
    // }

    // public function views()
    // {
    //     return $this->hasMany(ProjectView::class);
    // }

    public function construction_updates()
    {
        return $this->hasMany(ConstructionUpdate::class);
    }

    public function phases()
    {
        return $this->hasMany(Phase::class);
    }
}
