<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Repository\ForgotRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
        

class ForgotPasswordController extends Controller
{
    private $forgotRepo;


    public function __construct(forgotRepository $forgotRepo)
    {
        $this->forgotRepo=$forgotRepo;
    }

    /**
     * view forgot password blade
     */
    public function forgotPassword(){
        $conditions = $this->forgotRepo->getTermsAndCondition();
        return view('front.user.forgot-password')->with(['conditions'=>$conditions]);
    }
    
    /**
     * send forgot mail
     */
    public function sendForgotMail(Request $request)
    {
        $validatedData = \Validator::make($request->all(), [
            'email' =>  'required|email|exists:users,email',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['status' => false, 'message' => $validatedData->messages(), 'error' => 0]);
        }
        $email = $request->email;
        $user_data = $this->forgotRepo->getUserData($email);
        $data = [
            'email' => $email,
            'user_id' => $user_data['id'],
            'name' => $user_data['first_name'],
        ];
        Mail::to($email)->send(new ForgotPasswordMail($data)); 
        return response()->json(['status' => true, 'message' => 'success']);             
    }

    public function sendForgotMailSuccess()
    {
        return view('front.user.forgot-password-success');
    }

    public function newPasswordView($id)
    {
        return view('front.user.new-password',compact('id'));
    }

    public function newpasswordUpdate(Request $request)
    {
        $validatedData = \Validator::make($request->all(), [
            'password'=>'required|min:8',
            'confirm_password'=>'required|min:8',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['status' => false, 'message' => $validatedData->messages(), 'error' => 0]);
        }
        $data = [
            'password' => bcrypt($request->password),
            'id'    =>  $request->user_id
        ];
        $update = $this->forgotRepo->updatePassword($data);
        return response()->json(['status' => true, 'message' => 'success']);
    }

    public function newPasswordSuccess()
    {
        return view('front.user.new-password-success');
    }
}
