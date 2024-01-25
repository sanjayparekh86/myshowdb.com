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
                                <li class="active"><a href="{{ route('movies.home') }}">Home</a></li>
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
                            @if ($shows)
                                @foreach ($shows as $show)
                                    @if ($show->userRating)
                                        <div class="movie-item-style-2 movie-item-style-1">
                                            @php
                                                $otherDetails = json_decode($show->other_details, true);
                                                $posterPath = $otherDetails['poster_path'] ?? null;
                                            @endphp
                                            <img src="{{ 'https://image.tmdb.org/t/p/w500' . $posterPath }}" alt="">
                                            <div class="hvr-inner">
                                                <a
                                                    href="{{ route('show.detail', ['type' => $show->type, 'id' => $show->id]) }}">
                                                    Edit Status <i class="ion-android-arrow-dropright"></i>
                                                </a>
                                            </div>
                                            <div class="mv-item-infor">
                                                <h6><a
                                                        href="{{ route('show.detail', ['type' => $show->type, 'id' => $show->id]) }}">{{ $show->title }}</a>
                                                </h6>
                                                <p class="rate">
                                                    <span>{{ $show->userRating->watch_status == 1 ? 'Already Watched' : 'Want to Watch' }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <h3>Hello </h3>
                            @endif
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
