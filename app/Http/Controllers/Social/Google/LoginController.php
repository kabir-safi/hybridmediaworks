<?php

namespace App\Http\Controllers\Social\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Auth;
use Hash;
use Storage;

class LoginController extends Controller {

    /**
     * redirect to Google
     */
    public function redirectToGoogle() {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('google')->scopes(["https://www.googleapis.com/auth/calendar"])->with($parameters)->redirect();
    }

    /**
     * handle Google Callback
     * check user exists or not
     * auth access token store in json
     */
    public function handleGoogleCallback() {
        try {
            $auth_user = Socialite::driver('google')->user();
            $finduser = User::where('email', $auth_user->email)->first();
//            $authAccessToken = '{
//                "access_token": "' . $auth_user->token . '",
//                "token_type": "' . $auth_user->token . '",
//                "refresh_token": "' . $auth_user->refreshToken . '",
//                "expires_in": "' . $auth_user->expiresIn . '",
//                "id_token": "' . $auth_user->token . '"
//            }';
//            Storage::put('google-calendar/oauth-token.json', $authAccessToken);
            if ($finduser):
                Auth::login($finduser);
                return redirect()->intended('home');
            else:
                $newUser = User::create([
                            'name' => $auth_user->name,
                            'email' => $auth_user->email,
                            'google_id' => $auth_user->id,
                            'refresh_token' => $auth_user->token,
                            'password' => Hash::make($auth_user->name)
                ]);
                Auth::login($newUser);
                return redirect()->intended('/home');
            endif;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
