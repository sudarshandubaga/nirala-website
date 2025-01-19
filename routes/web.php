<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CareerEnquiryController;
use App\Http\Controllers\CareerPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConstructionUpdateController;
use App\Http\Controllers\ContactEnquiryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaCategoryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TestimonialVideoController;
use App\Http\Controllers\TowerController;
use App\Http\Controllers\VideoGalleryController;
use App\Http\Controllers\Web\CareerPostController as WebCareerPostController;
use App\Http\Controllers\Web\ConstructionController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\FaqController as WebFaqController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MediaController as WebMediaController;
use App\Http\Controllers\Web\PageController as WebPageController;
use App\Http\Controllers\Web\PhaseController as WebPhaseController;
use App\Http\Controllers\Web\ProjectController as WebProjectController;
use App\Models\Site;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/migrate', function () {
    return Artisan::call('migrate');
});
Route::get('/getSlug', function (Request $req) {
    $slug = '';
    if (!empty($req->title)) {
        $slug = Str::slug($req->title);
    }
    return response()->json([
        'status' => true,
        'slug' => $slug
    ]);
})->name('getSlug');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('login.post');

Route::group(['prefix' => 'nirala-admin', 'middleware' => 'auth', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('blog/create', [BlogController::class, 'index'])->name('blog.create');
    Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('blog/read', [BlogController::class, 'read'])->name('blog.read');
    Route::get('blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
    Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::post('ckeditor/store', [BlogController::class, 'ckeditorImageUpload'])->name('ckeditor.upload');

    // Testimonial 
    Route::get('testimonial/create', [TestimonialController::class, 'index'])->name('testimonial.create');
    Route::post('testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::get('testimonial/read', [TestimonialController::class, 'read'])->name('testimonial.read');
    Route::get('testimonial/delete/{id}', [TestimonialController::class, 'delete'])->name('testimonial.delete');
    Route::get('testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::post('testimonial/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');

    // Testimonial Video
    Route::get('testimonial-video/create', [TestimonialVideoController::class, 'index'])->name('testimonial.video.create');
    Route::post('testimonial-video/store', [TestimonialVideoController::class, 'store'])->name('testimonial.video.store');
    Route::get('testimonial-video/read', [TestimonialVideoController::class, 'read'])->name('testimonial.video.read');
    Route::get('testimonial-video/delete/{id}', [TestimonialVideoController::class, 'delete'])->name('testimonial.video.delete');
    Route::get('testimonial-video/edit/{id}', [TestimonialVideoController::class, 'edit'])->name('testimonial.video.edit');
    Route::post('testimonial-video/update/{id}', [TestimonialVideoController::class, 'update'])->name('testimonial.video.update');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect(route('login'))->with('success', 'Success! You\'ve logged out.');
    })->name('logout');

    Route::get('/site-setting', [SiteController::class, 'edit'])->name('site.edit');
    Route::put('/site-setting', [SiteController::class, 'update'])->name('site.update');

    Route::get('/site/remove-image/{welcomeBanner}', [SiteController::class, 'remove_welcome_banner'])->name('site.remove-welcome-banner');
    Route::get('/site/remove-image', [SiteController::class, 'remove_image'])->name('site.remove-image');

    Route::get('/change-password', [AdminController::class, 'index'])->name('password.index');
    Route::post('/change-password', [AdminController::class, 'store'])->name('password.store');

    Route::get('/applicant/{applicant}', [ApplicantController::class, 'show'])->name('applicant.show');


    Route::resources([
        'category' => CategoryController::class,
        'page' => PageController::class,
        'slider' => SliderController::class,
        'project' => ProjectController::class,
        'phase' => PhaseController::class,
        'tower' => TowerController::class,
        'flat' => FlatController::class,
        'team' => TeamController::class,
        'construction-update' => ConstructionUpdateController::class,
        'career-post' => CareerPostController::class,
        'career-enquiry' => CareerEnquiryController::class,
        'contact-enquiry' => ContactEnquiryController::class,
        'media-category' => MediaCategoryController::class,
        'media' => MediaController::class,
        'faq-category' => FaqCategoryController::class,
        'faq' => FaqController::class,
        'video-gallery' => VideoGalleryController::class,
    ]);
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog/{slug}', [HomeController::class, 'singleBlog'])->name('blog.single');
Route::get('/project/{category}', [WebProjectController::class, 'index'])->name('project.index');
Route::get('/media/{mediaCategory}', [WebMediaController::class, 'index'])->name('media.index');
Route::get('/media-details/{media}', [WebMediaController::class, 'show'])->name('media.show');
Route::get('/faq/{faqCategory}', [WebFaqController::class, 'index'])->name('faq.index');
Route::resource('phase', WebPhaseController::class)->only(['index', 'show']);
Route::get('/construction-update/projects', [ConstructionController::class, 'projects'])->name('construction-update.projects');
Route::get('/construction-update/{project}', [ConstructionController::class, 'index'])->name('construction-update.index');
Route::get('/construction-update/{constructionUpdate}', [ConstructionController::class, 'show'])->name('construction-update.show');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
Route::get('/core-member', [WebPageController::class, 'member'])->name('page.member');
Route::get('/career-post', [WebCareerPostController::class, 'index'])->name('career-post.index');
Route::post('/career-post', [WebCareerPostController::class, 'store'])->name('career-post.store');
Route::get('apply-job', function () {
    $site = Site::find(1);
    view()->share(compact('site'));
    return view('web.inc.career-post.apply');
})->name('apply-job');
Route::get('{page}', [WebPageController::class, 'show'])->name('page.show');
