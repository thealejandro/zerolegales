<?php

namespace App\Repository;

use Illuminate\Support\Facades\Mail;
use App\Mail\CancelSubscriptionMail;
use App\Mail\RenewalSubscriptionMail;
use App\Mail\ChangeSubscriptionMail;
use App\Mail\PaymentMail;
use App\Mail\SubscriptionPurchaseMail;
use Exception;

class MailRepository
{
    public function cancelSubscriptionMail($user,$subData){
        try {
            if($subData['subscription_id'] == 2 && $subData['payment_type'] == 'Monthly'){
                $subscription_name = "Suscripción mensual estándar";
            }elseif($subData['subscription_id'] == 2 && $subData['payment_type'] == 'Annual'){
                $subscription_name = "suscripción anual estándar";
            }elseif($subData['subscription_id'] == 3 && $subData['payment_type'] == 'Monthly'){
                $subscription_name = "Suscripción mensual premium";
            }elseif($subData['subscription_id'] == 3 && $subData['payment_type'] == 'Annual'){
                $subscription_name = "Suscripción anual premium";
            } else {
                $subscription_name ="";
            }

            $data = array(
                'user_name'         => $user->full_name ,
                'user_email'        => $user->email ,
                'subscription_name' => $subscription_name,
            );        
            Mail::to($data['user_email'])->send(new cancelSubscriptionMail($data));

            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }   
                             
        return $data;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function renewalSubscriptionMail($user){
        try {
      
            $data = array(
                'user_name'         => $user->full_name ,
                'user_email'        => $user->email ,
            );
            Mail::to($data['user_email'])->send(new renewalSubscriptionMail($data));

            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }   
                             
        return $data;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function changeSubscriptionMail($user){
        try {
      
            $data = array(
                'user_name'         => $user->full_name ,
                'user_email'        => $user->email ,
            );
            Mail::to($data['user_email'])->send(new changeSubscriptionMail($data));

            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }   
                             
        return $data;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function successPaymentMail($user){
        try {
      
            $data = array(
                'user_name'         => $user->full_name ,
                'user_email'        => $user->email ,
            );
            Mail::to($data['user_email'])->send(new PaymentMail($data));

            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }   
                             
        return $data;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function subscriptionPurchaseMail($userData,$transaction_type,$amount,$u_id){
        try {
            $currentDate = date('Y-m-d');
            $data = array(
                'user_name'         => $userData['first_name'].' '.$userData['surname'],
                'user_email'        => $userData['email'],
                'subscription'      => $transaction_type,
                'price'             => $amount,
                'transaction_uuid'  => $u_id,
                'current_date'      => $currentDate,
            );
            Mail::to($data['user_email'])->send(new SubscriptionPurchaseMail($data));

            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }   
                             
        return $data;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function subscriptionChangeMail($data){
        try {
      
            Mail::to($data['user_email'])->send(new ChangeSubscriptionMail($data));
            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }   
                             
        return $data;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

}