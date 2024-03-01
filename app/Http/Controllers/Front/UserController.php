<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\UserRepository;

class UserController extends Controller
{
    private $userRepo;


    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conditions = $this->userRepo->getTermsAndCondition();  
        return view('front.user.register')->with(['conditions'=>$conditions]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'surname' => 'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required|min:8',
            'terms_conditions' => 'required',

        ]);
        $data = $request->all();
        $user = $this->userRepo->saveUser($data);
        if ($user) {
            if($user['verified'] == 0) {

                return view('front.user.registration_complete');
            }   
            // else{
            //     return redirect('login')->with('modal_login_error', 'Al parecer hubo un error al ingresar.Puede intentar ingresar nuevamente para solucionar el error.');
            // }     
        }
        if ($user == false) {
            return redirect('user/create')->with('error', __('test.error-msg'));
        }
    }
   /**
    * Mail Verfication Page send through verification mail
    */
    public function mailVerification()
    {
        return view('front.user.verification');
    }

    public function registerComplete()
    {
        return view('front.user.registration_complete');
    }
    
}
