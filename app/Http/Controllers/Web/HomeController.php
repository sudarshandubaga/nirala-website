<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\VideoGallery;
use App\Models\WelcomeBanner;
use App\Models\TestimonialVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index()
    {
        // Artisan::call('optimize');die;
        $sliders = Slider::get();
        $categories = Category::has('projects')->get();
        $about = Page::where('slug', 'about-us')->first();
        $teams = Team::oldest()->get();
        $videos = VideoGallery::latest()->get();
        $welcomeBanners = WelcomeBanner::get();
        $blogs = Blog::latest()->get();
        $testimonials = Testimonial::latest()->get();
        $testimonials = TestimonialVideo::latest()->get();
        return view('web.inc.home.index', compact('sliders', 'about', 'categories', 'teams', 'videos', 'welcomeBanners','blogs','testimonials'));
    }

    public function singleBlog($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        $blog->increment('view');
        $recent_blog = Blog::latest()->limit(8)->get();
        return view('web.inc.home.single_blog', compact('blog','recent_blog'));
    }
}
