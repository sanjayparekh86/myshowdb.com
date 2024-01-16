@extends('front.layouts.app')
@section('content')
    <div class="buster-light">
        <div class="hero common-hero">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hero-ct">
                            <h1> movie listing - list</h1>
                            <ul class="breadcumb">
                                <li class="active"><a href="#">Home</a></li>
                                <li> <span class="ion-ios-arrow-right"></span> movie listing</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="searh-form">
                        <form class="form-style-1" action="{{ route('movies.show') }}" method="get" id="searchForm">
                            <h4 class="sb-title">Search for Show</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="show_type" id="flexRadioDefault1"
                                    value="series">
                                <label class="form-check-label" for="show_type">
                                    Series
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="show_type" id="flexRadioDefault2"
                                    value="movie">
                                <label class="form-check-label" for="show_type">
                                    Movie
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-it">
                                    <label>Show Name</label>
                                    <input type="text" placeholder="Enter keywords" name="search" id="searchInput"
                                        value="{{ $search }}">
                                </div>
                            </div>
                        </form>
                    </div>
                    @if ($searchType == 'movie')
                        @foreach ($movieResults['results'] as $movie)
                            <div class="movie-item-style-2">
                                <img src="{{ 'https://image.tmdb.org/t/p/w92' . $movie['poster_path'] }}" alt="">
                                <div class="mv-item-infor">
                                    <h6><a href="{{ route('show.detail', ['type' => 'movie', 'id' => $movie['id']]) }}">{{ $movie['title'] }}
                                            <span>({{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }})</span></a>
                                    </h6>
                                    <p class="rate"><i
                                            class="ion-android-star"></i><span>{{ number_format($movie['vote_average'], 1) }}</span>
                                        /10</p>
                                    <p class="describe">{{ \Illuminate\Support\Str::limit($movie['overview'], 250, '...') }}
                                    </p>
                                    <span>Release:
                                        {{ \Carbon\Carbon::parse($movie['release_date'])->format('j F Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    @elseif ($searchType == 'series')
                        @foreach ($seriesResults['results'] as $series)
                            <div class="movie-item-style-2">
                                <img src="{{ 'https://image.tmdb.org/t/p/w92' . $series['poster_path'] }}" alt="">
                                <div class="mv-item-infor">
                                    <h6><a href="{{ route('show.detail', ['type' => 'series', 'id' => $series['id']]) }}">{{ $series['name'] }}
                                            <span>({{ \Carbon\Carbon::parse($series['first_air_date'])->format('Y') }})</span></a>
                                    </h6>
                                    <p class="rate"><i
                                            class="ion-android-star"></i><span>{{ number_format($series['vote_average'], 1) }}</span>
                                        /10</p>
                                    <p class="describe">{{ \Illuminate\Support\Str::limit($series['overview'], 250, '...') }}</p>
                                    <p class="run-time"> Run Time: N/A <span>Release:
                                            {{ \Carbon\Carbon::parse($series['first_air_date'])->format('j F Y') }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{-- pagination --}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('customJs')
    <script>
        console.log("hii");
    </script>
@endsection
