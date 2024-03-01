<?php

namespace App\Repository;
use Illuminate\Support\Facades\Auth;
use App\PriceMatrix;
use App\User;
use App\Model\Invoice;
use App\Model\PurchasedSubscription;
use App\Model\CancelSubscription;
use Exception;
use DB;


class PriceRepository
{
    public function getStandardSubscription(){
        try {
            $prices =  PriceMatrix::where('payment_type','=','Monthly')->where('subscription_id','=',2)->value('price');
            return $prices;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getPremiumSubscription(){
        try {
            $prices =  PriceMatrix::where('payment_type','=','Monthly')->where('subscription_id','=',3)->value('price');
            return $prices;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getubscription(){
        try {
            $prices =  PriceMatrix::where('subscription_id','!=',1)->get();
            return $prices;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function listStandardSubscription($data){
        try {
            $prices =  PriceMatrix::where(['payment_type'=>$data['payment_type']])->where('subscription_id','=',2)->value('price','id');
            return $prices;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function listPremiumSubscription($data){
        try {
            $prices =  PriceMatrix::where(['payment_type'=>$data['payment_type']])->where('subscription_id','=',3)->value('price','id');
            return $prices;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getSubscriptionData($price){
        try {
            $prices =  PriceMatrix::where('price',$price)->first();
            return $prices;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function updateSubscription($update)
    {
        try {
            $id = Auth::guard('web')->user()->id;
            $subscription = PurchasedSubscription::where('user_id',$id)
            ->update($update);
            $user = User::where('id',$id)->update(['user_type'=>2]);
            $data = CancelSubscription::where('user_id',$id)->where('is_active',1)->update(['is_active'=>0]);
            return $subscription;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getUserData($id){
        try {
            $user =  User::where('id',$id)->where('is_active',1)->first();
            return $user;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getCreditData($id){
        try {
            $data =  CancelSubscription::where('user_id',$id)->where('is_active',1)->first();
            return $data;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function createInvoice($data){
        try {
            $invoice = Invoice::create($data);
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getPurchasedSubscription($id){
        try {
            $subscription = PurchasedSubscription::with('priceMatrice')->with('subscriptionType')
            ->where('user_id',$id)
            ->where('purchased_subscriptions.is_active',1)
            ->first();
            return $subscription;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}