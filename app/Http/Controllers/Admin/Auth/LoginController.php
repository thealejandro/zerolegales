<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use App\Admin;
use Redirect;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */    
    public function index()
    {
        return view('admin.login');
    }
    public function adminLogin(Request $request)
    {
    
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
          $email = $request->input('email');
          $password = $request->input('password');

          if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect('admin/dashboard');
          }
        $errors = new MessageBag(['email' => [__('test.invalid')]]);
        return Redirect::back()->withErrors($errors)->withInput($request->except('password'));

    }
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect (('system-admin-login'));
    }
 
}
