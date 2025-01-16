<!-- Footer -->
<footer class="site-footer">
    <!-- footer top part -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4 d-flex align-items-center justify-content-center">
                    <div class="widget widget_about">
                        <div class="logo-footer"><img src="{{ asset('images/logo.png') }}" alt="">
                        </div>
                        <!--<p class="text-white">{{ substr(html_entity_decode(strip_tags($about->description)), 0, 180) }}</p>-->
                        <ul class="dez-social-icon dez-border">
                            <li><a class="fa fa-facebook" href="{{ $site->facebook_link }}" target="_blank"></a></li>
                            <li><a class="fa fa-twitter" href="{{ $site->twitter_link }}" target="_blank"></a>
                            </li>
                            <li><a class="fa fa-linkedin" href="{{ $site->linkedin_link }}" target="_blank"></a></li>
                            <li><a class="fa fa-instagram" href="{{ $site->instagram_link }}" target="_blank"></a></li>
                            <li>
                                <a class="fa fa-whatsapp" href="http://wa.me/{{ $site->whatsapp_no }}"
                                    target="_blank"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_services">
                        <h4 class="m-b15 text-uppercase">Quick Links</h4>
                        <div class="dez-separator-outer m-b10">
                            <div class="dez-separator bg-white style-skew"></div>
                        </div>
                        <ul>
                            <li><a href="{{ route('page.show', 'about-us') }}" class="text-white">About {{ $site->title }}</a></li>
                            {{-- <li><a href="{{ route('page.member') }}">Core Management</a></li> --}}
                            <li><a href="{{ route('page.show', 'vision-and-mission') }}" class="text-white">Vision &amp; Mission</a></li>
                            <li><a href="{{ route('construction-update.projects') }}" class="text-white">Construction Updates</a></li>
                            <li><a href="{{ route('career-post.index') }}" class="text-white">Careers</a></li>
                            <li>
                                <a href="{{ route('contact.index') }}" class="text-white">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_services">
                        <h4 class="m-b15 text-uppercase">Other Links</h4>
                        <div class="dez-separator-outer m-b10">
                            <div class="dez-separator bg-white style-skew"></div>
                        </div>
                        <ul>
                            <li><a href="{{ route('page.show', 'disclaimer') }}" class="text-white">Disclaimer</a></li>
                            <li><a href="{{ route('page.show', 'privacy-policy') }}" class="text-white">Privacy Policy</a></li>
                            <li><a href="{{ route('page.show', 'terms-and-conditions') }}" class="text-white">Terms &amp; Conditions</a>
                            </li>
                        </ul>

                        <h4 class="m-b15 text-uppercase mt-3">Member</h4>
                        <div class="dez-separator-outer m-b10">
                            <div class="dez-separator bg-white style-skew"></div>
                        </div>
                        <div>
                            <img src="{{ asset('images/member-logo-1.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_getintuch">
                        <h4 class="m-b15 text-uppercase">Contact us</h4>
                        <div class="dez-separator-outer m-b10">
                            <div class="dez-separator bg-white style-skew"></div>
                        </div>
                        <ul>
                            <li class="text-white">
                                <i class="fa fa-map-marker"></i>
                                <strong>address</strong>
                                {{ $site->address }}
                            </li>
                            <li class="text-white">
                                <i class="fa fa-phone"></i>
                                <strong>phone</strong>
                                {{ $site->phone }}
                            </li>
                            <li class="text-white">
                                <i class="fa fa-fax"></i>
                                <strong>FAX</strong>
                                {{ $site->fax }}
                            </li>
                            <li class="text-white">
                                <i class="fa fa-envelope"></i>
                                <strong>email</strong>
                                {{ $site->email }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom part -->
    <div class="footer-bottom footer-line">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-4 col-md-4 text-left">
                    <span>&copy; Copyright {{ date('Y') }}</span>
                </div>
                <div class="col-lg-4 col-md-4 ml-md-auto text-right">
                    <span>Designed & Developed By:
                        <a href="http://thexpertcoders.com" target="_blank" class="text-white">
                            Xpert Coders Pvt. Ltd.
                        </a>
                    </span>
                </div>
            </div> --}}
            <div class="text-center text-white">
                &copy; Copyright 2015 {{ $site->title }}
            </div>
        </div>
    </div>
</footer>
<!-- Footer END-->

<div class="social-fixed">
    <a class="fa fa-facebook facebook" href="{{ $site->facebook_link }}" target="_blank"></a>
    <a class="fa fa-twitter twitter" href="{{ $site->twitter_link }}" target="_blank"></a>

    <a class="fa fa-linkedin linkedin" href="{{ $site->linkedin_link }}" target="_blank"></a>
    <a class="fa fa-instagram instagram" href="{{ $site->instagram_link }}" target="_blank"></a>

    <a class="fa fa-whatsapp whatsapp" href="http://wa.me/{{ $site->whatsapp_no }}" target="_blank"></a>

</div>

<a href="#enquiryModal" data-toggle="modal" class="enquiry-btn">Inquire</a>

<!-- Modal -->
<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enquiryModalLabel">Inquire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <x-enquiry-form />
            </div>
        </div>
    </div>
</div>

<!-- scroll top button -->
<button class="scroltop fa fa-arrow-up style4"></button>
