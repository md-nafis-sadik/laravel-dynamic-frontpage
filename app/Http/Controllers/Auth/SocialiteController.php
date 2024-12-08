<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication()
    {
        try {
            // Get the Google User
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                ->user();

            // Check if the user already exists
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // Login the user if exists
                Auth::login($user);
                return redirect()->intended(route('dashboard'));
            } else {
                // Create a new user if not exists
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('Password@1234'), // Default password
                    'google_id' => $googleUser->id,
                ]);

                // Log the newly created user in
                Auth::login($userData);

                return redirect()->intended(route('dashboard'));
            }

        } catch (Exception $e) {
            // Log error and redirect to login page
            \Log::error('Google Authentication Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Google authentication failed.']);
        }
    }

    // Facebook Login
    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook Callback for Authentication
    public function facebookAuthentication()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            $user = User::where('facebook_id', $facebookUser->getId())->first();

            if ($user) {
                Auth::login($user);
                return redirect()->intended(route('dashboard'));
            } else {
                $userData = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'password' => Hash::make('Password@1234'), // Default password
                    'facebook_id' => $facebookUser->getId(),
                ]);

                Auth::login($userData);
                return redirect()->intended(route('dashboard'));
            }
        } catch (Exception $e) {
            \Log::error('Facebook Authentication Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Facebook authentication failed.']);
        }
    }
}

