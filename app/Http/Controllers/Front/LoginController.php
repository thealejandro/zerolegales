<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Redirect;
use App\User;
use App\TermsAndCondition;
class LoginController extends Controller
{
  
    public function login(){
        $conditions = TermsAndCondition::first();
        return view('front.user.login')->with(['conditions'=> $conditions]);
    }
    public function authenticate(Request $request)
    {
        try {
            $remember_me = false;
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($request->has('remember')) {
                $remember_me = true; 
            }
            $credentials = $request->only('email', 'password');
            $user = User::where('email',$request->email)->first();
            if($user != null){
                if (!(Hash::check($request->password, $user['password']))) {
                    $errors = new MessageBag(['password' => ['La contraseña no es la correcta.']]);
                    return Redirect::back()->withErrors($errors)->withInput($request->except('password'));
                }
                if($user['is_active'] != 1) {
                    return redirect('login')->with('modal_message_error', 'Al parecer hubo un error al ingresar porque su usuario se encuentra desactivado. Porfavor contactar a soporte.');
                }
                if($user['verified'] == 0){

                    return redirect('login')->with('modal_verification_error', 'Hemos enviado un mensaje a su correo electrónico. Por favor revíselo y verifique su cuenta haciendo clic en el botón. Si no lo recibió, verifique en su bandeja de correo no deseado.');
                }  
                if (Auth::attempt($credentials,$remember_me,$user['is_active'] == 1)) {
                    if($user['subscription_status'] == 1) {
                        return redirect()->intended('prices');
                    }                                    
                    if($user['verified'] == 1) {
                        
                        return redirect()->intended('document');
                    }
                }
                else{
                    return redirect('login')->with('modal_login_error', 'Al parecer hubo un error al ingresar.Puede intentar ingresar nuevamente para solucionar el error.');
                }
            }
            $errors = new MessageBag(['email' => ['No hay ninguna cuenta con este correo. Pruebe de nuevo.']]);
            return Redirect::back()->withErrors($errors)->withInput($request->except('password'));
    
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function logout() {
        Auth::logout();
        return redirect(\URL::previous());
        // return redirect('login');
    }
    
}
