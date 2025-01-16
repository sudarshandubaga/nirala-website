@extends('web.layouts.app')
@section('main_contents')
<style>.counter::after {
    content: "+";
    margin-left: 4px;
    color: inherit;
}
.counter_box{
    height:220px;
}
</style>
    <!-- Modal -->
    <div class="modal fade" id="welcomeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content video-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div id="welcomeBanners" class="carousel slide position-relative" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($welcomeBanners as $index => $banner)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ $banner->image }}" class="d-block w-100" alt="Welcome Image" style="object-fit: contain;">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#welcomeBanners" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#welcomeBanners" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="page-content">
        <!-- Slider -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($sliders as $key => $s)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($sliders as $key => $s)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $s->image) }}" class="d-block w-100" alt="{{ $s->title }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
         <!-- Company staus -->
         <div class="section-full text-white bg-img-fix content-inner overlay-primary-dark">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 m-b30" data-aos="fade-right">
                        <div class="p-a30 text-white text-center border-3 counter_box">
                            <div class="icon-lg m-b10">
                                <img src="{{asset('images/team-leader.png')}}" alt="" style="filter: invert(1) brightness(2);">
                            </div>
                            <div class="counter font-45 font-weight-800 m-b5" style="color: #42B8D4;font-size:28px;">28</div>
                            <span>Years of Enduring Commitment</span> </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 m-b30" data-aos="fade-up">
                        <div class="p-a30 text-white text-center border-3 counter_box">
                            <div class="icon-lg m-b10">
                                <img src="{{asset('images/rating.png')}}" alt="" style="filter: invert(1) brightness(2);">
                            </div>
                            <div class="counter font-45 font-weight-800 m-b5" style="color: #42B8D4;font-size:28px;">6000</div>
                            <span>Happy Families</span> </div>
                    </div>
                     <div class="col-lg-3 col-md-6 col-sm-6 m-b30" data-aos="fade-up">
                        <div class="p-a30 text-white text-center border-3 counter_box">
                            <div class="icon-lg m-b10">
                                <img src="{{asset('images/development.png')}}" alt="" style="filter: invert(1) brightness(2);">
                            </div>
                            <div class="counter font-45 font-weight-800 m-b5" style="color: #42B8D4;font-size:28px;">10000000</div>
                            <span>Sq. Ft. Delivered</span> </div>
                    </div>
                    <!--<div class="col-lg-3 col-md-6 col-sm-6 m-b30" data-aos="fade-down">-->
                    <!--    <div class="p-a30 text-white text-center border-3 counter_box">-->
                    <!--        <div class="icon-lg m-b10">-->
                    <!--            <img src="{{asset('images/development.png')}}" alt="" style="filter: invert(1) brightness(2);">-->
                    <!--        </div>-->
                    <!--        <div class="counter font-35 font-weight-800 m-b5" style="color: #42B8D4;font-size:28px;">10000000</div>-->
                    <!--        <span>Sq. Ft. Delivered</span> </div>-->
                    <!--</div>-->
                    <div class="col-lg-3 col-md-6 col-sm-6 m-b10" data-aos="fade-left">
                        <div class="p-a30 text-white text-center border-3 counter_box">
                            <div class="icon-lg m-b10">
                                <img src="{{asset('images/finish.png')}}" alt="" style="filter: invert(1) brightness(2);">
                            </div>
                            <div class="counter font-45 font-weight-800 m-b5" style="color: #42B8D4;font-size:28px;">5</div>
                            <span>project Delivered</span> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Company staus END -->
        {{-- <div class="main-slider style-two default-banner">
            <div class="tp-banner-container">
                <div class="tp-banner">
                    <div id="dz_rev_slider_4_wrapper" class="rev_slider_wrapper fullwidthbanner-container"
                        data-alias="news-gallery36" data-source="gallery"
                        style="Novgin:0px auto;background-color:#ffffff;padding:0px;Novgin-top:0px;Novgin-bottom:0px;">
                        <!-- START REVOLUTION SLIDER 5.3.0.2 fullwidth mode -->
                        <div id="dz_rev_slider_4" class="rev_slider fullwidthabanner" style="display:none;"
                            data-version="5.3.0.2">
                            <ul>
                                @foreach ($sliders as $s)
                                    <!-- SLIDE  -->
                                    <li data-index="rs-100" data-transition="parallaxvertical" data-slotamount="default"
                                        data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                                        data-easeout="default" data-masterspeed="default"
                                        data-thumb="images/main-slider/slide9.jpg" data-rotate="0" data-fstransition="fade"
                                        data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"
                                        data-title="{{ $s->title }}">
                                        <!-- MAIN IMAGE -->
                                        <img src="{{ asset('storage/' . $s->image) }}" alt=""
                                            data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                            data-bgparallax="10" class="rev-slidebg" data-no-retina>
                                        <!-- LAYERS -->
                                        <div class="tp-caption tp-shape tp-shapewrapper " id="slide-100-layer-1"
                                            data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                            data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                            data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape"
                                            data-basealign="slide" data-responsive_offset="off" data-responsive="off"
                                            data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}]'
                                            data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                                            data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                            data-paddingleft="[0,0,0,0]"
                                            style="z-index: 2;background-color:rgba(0, 0, 0, 0.5);border-color:rgba(0, 0, 0, 0);border-width:0px; background-image:url(images/overlay/rrdiagonal-line.png)">
                                        </div>
                                        <!-- LAYER NR. 2 -->
                                        <div class="tp-caption Newspaper-Title   tp-resizeme" id="slide-100-layer-3"
                                            data-x="['left','left','left','left']" data-hoffset="['50','50','50','30']"
                                            data-y="['top','top','top','top']" data-voffset="['220','220','220','100']"
                                            data-fontsize="['50','50','50','30']" data-lineheight="['85','85','55','35']"
                                            data-width="['1000','1000','1000','420']" data-height="none"
                                            data-whitespace="normal" data-type="text" data-responsive_offset="on"
                                            data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                                            data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                                            data-paddingright="[0,0,0,0]" data-paddingbottom="[10,10,10,10]"
                                            data-paddingleft="[0,0,0,0]"
                                            style="z-index: 6; white-space: normal; font-weight:bold; line-height:50px; font-family: 'oswald', sans-serif; color:#fff;">
                                            {{ $s->title }}
                                        </div>
                                    </li>
                                    <!-- SLIDE  -->
                                @endforeach
                            </ul>
                            <div class="tp-bannertimer tp-bottom bg-priNovy" style="height: 5px; "></div>
                        </div>
                    </div>
                    <!-- END REVOLUTION SLIDER -->
                </div>
            </div>
        </div> --}}
        <!-- Slider END -->
        	<!-- Our Services -->
		<div class="section-full bg-white content-inner">
			<div class="container">
				<div class="row">
                    @foreach ($categories as $category)
					<div class="col-md-4 col-lg-4 col-sm-6 m-b30" data-aos="zoom-in-up">
						<div class="dez-box p-a20 border-1">
							<div class="dez-media dez-img-effect zoom-slow"> <a href="{{ route('project.index', $category) }}">
                                {{--{{asset($category->image)}} {{ asset('storage/' . $download->file) }} --}}
                                <img src="{{ asset($category->image)}}" alt=""></a> </div>
							<div class="dez-info text-center">
								<h4 class="dez-title m-t20"><a href="{{ route('project.index', $category) }}">{{ $category->name }} Projects</a></h4>
								{{-- <p>We provide the best construction project for you.  We build and has built hotels, residences, hospitals etc.  </p> --}}
								<a href="{{ route('project.index', $category) }}" class="site-button">Read More</a> 
							</div>
						</div>
					</div>
                    @endforeach
				</div>
			</div>
		</div>
	    <!-- Our Services END-->
        <!-- Our Awesome Services -->
        <div class="section-full">
            <div class="container-fluid">
                <div class="row dzseth">
                    <div class="col-lg-12 col-md-12 bg-gray p-lr0 box-services">
                        <iframe 
    width="560" 
    height="285" 
    src="https://www.youtube.com/embed/{{ $site->video_id }}?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" 
    title="YouTube video player" 
    frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
    allowfullscreen>
</iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Awesome Services END -->
        <!-- Services -->
        {{-- <div class="section-full bg-img-fix content-inner-1 overlay-black-middle"
            style="background-image:url(images/background/bg5.jpg); Novgin-top:-1px">
            <div class="container">
                <div class="section-head text-center text-white">
                    <h2 class="text-uppercase">Our Best <span class="text-priNovy">Services</span></h2>
                    <p>Because of best quality & service, victory has always been our goal, we only repRecent the
                        best talent. We’ll do everything for you which can put you at ease with the correct
                        guidance, simplicity & honesty.</p>
                </div>
                <div class="section-content owl-none">
                    <div class="img-carousel-content owl-carousel mfp-gallery gallery owl-btn-center-lr">
                        <div class="item">
                            <div class="ow-carousel-entry">
                                <div class="ow-entry-media dez-img-effect zoom-slow"> <a href="#"><img
                                            src="images/our-work/new/pic1.jpg" alt=""></a> </div>
                                <div class="ow-entry-content">
                                    <div class="ow-entry-title text-uppercase"><a href="#">Integrity
                                        </a></div>
                                    <div class="ow-entry-text">
                                        <p>We first create the highest level of trust and integrity with our clients
                                            and provide...</p>
                                    </div>
                                    <div class="ow-entry-button"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ow-carousel-entry">
                                <div class="ow-entry-media dez-img-effect zoom-slow"> <a href="#"><img
                                            src="images/our-work/new/pic2.jpg" alt=""></a> </div>
                                <div class="ow-entry-content">
                                    <div class="ow-entry-title text-uppercase"><a href="#">Sustainability
                                        </a></div>
                                    <div class="ow-entry-text">
                                        <p>We provide an extraordinary construction project for your dream and
                                            desire.</p>
                                    </div>
                                    <div class="ow-entry-button"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ow-carousel-entry">
                                <div class="ow-entry-media dez-img-effect zoom-slow"> <a href="#"><img
                                            src="images/our-work/new/pic3.jpg" alt=""></a> </div>
                                <div class="ow-entry-content">
                                    <div class="ow-entry-title text-uppercase"><a href="#">Consulting</a>
                                    </div>
                                    <div class="ow-entry-text">
                                        <p>Our consulting team is always ready to help you and give you best advice
                                            for you. </p>
                                    </div>
                                    <div class="ow-entry-button"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ow-carousel-entry">
                                <div class="ow-entry-media dez-img-effect zoom-slow"> <a href="#"><img
                                            src="images/our-work/new/pic4.jpg" alt=""></a> </div>
                                <div class="ow-entry-content">
                                    <div class="ow-entry-title text-uppercase"><a href="#">Community</a>
                                    </div>
                                    <div class="ow-entry-text">
                                        <p>We will work and discuss on your project with our best team members
                                            and...</p>
                                    </div>
                                    <div class="ow-entry-button"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Services End -->
        <!-- Meet Our Team -->
        <div class="section-full bg-white content-inner core-member">
            <div class="container">
                <div class="section-head text-center ">
                    {{-- <h2 class="text-uppercase">Meet Our <span class="text-priNovy">Core Members</span></h2> --}}
                    <h2 class="text-uppercase" data-aos="fade-up">CMD <span class="text-priNovy">Message</span></h2>
                    <div class="dez-separator-outer ">
                        <div class="dez-separator bg-secondry style-skew"></div>
                    </div>
                    <div class="clear"></div>
                    {{-- <p>Our sNovt team takes care of everything. The entire team has been great to work with from
                        start to finish. Our team is focused on target and best service. </p> --}}
                </div>
                <div class="section-content ">
                    {{-- <div class="row">
                        @foreach ($teams as $team)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 dez-team">
                                <div class="dez-box m-b30">
                                    <div class="dez-media dez-media-left dez-img-overlay6 dez-img-effect ">
                                        <img src="{{ $team->image }}" alt="{{ $team->name }}">
                                    </div>
                                    <div class="p-a10 bg-priNovy text-center text-white">
                                        <h4 class="dez-title text-uppercase m-a5">
                                            {{ $team->name }}
                                        </h4>
                                        <span class="dez-member-position">{{ $team->designation }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> --}}

                    @foreach ($teams as $team)
                        <div class="row mb-3">
                            <div class="col-sm-4" style="text-align: center" data-aos="zoom-in-up">
                                <img alt="{{ $team->name }}" src="{{ $team->image }}" class="w-100 h-100"
                                    style="object-fit: contain">
                            </div>
                            <div class="col-sm-8">
                                <h2 class="mb-2">{{ $team->name }}</h2>
                                <h4><strong>{{ $team->designation }}</strong></h4>
                                <i class="fa fa-quote-left" style="font-size: 24px;"></i>
                                <p class="text-dark" data-aos="zoom-in">
                                  {{ $team->about }}<sub><i class="fa fa-quote-right float-right" style="font-size: 24px;"></i></sub>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Meet Our Team END -->
        <!-- About Section -->
        {{-- <div class="section-full bg-img-fix p-tb40 overlay-primary-dark get-a-quote text-white"
            style="background-image:url(images/background/bg4.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" data-aos="fade-up">
                        <h4 class="pull-left m-b0">Want to find a high quality constructor for your projects?</h4>
                        <div class="pull-right"><a href="http://wa.me/919212131476" class="site-button black radius-sm">Chat Us</a></div>
                    </div>
                </div>
            </div>
        </div> --}}

       

        {{-- Video Gallery --}}
        <div class="section-full p-tb40">
            <div class="container">
                <div class="section-head text-center ">
                    <h2 class="text-uppercase" data-aos="zoom-in-up">Video <span class="text-priNovy">Gallery</span></h2>
                    <div class="dez-separator-outer" data-aos="zoom-in-up">
                        <div class="dez-separator bg-secondry style-skew"></div>
                    </div>
                </div>
                <div class="section-content ">
                    <div class="row">
                        @foreach ($videos as $video)
                            <div class="col-sm-4" data-aos="zoom-in-up">
                                <figure class="position-relative">
                                    {{-- <img src="{{ $video->image }}" alt="" class="img-cover" />
                                    <a href="{{ $video->video_url }}" class="video-play-btn youtube-popup">
                                        <i class="fa fa-play"></i>
                                    </a> --}}
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$video->video_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </figure>
                                <h3 class="text-center">
                                    {{ $video->title }}
                                </h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
         <!-- Latest blog -->
         <div class="section-full content-inner-1 bg-white ">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="text-uppercase" data-aos="zoom-in-up">Latest blogs and News</h2>
                    <div class="dez-separator-outer" data-aos="zoom-in-up">
                        <div class="dez-separator bg-secondry style-skew"></div>
                    </div>
                </div>
                <div class="section-content">
                    <div class="blog-carousel mfp-gallery owl-carousel gallery owl-btn-center-lr">
                        @foreach ($blogs as $blog)
                        <div class="item" data-aos="zoom-in-up">
                            <div class="ow-blog-post date-style-2">
                                <div class="ow-post-media dez-img-effect zoom-slow"> <img src="{{asset('uploads/'.$blog->image)}}" alt="{{$blog->title}}" style="height: 220px;"> </div>
                                <div class="ow-post-info ">
                                    <div class="ow-post-title">
                                        <h4 class="post-title"> <a href="{{route('blog.single',$blog->slug)}}" title="Video post">{{$blog->title}}</a> </h4>
                                    </div>
                                    <div class="ow-post-meta">
                                        <ul>
                                            <li class="post-date"> <i class="fa fa-calendar"></i><strong>{{date('d M',strtotime($blog->created_at))}} </strong> <span> {{date('Y',strtotime($blog->created_at))}} </span> </li>
                                            <li class="post-author"><i class="fa fa-user"></i>By <a href="javascript:void(0);" title="Posts by Admin" rel="author">Admin</a> </li>
                                            {{-- <li class="post-comment">
                                                <i class="fa fa-eye"></i> <a href="javascript:void(0);" class="comments-link">{{$blog->view}} View</a> </li> --}}
                                        </ul>
                                    </div>
                                    <div class="ow-post-text">
                                        <p>{!!Str::of($blog->description)->words(20, ' ...')!!}  </p>
                                    </div>
                                    <div class="ow-post-readmore "> <a href="{{route('blog.single',$blog->slug)}}" title="READ MORE" rel="bookNovk" class=" site-button-link"> READ MORE <i class="fa fa-angle-double-right"></i></a> </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Latest blog END -->

        <!-- Testimoniyal overlay-white-dark-->
        <div class="section-full bg-img-fix content-inner"
            style="background-image:url({{asset('images/background/bg2.jpg')}}); Novgin-top:-1px;">
            <div class="container">
                <div class="section-head text-white text-center">
                    <h2 class="text-uppercase">Testimonials</h2>
                    <div class="dez-separator-outer ">
                        <div class="dez-separator bg-white  style-skew"></div>
                    </div>
                    {{-- <p class="text-dark">We are extremely happy with our results because our clients happy with our work. Here are
                        some of our customers who have expressed their views.</p> --}}
                </div>
                <div class="section-content">
                    <div class="testimonial-four owl-carousel owl-theme">
                        @foreach ($testimonials as $testimonial)
                        <div class="item">
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$testimonial->video_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            {{-- <div class="testimonial-4 testimonial-bg">
                                <div class="testimonial-pic"><img src="{{asset('uploads/'.$testimonial->image)}}" width="100"
                                        height="100" alt=""></div>
                                <div class="testimonial-text">
                                    <p>{{$testimonial->comment}}</p>
                                </div>
                                <div class="testimonial-detail"> <strong class="testimonial-name">{{$testimonial->name}}</strong> <span class="testimonial-position">{{$testimonial->designation}}</span>
                                </div>
                                <div class="quote-right"></div>
                            </div> --}}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimoniyal End -->
        <!-- Client logo -->
        {{-- <div class="section-full dez-we-find bg-img-fix p-t50 p-b50 ">
            <div class="container">
                <div class="section-content">
                    <div class="client-logo-carousel mfp-gallery owl-carousel gallery owl-btn-center-lr">
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo"><a href="#"><img src="images/client-logo/logo1.jpg"
                                            alt=""></a></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo"> <a href="#"><img src="images/client-logo/logo2.jpg"
                                            alt=""></a> </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo"> <a href="#"><img src="images/client-logo/logo1.jpg"
                                            alt=""></a> </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo"> <a href="#"><img src="images/client-logo/logo3.jpg"
                                            alt=""></a> </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo"> <a href="#"><img src="images/client-logo/logo4.jpg"
                                            alt=""></a> </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo"> <a href="#"><img src="images/client-logo/logo3.jpg"
                                            alt=""></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Client logo END -->
    </div>
    <!-- Content END-->
    @if(!isset($_COOKIE['disclaimer_agreed']))
        <div class="modal fade" id="disclaimerModal" tabindex="-1" aria-labelledby="disclaimerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="disclaimerModalLabel">Disclaimer</h5>
                    </div>
                    <div class="modal-body">
                        <p>
                            This is to inform users / customer(s) that <a href="https://niralaworld.com/">www.NIRALAWORLD.com</a>, are the only official websites of NIRALA WORLD (“Nirala infratech Pvt Ltd”). User/Customer(s) are cautioned and advised not to rely upon any information stated on any other websites which may appear to be similar to the company’s official website, including containing company’s logo / brand name. The information contained in such websites may be false and user/customer(s) may get misleaded & suffer loss if they rely on such information.
                        </p>
                        <p>
                            In the event, user/customer(s) come across any such websites similar to company’s official website containing its brand name/logo or any other information, then kindly contact and inform us on <a href="mailto:sales@niralaworld.com">sales@niralaworld.com</a>.
                        </p>
                        <p>
                            Please ensure that you deal with only RERA registered real estate agents (“Registered Real Estate Agents”) whose name appears as a real estate agent under the project name on the RERA website.
                        </p>
                        <p>Thank you for your time!!</p>
                    </div>
                    <div class="modal-footer">
                        <button id="agree-button" type="button" class="btn btn-dark">I Agree</button>
                    </div>
                </div>
            </div>
        </div>  
    @endif
</div>
@endsection

@push('extra_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    <script>
        $(function() {
            $('.youtube-popup').on("click", function(event) {
                event.preventDefault();

                $('#youtubeVideo').modal('show');

                $('#youtubeVideo').find('iframe').attr('src', $(this).attr('href'));
            });

            $('#youtubeVideo').on('hidden.bs.modal', function(event) {
                $('#youtubeVideo').find('iframe').attr('src', '');
            });

            @if (!$welcomeBanners->isEmpty())
                $(window).on("load", function() {
                    $('#welcomeModal').modal('show');
                });
            @endif
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const agreeButton = document.getElementById('agree-button');
            const popup = document.getElementById('disclaimer-popup');
    
            if (agreeButton) {
                agreeButton.addEventListener('click', function () {
                    // Hide the popup
                    popup.style.display = 'none';
    
                    // Set a cookie to remember user agreement
                    document.cookie = "disclaimer_agreed=true; path=/; max-age=" + 60 * 60 * 24 * 30; // Cookie valid for 30 days
                });
            }
        });
    </script> --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const disclaimerModal = $('#disclaimerModal'); // jQuery object for the modal
    disclaimerModal.modal('show');
    const agreeButton = $('#agree-button'); // jQuery object for the "I Agree" button

    // // Check if the disclaimer has already been agreed to
    // const cookies = document.cookie.split('; ').find(row => row.startsWith('disclaimer_agreed='));
    // const disclaimerAgreed = cookies && cookies.split('=')[1] === 'true';

    // // Show the modal if the disclaimer hasn't been agreed to
    // if (!disclaimerAgreed) {
    //     disclaimerModal.modal('show');
    // }

    // // When the user clicks "I Agree"
 agreeButton.on('click', function () {
        // Set a cookie to remember user agreement for 30 days
        // document.cookie = "disclaimer_agreed=true; path=/; max-age=" + 60 * 60 * 24 * 30; // Valid for 30 days
        
        // Hide the modal
        disclaimerModal.modal('hide');
    });
});
    </script>
@endpush
