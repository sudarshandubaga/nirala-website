<!-- header -->
<header class="site-header header mo-left header-style-1">
     <!-- top bar -->
     <div class="top-bar no-skew">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="dez-topbar-left col">
                    <ul class="social-bx list-inline  pull-left">
                        <li class="d-flex align-items-center"><a href="javascript:void(0);" ><i class="fa fa-phone"></i></a> +91 120 4823000</li>
                        <li class="d-flex align-items-center"><a href="mailto:sales@niralaworld.com" class="fa fa-envelope"></a> sales@niralaworld.com</li>
                    </ul>
                </div>
                <div class="dez-topbar-right col">
                 <ul class="social-bx list-inline pull-right">
                        <li><a target="_blank" href="https://www.facebook.com/niralaworldpvtltd/"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a target="_blank" href="https://twitter.com/Nirala_World"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="https://www.linkedin.com/in/nirala-world-2929b0ab/"><i class="fa fa-linkedin"></i></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/nirala_world/"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- top bar END-->
    <!-- main header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix ">
            <div class="container clearfix">
                <!-- website logo -->
                <div class="logo-header mostion dark">
                    <a href="{{ route('home') }}" title="{{ $site->title }}">
                        <img src="{{ asset('images/logo.png') }}" width="193" height="89" alt="">
                    </a>
                </div>
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                    <ul class=" nav navbar-nav ml-auto ">
                        <li class="active"> <a href="{{ route('home') }}" title="{{ $site->title }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('page.show', 'about-us') }}">About Us</a>
                        </li>
                        {{-- <li> <a href="javascript:;">About Us<i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('page.show', 'about-us') }}">About {{ $site->title }}</a></li>
                                <li><a href="{{ route('page.member') }}">CMD Message</a></li>
                                <li><a href="{{ route('page.show', 'vision-and-mission') }}">Vision &amp; Mission</a>
                                </li>
                            </ul>
                        </li> --}}
                        <li>
                            <a href="javascript:;">Project<i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('project.index', $category) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('construction-update.projects') }}">Construction Update</a>
                        </li>
                        <li>
                            <a href="javascript:;">News &amp; Media<i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                @foreach ($mediaCategories as $category)
                                    <li>
                                        <a href="{{ route('media.index', $category) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;">NRIs<i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                @foreach ($faqCategories as $category)
                                    <li>
                                        <a href="{{ route('faq.index', $category) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('career-post.index') }}">Careers</a>
                        </li>
                        <li>
                            <a href="javascript:;">Contact us</a>
                            <i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('contact.index', ['type' => 'corporate']) }}">
                                        Corporate Office
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('contact.index', ['type' => 'site']) }}">
                                        Site Office
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('page.show', 'rera') }}">RERA</a>
                        </li>
                    </ul>
                    {{-- <div class="ml-3">
                        <a href="{{ route('page.show', 'rera') }}">
                            <img src="{{ asset('images/rera_logo.png') }}" alt="RERA" class="rera_logo">
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>
<!-- header END -->
