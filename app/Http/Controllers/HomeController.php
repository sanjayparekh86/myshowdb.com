<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Mail;
use Exception;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banners::orderBy('id', 'DESC')->get();
        $movieResults = Http::withToken(config('services.movie_api.token'))->get('https://api.themoviedb.org/3/movie/top_rated')->json();
        $seriesResults = Http::withToken(config('services.movie_api.token'))->get('https://api.themoviedb.org/3/tv/top_rated')->json();
        $upcoming = Http::withToken(config('services.movie_api.token'))->get('https://api.themoviedb.org/3/movie/upcoming')->json();
        $nowPlaying = Http::withToken(config('services.movie_api.token'))->get('https://api.themoviedb.org/3/movie/now_playing')->json();
        $movieProvider = Http::withToken(config('services.movie_api.token'))->get('https://api.themoviedb.org/3/watch/providers/movie')->json();
        $tvProvider = Http::withToken(config('services.movie_api.token'))->get('https://api.themoviedb.org/3/watch/providers/tv')->json();

        $combinedProviders = array_merge($movieProvider['results'], $tvProvider['results']);
        $final = [];
        $recordLimit = 20;
        $counter = 0;
        foreach ($combinedProviders as $k => $v) {
            $final[$v['provider_name']] = $v;
            $counter++;

            if ($counter >= $recordLimit) {
                break;
            }
        }
        usort($final, function ($a, $b) {
            return $a['display_priority'] <=> $b['display_priority'];
        });

        $data['banner'] = $banner;
        $data['upcoming'] = $upcoming;
        $data['nowPlaying'] = $nowPlaying;
        $data['movieResults'] = $movieResults;
        $data['seriesResults'] = $seriesResults;
        $data['combinedProviders'] = $combinedProviders;
        $data['final'] = $final;
        // dump($final);
        return view('front.index', $data);
    }

    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'nick_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->passes()) {
            $user = new User([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'nick_name' => $request->nick_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'social_id' => null, // Set default value for social_id
                'register_from' => 'manual', // Set register_from for manual registration
            ]);
            $user->save();

            session()->flash('success', 'You have been register successfully');

            return response()->json([
                'status' => true,
                'message' => ''
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'));
                }

                return response()->json(['success' => true, 'redirect' => route('movies.home')]);
            } else {
                return response()->json(['success' => false, 'error' => 'Either email/password is incorrect']);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }
    }

    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            return $this->handleRegistration($user, 'google');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function facebookpage()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookcallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            return $this->handleRegistration($user, 'facebook');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    private function handleRegistration($userData, $source)
    {
        $findUser = User::where('social_id', $userData->id)
            ->where('register_from', $source)
            ->first();

        if ($findUser) {
            Auth::login($findUser);
        } else {
            $newUser = User::create([
                'email' => $userData->email,
                'social_id' => $userData->id,
                'register_from' => $source,
                'password' => Hash::make('123456dummy'),
            ]);

            Auth::login($newUser);
        }

        return redirect()->route('movies.home');
    }

    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        // dump($user);
        $isGoogleUser = Auth::user()->social_id !== null;
        return view('front.profile.profile', [
            'user' => $user,
            'isGoogleUser' => $isGoogleUser
        ]);
    }

    public function forgotPassword()
    {
        return view('front.password.forgot-password');
    }

    public function processForgotPassword(Request $request)
    {
        // Validate the email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $password = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);

        $user = User::where('email', $request->input('email'))->first();
        $user->password = bcrypt($password);
        $user->save();

        Mail::to($user->email)->send(new ForgotPassword($user, $password));

        session()->flash('success', 'Your password has sent in email has successfully');
        return response()->json([
            'status' => true,
            'message' => 'Sent email successfully',
        ]);
    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $isGoogleUser = Auth::user()->google_id !== null;
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'nick_name' => 'required',
            'email' => $isGoogleUser ? 'required|email' : 'required|email|unique:users,email,' . $userId . ',id'
        ]);

        if ($validator->passes()) {
            $user = User::find($userId);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->nick_name = $request->nick_name;
            if (!$isGoogleUser) {
                $user->email = $request->email;
            }
            $user->save();

            session()->flash('success', 'Profile Updated Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Profile Updated Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {
            $user = User::select('id', 'password')->where('id', Auth::user()->id)->first();
            // dd($user);
            if (!Hash::check($request->old_password, $user->password)) {
                session()->flash('error', 'Your old password is incorrect, please try again');
                return response()->json([
                    'status' => true,
                ]);
            }

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            session()->flash('success', 'Password change successfully');

            return response()->json([
                'status' => true,
                'message' => 'Password change successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function term_condition()
    {
        return view('front.static-pages.term_condition');
    }
    public function private_policy()
    {
        return view('front.static-pages.private_policy');
    }

    public function about()
    {
        return view('front.static-pages.about');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        // dd($page);
        return view('front.static-pages.page', [
            'page' => $page
        ]);
    }
}
