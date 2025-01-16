<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    protected $appends = ['video_url', 'image'];

    public function getVideoUrlAttribute()
    {
        return "https://www.youtube.com/embed/" . $this->video_id;
    }

    public function getImageAttribute()
    {
        return "https://i.ytimg.com/vi_webp/" . $this->video_id . "/maxresdefault.webp";
    }
}
