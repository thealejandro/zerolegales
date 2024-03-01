<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
use Exception;
use Illuminate\Support\Facades\Hash;

class FacebookController extends Controller
{
    public function redirectToFacebook() {

        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback() {
        try {
            $user = Socialite::driver('facebook')->fields(['name', 'first_name', 'last_name', 'email'
            ])->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if($finduser!= null){
                if($finduser['is_active'] != 1) {
                    return redirect('login')->with('modal_message_error', 'Al parecer hubo un error al ingresar porque su usuario se encuentra desactivado. Porfavor contactar a soporte.');
                }
            }
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('document');
            } else {
                 
                $my_user = User::where('email','=', $user->getEmail())->first();

                if($my_user === null){

                    $newUser = User::create(['first_name' => $user->user['first_name'], 'surname'=>$user->user['last_name'],'email' => $user->email,'email_verified_at' => now(),
                    'facebook_id' => $user->id,'password' => Hash::make('password'),'terms_conditions'=>1,'user_type'=>1,'user_image'=>$user->getAvatar()]);
                     //$newUser->markEmailAsVerified();
                    Auth::login($newUser);
                    return redirect()->intended('document');
                }
                else{
                    return redirect('user/create')->with('error','La identificación de correo electrónico ya se ha tomado.');
                }
            }
        }
        catch(Exception $e) {
            logger()->error($e);
            return false;
        }
    }
}
