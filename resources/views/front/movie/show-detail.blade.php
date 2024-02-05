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

    .rating input[type="radio"]:checked+label {
        color: #ffcc00;
        /* Checked star color */
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
        color: white;
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
                    </div>
                </div>
            </div>
            <div class="page-single movie-single movie_single">
                <div class="container">
                    <div class="row ipad-width2">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="movie-img sticky-sb">
                                @if ($searchType == 'movie')
                                    <img src="{{ 'https://image.tmdb.org/t/p/original' . $movieResults['poster_path'] }}"
                                        alt="">
                                @elseif ($searchType == 'series')
                                    <img src="{{ 'https://image.tmdb.org/t/p/original' . $seriesResults['poster_path'] }}"
                                        alt="">
                                @endif
                                <div class="movie-btn">
                                    <div class="btn-transform transform-vertical red">
                                        <div><a href="#" class="item item-1 redbtn"> <i class="ion-play"></i> Watch
                                                Trailer</a></div>
                                        <div>
                                            @if ($searchType == 'movie')
                                                @if (isset($movieResults['videos']['results']) && !empty($movieResults['videos']['results']))
                                                    @php
                                                        $firstVideoKey = $movieResults['videos']['results'][0]['key'] ?? null;
                                                    @endphp
                                                    @if ($firstVideoKey)
                                                        <a href="https://youtube.com/watch?v={{ $firstVideoKey }}"
                                                            class="item item-2 redbtn fancybox-media hvr-grow"><i
                                                                class="ion-play"></i></a>
                                                    @else
                                                        <p>No trailer available for this movie</p>
                                                    @endif
                                                @else
                                                    <p>No video results available for this movie</p>
                                                @endif
                                            @elseif ($searchType == 'series')
                                                @if (isset($seriesResults['videos']['results']) && !empty($seriesResults['videos']['results']))
                                                    @php
                                                        $firstVideoKey = $seriesResults['videos']['results'][0]['key'] ?? null;
                                                    @endphp
                                                    @if ($firstVideoKey)
                                                        <a href="https://youtube.com/watch?v={{ $firstVideoKey }}"
                                                            class="item item-2 redbtn fancybox-media hvr-grow"><i
                                                                class="ion-play"></i></a>
                                                    @else
                                                        <p>No trailer available for this series</p>
                                                    @endif
                                                @else
                                                    <p>No video results available for this series</p>
                                                @endif
                                            @endif


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
                                <div class="movie-rate">
                                    <div class="rate">
                                        <i class="ion-android-star"></i>
                                        @if ($searchType == 'movie')
                                            <p><span>{{ number_format($movieResults['vote_average'], 1) }}</span> /10<br>
                                            @elseif ($searchType == 'series')
                                            <p><span>{{ number_format($seriesResults['vote_average'], 1) }}</span> /10<br>
                                        @endif
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
                                <div class="check">
                                    <input type="hidden" name="movieResults" value="{{ json_encode($movieResults) }}">
                                    <input type="hidden" name="seriesResults" value="{{ json_encode($seriesResults) }}">
                                    <input type="hidden" name="searchType" value="{{ $searchType }}">
                                    <div class="check-box" style="display: flex; gap: 15px">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="watch_status"
                                                id="wantToWatch" value="0"
                                                {{ old('watch_status', $userReview ? $userReview->watch_status : '') == '0' ? 'checked' : '' }}>
                                            <label class="" for="wantToWatch" style="color: white">
                                                Want to Watch
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="" type="radio" name="watch_status"
                                                id="alreadyWatched" value="1"
                                                {{ old('watch_status', $userReview ? $userReview->watch_status : '') == '1' ? 'checked' : '' }}>
                                            <label class="" for="alreadyWatched" style="color: white">
                                                Already Watched
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="watchDateSection"
                                    style="display: {{ $userReview && $userReview->watch_date ? 'block' : 'none' }}; margin-top: 17px;">
                                    <!-- Input fields related to "Want to Watch" section go here -->
                                    <div class="watch" style="    display: flex; gap: 6px">
                                        <label for="watch_date" style="color: white">Watch Date:</label>
                                        <input type="date" id="watchDate" name="watch_date"
                                            value="{{ old('watch_date', $userReview ? $userReview->watch_date : '') }}"
                                            style="width: 15rem">
                                        <input class="submit" type="submit" value="submit"
                                            style="background-color: #dd003f;
                                            color: #ffffff;
                                            padding: 5px 19px;
                                            -webkit-border-radius: 20px;
                                            -moz-border-radius: 20px;
                                            border-radius: 20px">
                                    </div>
                                </div>
                                <div id="reviewSection"
                                    style="display: {{ old('watch_status', $userReview ? $userReview->watch_status : '') == '1' ? 'block' : 'none' }}; margin-top: 4px;">
                                    <!-- Input fields related to "Already Watched" section go here -->
                                    <div class="review" style="display: flex; gap: 3rem">
                                        <div class="rating">
                                            <label>
                                                <input type="radio" name="user_rating" value="1"
                                                    {{ $userReview && $userReview->user_rating == 1 ? 'checked' : '' }} />
                                                <span class="icon">★</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="user_rating" value="2"
                                                    {{ $userReview && $userReview->user_rating == 2 ? 'checked' : '' }} />
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="user_rating" value="3"
                                                    {{ $userReview && $userReview->user_rating == 3 ? 'checked' : '' }} />
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="user_rating" value="4"
                                                    {{ $userReview && $userReview->user_rating == 4 ? 'checked' : '' }} />
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="user_rating" value="5"
                                                    {{ $userReview && $userReview->user_rating == 5 ? 'checked' : '' }} />
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                                <span class="icon">★</span>
                                            </label>
                                        </div>
                                        <div id="alreadyDate"
                                            style="display: {{ $userReview && $userReview->watch_date ? 'block' : 'none' }}; margin-top: 3px;">
                                            <!-- Input fields related to "Want to Watch" section go here -->
                                            <label for="watch_date" style="color: white">Watch Date:</label>
                                            <input type="date" id="watchDate" name="watch_date"
                                                value="{{ old('watch_date', $userReview ? $userReview->watch_date : '') }}">
                                        </div>
                                    </div>
                                        <label for="comment" style="color: white">Comment:</label>
                                        <textarea id="comment" name="comment" style="width: 388px; height: 98px">{{ old('comment', $userReview ? $userReview->comment : '') }}</textarea>
                                    <button type="submit" style="background-color: #dd003f;
                                    color: #ffffff;
                                    padding: 5px 19px;
                                    -webkit-border-radius: 20px;
                                    -moz-border-radius: 20px;
                                    border-radius: 20px; margin: 4px">Submit Review</button>
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
                                                            {{-- <a href="#" class="time">All 5 Videos & 245 Photos <i
                                                                    class="ion-ios-arrow-right"></i></a> --}}
                                                        </div>
                                                        <div class="mvsingle-item ov-item">
                                                            @if ($searchType == 'movie')
                                                                @php $counter = 0; @endphp
                                                                @foreach ($movieResults['images']['posters'] as $photo)
                                                                    @if ($counter < 4)
                                                                        <a class="img-lightbox"
                                                                            data-fancybox-group="gallery"
                                                                            href="{{ 'https://image.tmdb.org/t/p/original' . $photo['file_path'] }}"><img
                                                                                src="{{ 'https://image.tmdb.org/t/p/original' . $photo['file_path'] }}"
                                                                                alt="" style="width: 95px;"></a>
                                                                        @php $counter++; @endphp
                                                                    @else
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                        @elseif ($searchType == 'series')
                                                            @php $counter = 0; @endphp
                                                            @foreach ($seriesResults['images']['posters'] as $photo)
                                                                @if ($counter < 4)
                                                                    <a class="img-lightbox"
                                                                        data-fancybox-group="gallery"
                                                                        href="{{ 'https://image.tmdb.org/t/p/original' . $photo['file_path'] }}"><img
                                                                            src="{{ 'https://image.tmdb.org/t/p/original' . $photo['file_path'] }}"
                                                                            alt="" style="width: 95px;"></a>
                                                                    @php $counter++; @endphp
                                                                @else
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endif
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
                                                                    <img src="{{ $cast['profile_path'] ? 'https://image.tmdb.org/t/p/w92' . $cast['profile_path'] : 'https://img.freepik.com/premium-vector/user-profile-icon-flat-style-member-avatar-vector-illustration-isolated-background-human-permission-sign-business-concept_157943-15752.jpg' }}"
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
                                                        @if ($searchType == 'movie' || $searchType == 'series')
                                                            @php
                                                                $directorName = $movieResults['credits']['crew'][0]['name'] ?? '';
                                                                $nameParts = explode(' ', $directorName);
                                                                $firstNameInitial = substr($nameParts[0], 0, 1) ?? '';
                                                                $surnameInitial = isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : '';
                                                            @endphp

                                                            <h4>{{ $firstNameInitial . $surnameInitial }}</h4>
                                                            <a href="#">{{ $directorName }}</a>
                                                        @endif
                                                    </div>
                                                    <p>... Director</p>
                                                </div>
                                            </div>
                                            <!-- //== -->
                                            <div class="title-hd-sm">
                                                <h4>Directors & Credit Writers</h4>
                                            </div>
                                            <div class="mvcast-item">
                                                @if ($searchType == 'movie')
                                                    @foreach ($movieResults['credits']['crew'] as $crew)
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                @php
                                                                    // Extract the first letters of the first name and surname
                                                                    $firstNameInitial = substr($crew['name'], 0, 1);
                                                                    $surnameInitial = substr(strrchr($crew['name'], ' '), 1, 1);
                                                                @endphp
                                                                <h4>{{ $firstNameInitial . $surnameInitial }}</h4>
                                                                <a href="#">{{ $crew['name'] }}</a>
                                                            </div>
                                                            <p>... ({{ $crew['job'] }})</p>
                                                        </div>
                                                    @endforeach
                                                @elseif ($searchType == 'series')
                                                    @foreach ($seriesResults['credits']['crew'] as $crew)
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                @php
                                                                    // Extract the first letters of the first name and surname
                                                                    $firstNameInitial = substr($crew['name'], 0, 1);
                                                                    $surnameInitial = substr(strrchr($crew['name'], ' '), 1, 1);
                                                                @endphp
                                                                <h4>{{ $firstNameInitial . $surnameInitial }}</h4>
                                                                <a href="#">{{ $crew['name'] }}</a>
                                                            </div>
                                                            <p>... ({{ $crew['job'] }})</p>
                                                        </div>
                                                    @endforeach
                                                @endif
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
                                                                <img src="{{ $cast['profile_path'] ? 'https://image.tmdb.org/t/p/w92' . $cast['profile_path'] : 'https://img.freepik.com/premium-vector/user-profile-icon-flat-style-member-avatar-vector-illustration-isolated-background-human-permission-sign-business-concept_157943-15752.jpg' }}"
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
                                                                <img src="{{ $cast['profile_path'] ? 'https://image.tmdb.org/t/p/w92' . $cast['profile_path'] : 'https://img.freepik.com/premium-vector/user-profile-icon-flat-style-member-avatar-vector-illustration-isolated-background-human-permission-sign-business-concept_157943-15752.jpg' }}"
                                                                    alt="" style="width: 16%;">
                                                                <a href="#">{{ $cast['name'] }}</a>
                                                            </div>
                                                            <p>... {{ $cast['name'] }}</p>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <!-- //== -->
                                        </div>
                                    </div>
                                    <div id="media" class="tab">
                                        <div class="row">
                                            <div class="rv-hd">
                                                <div>
                                                    <h3>Photos of</h3>
                                                    @if ($searchType == 'movie')
                                                        <h2>{{ $movieResults['title'] }}</h2>
                                                    @elseif($searchType == 'series')
                                                        <h2>{{ $seriesResults['name'] }}</h2>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="title-hd-sm">
                                                <h4>Photos</h4>
                                            </div>
                                            <div class="mvsingle-item">
                                                @if ($searchType == 'movie')
                                                    @foreach (array_merge($movieResults['images']['posters'], $movieResults['images']['backdrops']) as $photo)
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="{{ 'https://image.tmdb.org/t/p/original' . $photo['file_path'] }}"><img
                                                                src="{{ 'https://image.tmdb.org/t/p/original' . $photo['file_path'] }}"
                                                                alt="" style="width: 107px;"></a>
                                                    @endforeach
                                                @elseif ($searchType == 'series')
                                                    @foreach (array_merge($seriesResults['images']['posters'], $seriesResults['images']['backdrops']) as $photo)
                                                        <a class="img-lightbox" data-fancybox-group="gallery"
                                                            href="{{ 'https://image.tmdb.org/t/p/original' . $photo['file_path'] }}"><img
                                                                src="{{ 'https://image.tmdb.org/t/p/original' . $photo['file_path'] }}"
                                                                alt="" style="width: 107px;"></a>
                                                    @endforeach
                                                @endif
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
                $('#alreadyDate').hide();
            } else if (this.value === '1') {
                $('#reviewSection').show();
                $('#watchDateSection').hide();
                $('#alreadyDate').show();
            }
        });
        $('input[name="watch_status"]:checked').trigger('change');
    });

    $(':radio').change(function() {
        console.log('New star rating: ' + this.value);
    });

    $("#showReviewForm").submit(function(event) {
        event.preventDefault();
        formArray = $(this).serializeArray();
        var movieId = @json($movieResults['id'] ?? ($seriesResults['id'] ?? null));

        if (!{{ auth()->check() ? 'true' : 'false' }}) {
            $(".loginLink").click()

            {{ Session(['url.intended' => url()->current()]) }}
            return false;
        }
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
