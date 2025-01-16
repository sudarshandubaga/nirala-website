<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function towers()
    {
        return $this->hasMany(Tower::class);
    }

    public function images()
    {
        return $this->hasMany(PhaseImage::class);
    }

    public function downloads()
    {
        return $this->hasMany(PhaseDownload::class);
    }

    public function unit_plans()
    {
        return $this->hasMany(PhaseUnitPlan::class);
    }

    public function payment_plans()
    {
        return $this->hasMany(PhasePaymentPlan::class);
    }

    public function views()
    {
        return $this->hasMany(PhaseView::class);
    }

    public function price_list_images()
    {
        return $this->hasMany(PhasePriceList::class);
    }
    public function new_price_list()
    {
        return $this->hasMany(PhaseNewPriceList::class);
    }
}
