@extends('front.layouts.app')
@section('content')
    <div class="buster-light">
        <div class="hero common-hero">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hero-ct">
                            <h1> Watch List</h1>
                            <ul class="breadcumb">
                                <li class="active"><a href="#">Home</a></li>
                                <li> <span class="ion-ios-arrow-right"></span> movie listing</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-single">
            <div class="container">
                <div class="row ipad-width">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="flex-wrap-movielist">
                            @foreach ($shows as $show)
                                @if ($show->userRating)
                                    <div class="movie-item-style-2 movie-item-style-1">
                                        @php
                                            $otherDetails = json_decode($show->other_details, true);
                                            $posterPath = $otherDetails['poster_path'] ?? null;
                                        @endphp
                                        <img src="{{ 'https://image.tmdb.org/t/p/w500' . $posterPath }}" alt="">
                                        <div class="hvr-inner">
                                            <a href="{{route('show.detail', ['type' => $show->type, 'id' => $show->id])}}"> Edit Status <i class="ion-android-arrow-dropright"></i>
                                            </a>
                                        </div>
                                        <div class="mv-item-infor">
                                            <h6><a href="{{route('show.detail', ['type' => $show->type, 'id' => $show->id])}}">{{$show->title}}</a></h6>
                                            <p class="rate">
                                                <span>{{ $show->userRating->watch_status == 1 ? 'Already Watched' : 'Want to Watch' }}</span>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <div class="searh-form">
                                <form class="form-style-1" action="{{ route('movies.show') }}" method="get"
                                    id="searchForm">
                                    <h4 class="sb-title">Search for Show</h4>
                                    <div class="form-check">
                                        {{-- <input type="hidden" id="searchType" name="searchType" value="series"> --}}
                                        <input class="form-check-input" type="radio" name="show_type"
                                            id="flexRadioDefault1" value="series">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Series
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="show_type"
                                            id="flexRadioDefault2" value="movie">
                                        <label class="form-check-label" for="show_type">
                                            Movie
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-it">
                                            <label>Show Name</label>
                                            <input type="text" placeholder="Enter keywords" name="search"
                                                id="searchInput">
                                        </div>

                                        <div class="col-md-12 ">
                                            <input class="submit" type="submit" value="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {

            $('input[name="flexRadioDefault"]').on('change', function() {
                // Update the hidden input value when the radio button changes
                $('#searchType').val($(this).val());
            });

            function searchMovies(type, value) {
                $.ajax({
                    url: '{{ route('movies.search') }}',
                    method: 'get',
                    data: {
                        search: value,
                        searchType: type
                    },
                    success: function(data) {
                        var searchResults = data.searchResults;
                        window.location.href = '{{ route('movies.show') }}?query=' + value +
                            '&searchType=' + type + '&searchResults=' + JSON.stringify(
                                searchResults);

                    },
                    error: function(error) {
                        console.error('Error fetching search results:', error);
                    }
                });
            }
        });
    </script>
@endsection
