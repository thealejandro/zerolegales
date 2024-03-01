<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\MailRepository;
use App\Repository\UserRepository;
use Auth;

class MailController extends Controller
{
    public function __construct(UserRepository $userRepo,MailRepository $mailRepo)
    {
        $this->userRepo = $userRepo;
        $this->mailRepo = $mailRepo;
    }
    public function cancelSubscription()
    {
        $auth_id = Auth::user()->id;

        $user = $this->userRepo->getUser($auth_id);

        $cancel_subscription = $this->mailRepo->cancelSubscriptionMail($user);
      
        if ($cancel_subscription) {
            
            $json_data = array("status" => "success");
                    
        } 
        if ($cancel_subscription == false) {

            $json_data = array("status" => "error");
            
        }  
        return response()->json($json_data);
    }
    public function renewalSubscription()
    {
        $auth_id = Auth::user()->id;

        $user = $this->userRepo->getUser($auth_id);

        $renewal_subscription = $this->mailRepo->renewalSubscriptionMail($user);
      
        if ($renewal_subscription) {
            
            $json_data = array("status" => "success");
                    
        } 
        if ($renewal_subscription == false) {

            $json_data = array("status" => "error");
            
        }  
        return response()->json($json_data);
    }

    public function changeSubscription()
    {
        $auth_id = Auth::user()->id;

        $user = $this->userRepo->getUser($auth_id);

        $change_subscription = $this->mailRepo->changeSubscriptionMail($user);
      
        if ($change_subscription) {
            
            $json_data = array("status" => "success");
                    
        } 
        if ($change_subscription == false) {

            $json_data = array("status" => "error");
            
        }  
        return response()->json($json_data);
    }

    public function successPayment()
    {
        $auth_id = Auth::user()->id;

        $user = $this->userRepo->getUser($auth_id);

        $payment = $this->mailRepo->successPaymentMail($user);
      
        if ($payment) {
            
            $json_data = array("status" => "success");
                    
        } 
        if ($payment == false) {

            $json_data = array("status" => "error");
            
        }  
        return response()->json($json_data);
    }
    public function subscriptionPurchase()
    {
        $auth_id = Auth::user()->id;

        $user = $this->userRepo->getUser($auth_id);

        $purchase = $this->mailRepo->subscriptionPurchaseMail($user);
      
        if ($purchase) {
            
            $json_data = array("status" => "success");
                    
        } 
        if ($purchase == false) {

            $json_data = array("status" => "error");
            
        }  
        return response()->json($json_data);
    }
}
