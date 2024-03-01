<?php
  
namespace App\Http\Controllers\Front;
  
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;
use Illuminate\Support\Facades\Hash;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
            $first_name = $user->offsetGet('given_name');
            $last_name = $user->offsetGet('family_name');
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser!= null){
                if($finduser['is_active'] != 1) {
                    return redirect('login')->with('modal_message_error', 'Al parecer hubo un error al ingresar porque su usuario se encuentra desactivado. Porfavor contactar a soporte.');
                }
            }
           
            if($finduser){
     
                Auth::login($finduser);
    
                return redirect()->intended('document');
     
            }else{
               
                $my_user = User::where('email','=', $user->getEmail())->first();

                if($my_user === null){

                    $newUser = User::create([
                        'first_name' => $first_name,
                        'surname'=> $last_name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => Hash::make('password'),
                        'terms_conditions'=>1,
                        'user_type'=>1,
                        'user_image'=>$user->getAvatar(),
                        'email_verified_at' => now(),
                    ]);
                    //$newUser->markEmailAsVerified();
        
                    Auth::login($newUser);
         
                    return redirect()->intended('document');
                }
                else{
                    return redirect('user/create')->with('error','La identificación de correo electrónico ya se ha tomado.');
                }
                
            }
    
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
}