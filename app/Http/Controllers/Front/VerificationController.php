<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\VerificationRepository;

class VerificationController extends Controller
{
    public function __construct(VerificationRepository $verifyRepo)
    {
        $this->verifyRepo = $verifyRepo;
    }
    public function verifyUser($token)
    {
        $verifyUser = $this->verifyRepo->getVerifyUser($token);
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->email_verified_at = now();
                $verifyUser->user->save();
                \Auth::login($user); 
            } 
            // else {
            //     $status = "Your e-mail is already verified. You can now login.";
            // }
        } 
        // else {
        //     return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        // }
        return view('front.user.mail_verification');
       
    }

}
