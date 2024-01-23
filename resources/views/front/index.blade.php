@extends('front.layouts.app')
@section('content')

    <!-- END | Header -->

    <div class="slider sliderv2">
        <div class="container">
            <div class="row">
                <div class="slider-single-item">
                    @if ($banner->isNotEmpty())
                        @foreach ($banner as $banners)
                            <div class="movie-item">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <div class="title-in">
                                            <div class="cate">
                                                <span class="blue"><a href="#">Sci-fi</a></span>
                                                <span class="yell"><a href="#">Action</a></span>
                                                <span class="orange"><a href="#">advanture</a></span>
                                            </div>
                                            <h1><a href="#">{{ $banners->title }}<span>2015</span></a></h1>
                                            <div class="social-btn">
                                                <a href="#" class="parent-btn"><i class="ion-play"></i> Watch
                                                    Trailer</a>
                                                {{-- <div class="hover-bnt">
                                                    <div class="hvr-item">
                                                        <a href="#" class="hvr-grow"><i
                                                                class="ion-social-facebook"></i></a>
                                                        <a href="#" class="hvr-grow"><i
                                                                class="ion-social-twitter"></i></a>
                                                        <a href="#" class="hvr-grow"><i
                                                                class="ion-social-googleplus"></i></a>
                                                        <a href="#" class="hvr-grow"><i
                                                                class="ion-social-youtube"></i></a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="mv-details">
                                                <p><i class="ion-android-star"></i><span>7.4</span> /10</p>
                                                <ul class="mv-infor">
                                                    <li> Release: 1 May 2015</li>
                                                </ul>
                                            </div>
                                            <div class="btn-transform transform-vertical">
                                                <div><a href="#" class="item item-1 redbtn">more detail</a></div>
                                                <div><a href= "#" class="item item-2 redbtn hvrbtn">more detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="mv-img-2">
                                            <a href="#"><img
                                                    src="{{ asset('storage/banner-upload/' . $banners->image) }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="movie-items  full-width">
        <div class="row">
            <div class="col-md-12">
                <div class="title-hd">
                    <h2>Top Rated Movies</h2>
                </div>
                <div class="tab-content">
                    <div id="tab1-h2" class="tab active">
                        <div class="row">
                            <div class="slick-multiItem2">
                                @foreach ($movieResults['results'] as $movie)
                                    <div class="slide-it">
                                        <div class="movie-item">
                                            <div class="mv-img">
                                                <img src="{{ 'https://image.tmdb.org/t/p/original' . $movie['poster_path'] }}"
                                                    alt="">
                                            </div>
                                            <div class="hvr-inner">
                                                <a
                                                    href="{{ route('show.detail', ['type' => 'movie', 'id' => $movie['id']]) }}">
                                                    Read more <i class="ion-android-arrow-dropright"></i> </a>
                                            </div>
                                            <div class="title-in">
                                                <h6><a href="#">{{ $movie['title'] }}</a></h6>
                                                <p><i
                                                        class="ion-android-star"></i><span>{{ number_format($movie['vote_average'], 1) }}</span>
                                                    /10</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="title-hd">
                    <h2>Top Rated Series</h2>
                </div>
                <div class="tab-content">
                    <div id="tab21-h2" class="tab active">
                        <div class="row">
                            <div class="slick-multiItem2">
                                @foreach ($seriesResults['results'] as $series)
                                    <div class="slide-it">
                                        <div class="movie-item">
                                            <div class="mv-img">
                                                <img src="{{ 'https://image.tmdb.org/t/p/original' . $series['poster_path'] }}"
                                                    alt="">
                                            </div>
                                            <div class="hvr-inner">
                                                <a
                                                    href="{{ route('show.detail', ['type' => 'series', 'id' => $series['id']]) }}">
                                                    Read more <i class="ion-android-arrow-dropright"></i> </a>
                                            </div>
                                            <div class="title-in">
                                                <h6><a href="#">{{ $series['name'] }}</a></h6>
                                                <p><i
                                                        class="ion-android-star"></i><span>{{ number_format($series['vote_average'], 1) }}</span>
                                                    /10</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- latest new v1 section-->

    <!--end of latest new v1 section-->
    <!-- footer section-->


@endsection
