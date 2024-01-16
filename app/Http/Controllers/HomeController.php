<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index');
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
                return response()->json(['success' => true, 'redirect' => route('movie.home')]);
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
}
