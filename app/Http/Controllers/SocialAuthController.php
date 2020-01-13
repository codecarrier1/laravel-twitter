<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Laravel\Socialite\Contracts\Provider;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\User;
use Auth;
use DB;

class SocialAuthController extends Controller
{
     public function callback($provider)
    {
     //ok.   Great  Then is there permission? yes..    How to set it? 1 min i will check and inform ok
     
      //  $callbackResponse= Socialite::driver("twitter")->user();
        //echo $callbackResponse->token;
        //echo "<pre>";print_r($callbackResponse);exit;
        $user = $this->createOrGetUser(Socialite::driver("twitter"));
        
       //auth()->login($user);
        //$oauth_token = $request->input("oauth_token");
        
        //You should get Access_token here ok sir
        //$access_token = $callbackResponse['token'];
        //return $access_token;
        
        return redirect()->to('/');
    }

    public function redirect($provider)
    {
      ///like this you can find the permisasion needed for add block and add here   ok.->scopes(['read:user', 'public_repo'])
        return Socialite::driver($provider)->redirect();
    }  
     public function login()
    {
         return redirect()->to('/login');
    }
 
    private function createOrGetUser(Provider $provider)
    {
 
        $providerUser = $provider->user();
    
        $providerName = class_basename($provider);
      

        $user = User::whereProvider($providerName)
            ->whereProviderId($providerUser->getId())
            ->first();
        // error occured    did you see?yes
        if (!$user)
        {
            $user = User::create([
                'remember_token' => $providerUser->token,
                'token_secret' => $providerUser->tokenSecret,
                'name' => $providerUser->getName(),
                'provider_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);
        }
        
        return $user;
    }
 
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
