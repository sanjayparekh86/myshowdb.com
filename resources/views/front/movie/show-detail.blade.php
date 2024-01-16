@extends('front.layouts.app')
<style>
    .rating {
        display: inline-block;
        position: relative;
        height: 50px;
        line-height: 50px;
        font-size: 50px;
    }

    .rating label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        cursor: pointer;
    }

     .rating input[type="radio"] {
        display: none;
    }

    .rating input[type="radio"]:checked + label {
        color: #ffcc00; /* Checked star color */
    }

    .rating label:last-child {
        position: static;
    }

    .rating label:nth-child(1) {
        z-index: 5;
    }

    .rating label:nth-child(2) {
        z-index: 4;
    }

    .rating label:nth-child(3) {
        z-index: 3;
    }

    .rating label:nth-child(4) {
        z-index: 2;
    }

    .rating label:nth-child(5) {
        z-index: 1;
    }

    .rating label input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .rating label .icon {
        float: left;
        color: transparent;
    }

    .rating label:last-child .icon {
        color: #000;
    }

    .rating:not(:hover) label input:checked~.icon,
    .rating:hover label:hover input~.icon {
        color: #09f;
    }

    .rating label input:focus:not(:checked)~.icon:last-child {
        color: #000;
        text-shadow: 0 0 5px #09f;
    }
</style>
@section('content')
    <form action="" id="showReviewForm" method="post" name="showReviewForm">
        @csrf
        <div class="buster-light">
            <div class="hero mv-single-hero">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <h1> movie listing - list</h1>
                                                                                                                        <ul class="breadcumb">
                                                                                                                            <li class="active"><a href="#">Home</a></li>
                                                                                                                            <li> <span class="ion-ios-arrow-right"></span> movie listing</li>
                                                                                                                        </ul> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-single movie-single movie_single">
                <div class="container">
                    <div class="row ipad-width2">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="movie-img sticky-sb">
                                @if ($searchType == 'movie')
                                    <img src="{{ 'https://image.tmdb.org/t/p/w92' . $movieResults['poster_path'] }}"
                                        alt="">
                                @elseif ($searchType == 'series')
                                    <img src="{{ 'https://image.tmdb.org/t/p/w92' . $seriesResults['poster_path'] }}"
                                        alt="">
                                @endif
                                <div class="movie-btn">
                                    <div class="btn-transform transform-vertical red">
                                        <div><a href="#" class="item item-1 redbtn"> <i class="ion-play"></i> Watch
                                                Trailer</a></div>
                                        <div><a href="https://www.youtube.com/embed/o-0hcF97wy0"
                                                class="item item-2 redbtn fancybox-media hvr-grow"><i
                                                    class="ion-play"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="movie-single-ct main-content">
                                @if ($searchType == 'movie')
                                    <h1 class="bd-hd">{{ $movieResults['title'] }}
                                        <span>{{ \Carbon\Carbon::parse($movieResults['release_date'])->format('Y') }}</span>
                                    </h1>
                                @elseif ($searchType == 'series')
                                    <h1 class="bd-hd">{{ $seriesResults['name'] }}
                                        <span>{{ \Carbon\Carbon::parse($seriesResults['first_air_date'])->format('Y') }}</span>
                                    </h1>
                                @endif
                                <div class="social-btn">
                                    <a href="#" class="parent-btn"><i class="ion-heart"></i> Add to Favorite</a>
                                    <div class="hover-bnt">
                                        <a href="#" class="parent-btn"><i class="ion-android-share-alt"></i>share</a>
                                        <div class="hvr-item">
                                            <a href="#" class="hvr-grow"><i class="ion-social-facebook"></i></a>
                                            <a href="#" class="hvr-grow"><i class="ion-social-twitter"></i></a>
                                            <a href="#" class="hvr-grow"><i class="ion-social-googleplus"></i></a>
                                            <a href="#" class="hvr-grow"><i class="ion-social-youtube"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="movie-rate">
                                    <div class="rate">
                                        <i class="ion-android-star"></i>
                                        <p><span>8.1</span> /10<br>
                                            <span class="rv">56 Reviews</span>
                                        </p>
                                    </div>
                                    <div class="rate-star">
                                        <p>Rate This Movie: </p>
                                        <i class="ion-ios-star"></i>
                                        <i class="ion-ios-star"></i>
                                        <i class="ion-ios-star"></i>
                                        <i class="ion-ios-star"></i>
                                        <i class="ion-ios-star"></i>
                                        <i class="ion-ios-star"></i>
                                        <i class="ion-ios-star"></i>
                                        <i class="ion-ios-star"></i>
                                        <i class="ion-ios-star-outline"></i>
                                    </div>
                                </div>
                                <div class="check-box">
                                    <input type="hidden" name="movieResults" value="{{json_encode($movieResults)}}">
                                    <input type="hidden" name="seriesResults" value="{{json_encode($seriesResults)}}">
                                    <input type="hidden" name="searchType" value="{{$searchType}}">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="watch_status" id="wantToWatch"
                                            value="0" {{ old('watch_status', $userReview ? $userReview->watch_status : '') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="wantToWatch" style="color: white">
                                            Want to Watch
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="watch_status"
                                            id="alreadyWatched" value="1" {{ old('watch_status', $userReview ? $userReview->watch_status : '') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="alreadyWatched" style="color: white">
                                            Already Watched
                                        </label>
                                    </div>
                                </div>
                                <div id="watchDateSection" style="display: none; margin-top: 27px;">
                                    <!-- Input fields related to "Want to Watch" section go here -->
                                    <label for="watch_date">Watch Date:</label>
                                    <input type="date" id="watchDate" name="watch_date" value="{{ old('watch_date', $userReview ? $userReview->watch_date : '') }}">
                                    <button type="submit">Submit</button>
                                </div>
                                <div id="reviewSection" style="display: {{ old('watch_status', $userReview ? $userReview->watch_status : '') == '1' ? 'block' : 'none' }}; margin-top: 80px;">
                                    <!-- Input fields related to "Already Watched" section go here -->
                                    <div class="rating">
                                        <label>
                                            <input type="radio" name="user_rating" value="1" {{ $userReview && $userReview->user_rating == 1 ? 'checked' : '' }}/>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="user_rating" value="2" {{ $userReview && $userReview->user_rating == 2 ? 'checked' : '' }}/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="user_rating" value="3" {{ $userReview && $userReview->user_rating == 3 ? 'checked' : '' }}/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="user_rating" value="4" {{ $userReview && $userReview->user_rating == 4 ? 'checked' : '' }}/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="user_rating" value="5" {{ $userReview && $userReview->user_rating == 5 ? 'checked' : '' }}/>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                    </div>
                                    <label for="watch_date">Watch Date:</label>
                                    <input type="date" id="watchDate" name="watch_date" value="{{ old('watch_date', $userReview ? $userReview->watch_date : '') }}">
                                    <label for="comment">Comment:</label>
                                    <textarea id="comment" name="comment">{{ old('comment', $userReview ? $userReview->comment : '') }}</textarea>
                                    <button type="submit">Submit Review</button>
                                </div>
                                <div class="movie-tabs">
                                    <div class="tabs">
                                        <ul class="tab-links tabs-mv">
                                            <li class="active"><a href="#overview">Overview</a></li>
                                            <li><a href="#cast"> Cast & Crew </a></li>
                                            <li><a href="#media"> Media</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="overview" class="tab active">
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                        @if ($searchType == 'movie')
                                                            <p>{{ $movieResults['overview'] }}</p>
                                                        @elseif ($searchType == 'series')
                                                            <p>{{ $seriesResults['overview'] }}</p>
                                                        @endif
                                                        <div class="title-hd-sm">
                                                            <h4>Videos & Photos</h4>
                                                            <a href="#" class="time">All 5 Videos & 245 Photos <i
                                                                    class="ion-ios-arrow-right"></i></a>
                                                        </div>
                                                        <div class="mvsingle-item ov-item">
                                                            <a class="img-lightbox" data-fancybox-group="gallery"
                                                                href="images/uploads/image11.jpg"><img
                                                                    src="images/uploads/image1.jpg" alt=""></a>
                                                            <a class="img-lightbox" data-fancybox-group="gallery"
                                                                href="images/uploads/image21.jpg"><img
                                                                    src="images/uploads/image2.jpg" alt=""></a>
                                                            <a class="img-lightbox" data-fancybox-group="gallery"
                                                                href="images/uploads/image31.jpg"><img
                                                                    src="images/uploads/image3.jpg" alt=""></a>
                                                            <div class="vd-it">
                                                                <img class="vd-img" src="images/uploads/image4.jpg"
                                                                    alt="">
                                                                <a class="fancybox-media hvr-grow"
                                                                    href="https://www.youtube.com/embed/o-0hcF97wy0"><img
                                                                        src="images/uploads/play-vd.png"
                                                                        alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="title-hd-sm">
                                                            <h4>cast</h4>
                                                            <a href="#" class="time">Full Cast & Crew <i
                                                                    class="ion-ios-arrow-right"></i></a>
                                                        </div>
                                                        <!-- movie cast -->
                                                        @if ($searchType == 'movie')
                                                            @foreach ($movieResults['credits']['cast'] as $cast)
                                                                <div class="mvcast-item">
                                                                    <div class="cast-it">
                                                                        <div class="cast-left">
                                                                            <img src="{{ 'https://image.tmdb.org/t/p/w92' . $cast['profile_path'] }}"
                                                                                alt="" style="width: 19%;">
                                                                            <a href="#">{{ $cast['name'] }}.</a>
                                                                        </div>
                                                                        <p>... {{ $cast['character'] }}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @elseif ($searchType == 'series')
                                                            @foreach ($seriesResults['credits']['cast'] as $cast)
                                                                <div class="mvcast-item">
                                                                    <div class="cast-it">
                                                                        <div class="cast-left">
                                                                            <img src="{{ 'https://image.tmdb.org/t/p/w92' . $cast['profile_path'] }}"
                                                                                alt="" style="width: 19%;">
                                                                            <a href="#">{{ $cast['name'] }}</a>
                                                                        </div>
                                                                        <p>... {{ $cast['character'] }}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif


                                                        <!-- movie user review -->

                                                    </div>
                                                    <div class="col-md-4 col-xs-12 col-sm-12">
                                                        @if ($searchType == 'movie')
                                                            <div class="sb-it">
                                                                <h6>Director: </h6>
                                                                <p><a
                                                                        href="#">{{ $movieResults['credits']['crew'][0]['name'] }}</a>
                                                                </p>
                                                            </div>
                                                        @elseif ($searchType == 'series')
                                                            <div class="sb-it">
                                                                <h6>Director: </h6>
                                                                <p><a href="#"></a>
                                                                </p>
                                                            </div>
                                                        @endif
                                                        @if ($searchType == 'movie' && isset($movieResults['credits']['crew']))
                                                            <div class="sb-it">
                                                                <h6>Writer: </h6>
                                                                @foreach ($movieResults['credits']['crew'] as $crewMember)
                                                                    @if ($crewMember['department'] == 'Writing')
                                                                        <p><a href="#">{{ $crewMember['name'] }}</a>
                                                                        </p>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @elseif ($searchType == 'series' && isset($seriesResults['credits']['crew']))
                                                            <div class="sb-it">
                                                                <h6>Writer: </h6>
                                                                @foreach ($seriesResults['credits']['crew'] as $crewMember)
                                                                    @if ($crewMember['department'] == 'Writing')
                                                                        <p><a href="#">{{ $crewMember['name'] }}</a>
                                                                        </p>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        <div class="sb-it">
                                                            <h6>Stars: </h6>
                                                            <p><a href="#">Robert Downey Jr,</a> <a
                                                                    href="#">Chris
                                                                    Evans,</a> <a href="#">Mark Ruffalo,</a><a
                                                                    href="#">
                                                                    Scarlett Johansson</a></p>
                                                        </div>
                                                        @if ($searchType == 'movie' && isset($movieResults['genres']))
                                                            <div class="sb-it">
                                                                <h6>Genres:</h6>
                                                                @foreach ($movieResults['genres'] as $genre)
                                                                    <p><a href="#">{{ $genre['name'] }}</a></p>
                                                                @endforeach
                                                            </div>
                                                        @elseif ($searchType == 'series' && isset($seriesRsults['genres']))
                                                            <div class="sb-it">
                                                                <h6>Genres:</h6>
                                                                @foreach ($seriesResults['genres'] as $genre)
                                                                    <p><a href="#">{{ $genre['name'] }}</a></p>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        @if ($searchType == 'movie')
                                                            <div class="sb-it">
                                                                <h6>Release Date:</h6>
                                                                <p>{{ \Carbon\Carbon::parse($movieResults['release_date'])->format('j F Y') }}
                                                                </p>
                                                            </div>
                                                        @elseif ($searchType == 'series')
                                                            <div class="sb-it">
                                                                <h6>Release Date:</h6>
                                                                <p>{{ \Carbon\Carbon::parse($seriesResults['first_air_date'])->format('j F Y') }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                        <div class="sb-it">
                                                            <h6>Run Time:</h6>
                                                            <p>141 min</p>
                                                        </div>
                                                        <div class="sb-it">
                                                            <h6>MMPA Rating:</h6>
                                                            <p>PG-13</p>
                                                        </div>
                                                        <div class="sb-it">
                                                            <h6>Plot Keywords:</h6>
                                                            <p class="tags">
                                                                <span class="time"><a
                                                                        href="#">superhero</a></span>
                                                                <span class="time"><a href="#">marvel
                                                                        universe</a></span>
                                                                <span class="time"><a href="#">comic</a></span>
                                                                <span class="time"><a
                                                                        href="#">blockbuster</a></span>
                                                                <span class="time"><a href="#">final
                                                                        battle</a></span>
                                                            </p>
                                                        </div>
                                                        <div class="ads">
                                                            <img src="images/uploads/ads1.png" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="cast" class="tab">
                                                <div class="row">
                                                    <h3>Cast & Crew of</h3>
                                                    @if ($searchType == 'movie')
                                                        <h2>{{ $movieResults['title'] }}</h2>
                                                    @elseif ($searchType == 'series')
                                                        <h2>{{ $seriesResults['name'] }}</h2>
                                                    @endif
                                                    <!-- //== -->
                                                    <div class="title-hd-sm">
                                                        <h4>Directors & Credit Writers</h4>
                                                    </div>
                                                    <div class="mvcast-item">
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>JW</h4>
                                                                <a href="#">Joss Whedon</a>
                                                            </div>
                                                            <p>... Director</p>
                                                        </div>
                                                    </div>
                                                    <!-- //== -->
                                                    <div class="title-hd-sm">
                                                        <h4>Directors & Credit Writers</h4>
                                                    </div>
                                                    <div class="mvcast-item">
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>SL</h4>
                                                                <a href="#">Stan Lee</a>
                                                            </div>
                                                            <p>... (based on Marvel comics)</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>JK</h4>
                                                                <a href="#">Jack Kirby</a>
                                                            </div>
                                                            <p>... (based on Marvel comics)</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>JS</h4>
                                                                <a href="#">Joe Simon</a>
                                                            </div>
                                                            <p>... (character created by: Captain America)</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>JS</h4>
                                                                <a href="#">Joe Simon</a>
                                                            </div>
                                                            <p>... (character created by: Thanos)</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>RT</h4>
                                                                <a href="#">Roy Thomas</a>
                                                            </div>
                                                            <p>... (character created by: Ultron, Vision)</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>JB</h4>
                                                                <a href="#">John Buscema</a>
                                                            </div>
                                                            <p>... (character created by: Ultron, Vision)</p>
                                                        </div>
                                                    </div>
                                                    <!-- //== -->
                                                    <div class="title-hd-sm">
                                                        <h4>Cast</h4>
                                                    </div>
                                                    <div class="mvcast-item">
                                                        @if ($searchType == 'movie')
                                                            @foreach ($movieResults['credits']['cast'] as $cast)
                                                                <div class="cast-it">
                                                                    <div class="cast-left">
                                                                        <img src="{{ 'https://image.tmdb.org/t/p/w92' . $cast['profile_path'] }}"
                                                                            alt="" width="50">
                                                                        <a href="#">{{ $cast['name'] }}</a>
                                                                    </div>
                                                                    <p>... {{ $cast['name'] }}</p>
                                                                </div>
                                                            @endforeach
                                                        @elseif ($searchType == 'series')
                                                            @foreach ($seriesResults['credits']['cast'] as $cast)
                                                                <div class="cast-it">
                                                                    <div class="cast-left">
                                                                        <img src="{{ 'https://image.tmdb.org/t/p/w92' . $cast['profile_path'] }}"
                                                                            alt="" style="width: 16%;">
                                                                        <a href="#">{{ $cast['name'] }}</a>
                                                                    </div>
                                                                    <p>... {{ $cast['name'] }}</p>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <!-- //== -->
                                                    <div class="title-hd-sm">
                                                        <h4>Produced by</h4>
                                                    </div>
                                                    <div class="mvcast-item">
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>VA</h4>
                                                                <a href="#">Victoria Alonso</a>
                                                            </div>
                                                            <p>... executive producer</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>MB</h4>
                                                                <a href="#">Mitchel Bell</a>
                                                            </div>
                                                            <p>... co-producer (as Mitch Bell)</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>JC</h4>
                                                                <a href="#">Jamie Christopher</a>
                                                            </div>
                                                            <p>... associate producer</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>LD</h4>
                                                                <a href="#">Louis D’Esposito</a>
                                                            </div>
                                                            <p>... executive producer</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>JF</h4>
                                                                <a href="#">Jon Favreau</a>
                                                            </div>
                                                            <p>... executive producer</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>KF</h4>
                                                                <a href="#">Kevin Feige</a>
                                                            </div>
                                                            <p>... producer</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>AF</h4>
                                                                <a href="#">Alan Fine</a>
                                                            </div>
                                                            <p>... executive producer</p>
                                                        </div>
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <h4>JF</h4>
                                                                <a href="#">Jeffrey Ford</a>
                                                            </div>
                                                            <p>... associate producer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="media" class="tab">
                                                <div class="row">
                                                    <div class="rv-hd">
                                                        <div>
                                                            <h3>Videos & Photos of</h3>
                                                            <h2>Skyfall: Quantum of Spectre</h2>
                                                        </div>
                                                    </div>
                                                    <div class="title-hd-sm">
                                                        <h4>Videos <span>(8)</span></h4>
                                                    </div>
                                                    <div class="mvsingle-item media-item">
                                                        <div class="vd-item">
                                                            <div class="vd-it">
                                                                <img class="vd-img" src="images/uploads/vd-item1.jpg"
                                                                    alt="">
                                                                <a class="fancybox-media hvr-grow"
                                                                    href="https://www.youtube.com/embed/o-0hcF97wy0"><img
                                                                        src="images/uploads/play-vd.png"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="vd-infor">
                                                                <h6> <a href="#">Trailer: Watch New Scenes</a></h6>
                                                                <p class="time"> 1: 31</p>
                                                            </div>
                                                        </div>
                                                        <div class="vd-item">
                                                            <div class="vd-it">
                                                                <img class="vd-img" src="images/uploads/vd-item2.jpg"
                                                                    alt="">
                                                                <a class="fancybox-media hvr-grow"
                                                                    href="https://www.youtube.com/embed/o-0hcF97wy0"><img
                                                                        src="images/uploads/play-vd.png"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="vd-infor">
                                                                <h6> <a href="#">Featurette: “Avengers
                                                                        Re-Assembled</a>
                                                                </h6>
                                                                <p class="time"> 1: 03</p>
                                                            </div>
                                                        </div>
                                                        <div class="vd-item">
                                                            <div class="vd-it">
                                                                <img class="vd-img" src="images/uploads/vd-item3.jpg"
                                                                    alt="">
                                                                <a class="fancybox-media hvr-grow"
                                                                    href="https://www.youtube.com/embed/o-0hcF97wy0"><img
                                                                        src="images/uploads/play-vd.png"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="vd-infor">
                                                                <h6> <a href="#">Interview: Robert Downey Jr</a></h6>
                                                                <p class="time"> 3:27</p>
                                                            </div>
                                                        </div>
                                                        <div class="vd-item">
                                                            <div class="vd-it">
                                                                <img class="vd-img" src="images/uploads/vd-item4.jpg"
                                                                    alt="">
                                                                <a class="fancybox-media hvr-grow"
                                                                    href="https://www.youtube.com/embed/o-0hcF97wy0"><img
                                                                        src="images/uploads/play-vd.png"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="vd-infor">
                                                                <h6> <a href="#">Interview: Scarlett Johansson</a>
                                                                </h6>
                                                                <p class="time"> 3:27</p>
                                                            </div>
                                                        </div>
                                                        <div class="vd-item">
                                                            <div class="vd-it">
                                                                <img class="vd-img" src="images/uploads/vd-item1.jpg"
                                                                    alt="">
                                                                <a class="fancybox-media hvr-grow"
                                                                    href="https://www.youtube.com/embed/o-0hcF97wy0"><img
                                                                        src="images/uploads/play-vd.png"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="vd-infor">
                                                                <h6> <a href="#">Featurette: Meet Quicksilver & The
                                                                        Scarlet
                                                                        Witch</a></h6>
                                                                <p class="time"> 1: 31</p>
                                                            </div>
                                                        </div>
                                                        <div class="vd-item">
                                                            <div class="vd-it">
                                                                <img class="vd-img" src="images/uploads/vd-item2.jpg"
                                                                    alt="">
                                                                <a class="fancybox-media hvr-grow"
                                                                    href="https://www.youtube.com/embed/o-0hcF97wy0"><img
                                                                        src="images/uploads/play-vd.png"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="vd-infor">
                                                                <h6> <a href="#">Interview: Director Joss Whedon</a>
                                                                </h6>
                                                                <p class="time"> 1: 03</p>
                                                            </div>
                                                        </div>
                                                        <div class="vd-item">
                                                            <div class="vd-it">
                                                                <img class="vd-img" src="images/uploads/vd-item3.jpg"
                                                                    alt="">
                                                                <a class="fancybox-media hvr-grow"
                                                                    href="https://www.youtube.com/embed/o-0hcF97wy0"><img
                                                                        src="images/uploads/play-vd.png"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="vd-infor">
                                                                <h6> <a href="#">Interview: Mark Ruffalo</a></h6>
                                                                <p class="time"> 3:27</p>
                                                            </div>
                                                        </div>
                                                        <div class="vd-item">
                                                            <div class="vd-it">
                                                                <img class="vd-img" src="images/uploads/vd-item4.jpg"
                                                                    alt="">
                                                                <a class="fancybox-media hvr-grow"
                                                                    href="https://www.youtube.com/embed/o-0hcF97wy0"><img
                                                                        src="images/uploads/play-vd.png"
                                                                        alt=""></a>
                                                            </div>
                                                            <div class="vd-infor">
                                                                <h6> <a href="#">Official Trailer #2</a></h6>
                                                                <p class="time"> 3:27</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="title-hd-sm">
                                                        <h4>Photos <span> (21)</span></h4>
                                                    </div>
                                                    <div class="mvsingle-item">
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image11.jpg"><img
                                                                src="images/uploads/image1.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image21.jpg"><img
                                                                src="images/uploads/image2.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image31.jpg"><img
                                                                src="images/uploads/image3.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image41.jpg"><img
                                                                src="images/uploads/image4.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image51.jpg"><img
                                                                src="images/uploads/image5.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image61.jpg"><img
                                                                src="images/uploads/image6.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image71.jpg"><img
                                                                src="images/uploads/image7.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image81.jpg"><img
                                                                src="images/uploads/image8.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image91.jpg"><img
                                                                src="images/uploads/image9.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image101.jpg"><img
                                                                src="images/uploads/image10.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image111.jpg"><img
                                                                src="images/uploads/image1-1.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image121.jpg"><img
                                                                src="images/uploads/image12.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image131.jpg"><img
                                                                src="images/uploads/image13.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image141.jpg"><img
                                                                src="images/uploads/image14.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image151.jpg"><img
                                                                src="images/uploads/image15.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image161.jpg"><img
                                                                src="images/uploads/image16.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image171.jpg"><img
                                                                src="images/uploads/image17.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image181.jpg"><img
                                                                src="images/uploads/image18.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image191.jpg"><img
                                                                src="images/uploads/image19.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image201.jpg"><img
                                                                src="images/uploads/image20.jpg" alt=""></a>
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="images/uploads/image211.jpg"><img
                                                                src="images/uploads/image2-1.jpg" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            $('input[name="watch_status"]').change(function() {
                if (this.value === '0') {
                    $('#watchDateSection').show();
                    $('#reviewSection').hide();
                } else if (this.value === '1') {
                    $('#watchDateSection').hide();
                    $('#reviewSection').show();
                }
            });
        });

        $(':radio').change(function() {
            console.log('New star rating: ' + this.value);
        });

        $("#showReviewForm").submit(function(event) {
                event.preventDefault();
                formArray = $(this).serializeArray();
                var movieId = @json($movieResults['id'] ?? $seriesResults['id'] ?? null);
                $("button[type='submit']").prop('disabled', true);
                $.ajax({
                    url: '{{ route('show.review', '') }}/' + movieId,
                    type: 'post',
                    data: formArray,
                    dataType: 'json',
                    success: function(response) {
                        $("button[type='submit']").prop('disabled', false);
                        if (response['status'] == true) {
                            window.location.href = "{{ route('movies.home') }}";
                        } else {
                            console.log("error");
                        }
                    },
                    error: function() {
                        console.log("Something went wrong");
                    }
                });
            });
    </script>
@endsection
