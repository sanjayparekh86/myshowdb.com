<?php

namespace App\Http\Controllers;

use App\Models\ShowList;
use App\Models\UserRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MoviesController extends Controller
{
    public function home()
    {
        $userId = auth()->check() ? auth()->user()->id : null;

        $shows = ShowList::with([
            'userRating' => function ($query) use ($userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                }
            }
        ])
            ->latest('id')
            ->take(10)
            ->get();
        // dump($shows);
        // dump($userId);
        return view('front.movie.home', compact('shows'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.index');
    }

    public function search(Request $request)
    {

        //   print_r($request);
        //   print_r($_GET);exit;
        $search = $request->input('search');
        $searchType = $request->input('searchType', 'series'); // Default to 'series' if not provided

        $searchResults = []; // Initialize searchResults

        if (strlen($search) > 2) {
            $movieResponse = Http::withToken(config('services.movie_api.token'))
                ->get('https://api.themoviedb.org/3/search/movie', [
                    'query' => $search,
                ]);

            $webSeriesResponse = Http::withToken(config('services.movie_api.token'))
                ->get('https://api.themoviedb.org/3/search/tv', [
                    'query' => $search,
                ]);

            $movieResults = $movieResponse->json()['results'];
            $webSeriesResults = $webSeriesResponse->json()['results'];

            // Determine the search type based on the selected radio button
            if ($searchType === 'movie') {
                $searchResults = $movieResults;
                // dump($searchResults);
            } else {
                $searchResults = $webSeriesResults;
                // dump($searchResults);
            }
        } else {
            $searchResults = [];
        }

        if ($request->ajax()) {
            return response()->json(['searchResults' => $searchResults]);
        } else {

            return redirect()->route('movies.show', [
                'query' => $search,
                'searchType' => $searchType,
                'searchResults' => $searchResults,
            ]);
        }
    }

    public function show(Request $request)
    {
        $search = $request->input('search');
        $searchType = $request->input('show_type');

        $movieResults = [];
        $seriesResults = [];


        if ($searchType == 'movie') {
            $movieResults = Http::withToken(config('services.movie_api.token'))
                ->get('https://api.themoviedb.org/3/search/movie?query=' . $search . '&append_to_response=credits,images,videos')
                ->json();

            $searchType = 'movie';
        } elseif ($searchType == 'series') {
            $seriesResults = Http::withToken(config('services.movie_api.token'))
                ->get('https://api.themoviedb.org/3/search/tv?query=' . $search . '&append_to_response=credits,images,videos')
                ->json();

            $searchType = 'series';
        }
        // dump($movieResults);

        return view('front.movie.show', [
            'movieResults' => $movieResults,
            'seriesResults' => $seriesResults,
            'searchType' => $searchType,
            'search' => $search
        ]);
    }

    public function detail(Request $request)
    {
        $searchType = $request->input('type');
        $id = $request->input('id');
        $userReview = null;

        $allSession = session()->all();
        // dump($allSession);

        $movieResults = [];
        $seriesResults = [];

        $showDetails = ShowList::where('id', $id)->first();

        if ($showDetails) {

            $showDetails = json_decode($showDetails->other_details, true);


            if ($searchType == '1') {
                $searchType = 'movie';
                $movieResults = $showDetails;
            } elseif ($searchType == '0') {
                $searchType = 'series';
                $seriesResults = $showDetails;
            }

            $userReview = UserRating::where('show_list_id', $id)->first();
            // dump($movieResults);
            // dump($searchType);
        } else {
            if (empty($showDetails)) {
                if (session()->has('unsaved_review')) {

                    $userReview['watch_status'] = session()->get('unsaved_review')['watch_status'];
                    $userReview['watch_date'] = session()->get('unsaved_review')['watch_date'];
                    $userReview['user_rating'] = session()->get('unsaved_review')['user_rating'];
                    $userReview['comment'] = session()->get('unsaved_review')['comment'];
                    $userReview = json_decode(json_encode($userReview));
                }
            }
            if ($searchType == 'movie') {

                $movieResults = Http::withToken(config('services.movie_api.token'))
                    ->get("https://api.themoviedb.org/3/movie/{$id}?append_to_response=credits,images,videos")
                    ->json();

                $searchType = 'movie';
            } elseif ($searchType == 'series') {

                $seriesResults = Http::withToken(config('services.movie_api.token'))
                    ->get("https://api.themoviedb.org/3/tv/{$id}?append_to_response=credits,images,videos")
                    ->json();

                $searchType = 'series';
            }
        }


        // dump($seriesResults);
        // dump($movieResults);
        if (Auth::check() == false) {
            // Get the current URL with query parameters
            $currentUrl = url()->full();

            // Include the movie ID in the current URL if it's not already present
            if (!str::contains($currentUrl, 'id=')) {
                $currentUrl .= (Str::contains($currentUrl, '?') ? '&' : '?') . 'id=' . $id;
            }

            // Set the intended URL in the session if it's not already set
            if (!session()->has('url.intended')) {
                session(['url.intended' => $currentUrl]);
            }
        }



        return view('front.movie.show-detail', [
            'movieResults' => $movieResults,
            'seriesResults' => $seriesResults,
            'searchType' => $searchType,
            'userReview' => $userReview,
            'showDetails' => $showDetails,
            'allSession' => $allSession
        ]);
    }

    public function submitReview($id, Request $request)
    {
        $userId = auth()->user()->id;
        $searchType = $request->input('type');
        // dump($request->input('searchType'));
        // dump( $request->input('seriesResults'));
        // dump( $request->input('searchType'));
        $searchType = $request->input('searchType') == 'movie' ? 1 : 0;
        if ($searchType == 1) {
            $movieResults = json_decode($request->input('movieResults'), true);
        } elseif ($searchType == 0) {
            $seriesResults = json_decode($request->input('seriesResults'), true);
        }
        // dump($movieResults);



        $title = $searchType == 1 ? $movieResults['title'] : $seriesResults['name'];
        $releaseDate = $searchType == 1 ? $movieResults['release_date'] : $seriesResults['first_air_date'];
        $genres = $searchType == 1 ? implode(', ', array_column($movieResults['genres'], 'name')) : implode(', ', array_column($seriesResults['genres'], 'name'));
        $otherDetails = json_encode($searchType == 1 ? $movieResults : $seriesResults);

        $existingShow = ShowList::where('show_id', $id)->first();

        if ($existingShow) {
            $existingShow->update([
                'title' => $title,
                'release_date' => $releaseDate,
                'genres' => $genres,
                'other_details' => $otherDetails,
                'type' => $searchType,
            ]);

            $show = $existingShow;
        } else {
            $show = ShowList::create([
                'show_id' => $id,
                'title' => $title,
                'release_date' => $releaseDate,
                'genres' => $genres,
                'other_details' => $otherDetails,
                'type' => $searchType,
            ]);
        }

        $userRating = $request->input('user_rating');
        $comment = $request->input('comment');
        $watchDate = $request->input('watch_date');
        $watchStatus = $request->input('watch_status');

        $existingUserRating = UserRating::where('show_list_id', $show->id)->where('user_id', $userId)->first();

        if (session()->get('unsaved_review')) {
            Session()->forget('unsaved_review');
        }

        if ($existingUserRating) {
            $existingUserRating->update([
                'user_rating' => $userRating,
                'comment' => $comment,
                'watch_date' => $watchDate,
                'watch_status' => $watchStatus,
            ]);

            $review = $existingUserRating;
        } else {
            $review = UserRating::create([
                'show_list_id' => $show->id,
                'user_id' => $userId,
                'user_rating' => $userRating,
                'comment' => $comment,
                'watch_date' => $watchDate,
                'watch_status' => $watchStatus,
            ]);
        }

        $request->session()->flash('success', 'Review saved successfully');

        return response()->json([
            'status' => true,
            'message' => 'success',
            'review' => $review,
        ]);
    }

    public function sessionStore(Request $request)
    {
        $data = $request->all();

        // Store the data in the session
        $request->session()->put('unsaved_review', $data);
        // dd($data);
        // Return a response indicating success
        return response()->json([
            'status' => true,
            'message' => 'Data stored in session successfully',
            'data' => $data,
        ]);
    }

}
