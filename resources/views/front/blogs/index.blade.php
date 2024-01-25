@extends('front.layouts.app')
@section('content')
    <div class="hero common-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>blogs</h1>
                        <ul class="breadcumb">
                            @if (auth()->check())
                                <li class="active"><a href="{{ route('movies.home') }}">Home</a></li>
                            @else
                                <li class="active"><a href="{{ route('front.index') }}">Home</a></li>
                            @endif
                            <li> <span class="ion-ios-arrow-right"></span> blog listing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog list section-->
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    @foreach ($posts as $post)
                        <div class="blog-item-style-1 blog-item-style-3">
                            @php
                                $content = $post->post_content;
                                $doc = new DOMDocument();
                                libxml_use_internal_errors(true);
                                $doc->loadHTML($content);
                                libxml_clear_errors();

                                $images = $doc->getElementsByTagName('img');
                                $imageUrl = $images->length > 0 ? $images->item(0)->getAttribute('src') : null;
                            @endphp

                            {{-- Use the extracted image URL or default image --}}
                            <img src="{{ $imageUrl ?? asset('path/to/default-image.jpg') }}" alt="{{ $post->post_title }}" style="width: 20%">
                            <div class="blog-it-infor">
                                <h3><a href="blogdetail.html">{{ $post->post_title }}</a></h3>
                                <span class="time">27 Mar 2017</span>
                                <p>Africa's burgeoning animation scene got a boost this week with the announcement of an
                                    ambitious new partnership that will pair rising talents from across the continent ...
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <ul class="pagination">
                        <li class="icon-prev"><a href="#"><i class="ion-ios-arrow-left"></i></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">21</a></li>
                        <li><a href="#">22</a></li>
                        <li class="icon-next"><a href="#"><i class="ion-ios-arrow-right"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="sidebar">
                        <div class="sb-search sb-it">
                            <h4 class="sb-title">Search</h4>
                            <input type="text" placeholder="Enter keywords">
                        </div>
                        <div class="sb-cate sb-it">
                            <h4 class="sb-title">Categories</h4>
                            <ul>
                                <li><a href="#">Awards (50)</a></li>
                                <li><a href="#">Box office (38)</a></li>
                                <li><a href="#">Film reviews (72)</a></li>
                                <li><a href="#">News (45)</a></li>
                                <li><a href="#">Global (06)</a></li>
                            </ul>
                        </div>
                        <div class="sb-recentpost sb-it">
                            <h4 class="sb-title">most popular</h4>
                            <div class="recent-item">
                                <span>01</span>
                                <h6><a href="#">Korea Box Office: Beauty and the Beast Wins Fourth</a></h6>
                            </div>
                            <div class="recent-item">
                                <span>02</span>
                                <h6><a href="#">Homeland Finale Includes Shocking Death </a></h6>
                            </div>
                            <div class="recent-item">
                                <span>03</span>
                                <h6><a href="#">Fate of the Furious Reviews What the Critics Saying</a></h6>
                            </div>
                        </div>
                        <div class="sb-tags sb-it">
                            <h4 class="sb-title">tags</h4>
                            <ul class="tag-items">
                                <li><a href="#">Batman</a></li>
                                <li><a href="#">film</a></li>
                                <li><a href="#">homeland</a></li>
                                <li><a href="#">Fast & Furious</a></li>
                                <li><a href="#">Dead Walker</a></li>
                                <li><a href="#">King</a></li>
                                <li><a href="#">Beauty</a></li>
                            </ul>
                        </div>
                        <div class="ads">
                            <img src="images/uploads/ads1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
