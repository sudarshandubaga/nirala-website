@extends('web.layouts.app')
@section('main_contents')
<style>.counter::after {
    content: "+";
    margin-left: 4px;
    color: inherit;
}</style>

<div class="page-content">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle" style="background-image:url({{asset('images/background/bg4.jpg')}});">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">{{$blog->title}}</h1>
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="javascript:void(0);">Home</a></li>
                <li>{{$blog->title}}</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <div class="content-area">
        <div class="container">
            <div class="row">
                <!-- Left part start -->
                <div class="col-lg-9 col-md-8 m-b30">
                    <!-- blog start -->
                    <div class="blog-post blog-single">
                        <div class="dez-post-title ">
                            <h3 class="post-title"><a href="javascript:void(0);">{{$blog->title}}</a></h3>
                        </div>
                        <div class="dez-post-meta m-b20">
                            <ul>
                                <li class="post-date"> <i class="fa fa-calendar"></i><strong>{{date('d M',strtotime($blog->created_at))}}</strong> <span> {{date('Y',strtotime($blog->created_at))}}</span> </li>
                                <li class="post-author"><i class="fa fa-user"></i>By <a href="javascript:void(0);">Admin</a> </li>
                                <!--<li class="post-comment"><i class="fa fa-eye"></i> <a href="javascript:void(0);">{{$blog->view}} View</a> </li>-->
                            </ul>
                        </div>
                        <div class="dez-post-media dez-img-effect zoom-slow"> <a href="javascript:void(0);"><img src="{{asset('uploads/'.$blog->image)}}" alt="{{$blog->title}}"></a> </div>
                        <div class="dez-post-text">
                            {!! $blog->description !!}
                        </div>
                        
                    </div>
                    <!-- blog END -->
                </div>
                <!-- Left part END -->
                <!-- Side bar start -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <aside  class="side-bar">
                        <div class="widget recent-posts-entry">
                            <h4 class="widget-title">Recent Posts</h4>
                            <div class="widget-post-bx">
                                @foreach ($recent_blog as $blog)
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media"> <img src="{{asset('uploads/'.$blog->image)}}" width="200" height="143" alt="{{$blog->title}}"> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h6 class="post-title"><a href="{{route('blog.single',$blog->slug)}}">{{$blog->title}}</a></h6>
                                        </div>
                                        <div class="dez-post-meta">
                                            <ul>
                                                <li class="post-author">By <a href="javascript:void(0);">Admin</a></li>
                                                <li class="post-comment"><i class="fa fa-eye"></i>{{$blog->view}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </aside>
                </div>
                <!-- Side bar END -->
            </div>
        </div>
    </div>
</div>
  
  
</div>
@endsection
