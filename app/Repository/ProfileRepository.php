<?php

namespace App\Repository;
use Illuminate\Support\Facades\Auth;
use Exception;
use DB;
use App\User;
use App\Model\PurchasedSubscription;
use App\Model\CancelSubscription;
use App\PriceMatrix;
use App\Model\Invoice;


class ProfileRepository
{
    public function getUserData($id){
        try {
            $user =  User::where('id',$id)->where('is_active',1)->first();
            return $user;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function updateProfilePic($data)
    {
        try {
            $id = Auth::guard('web')->user()->id;
            $user = User::whereId($id)->update(['user_image' => $data,'image_type' => 1]);
            return $user;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateAccountInfo($data)
    {
        try {
            $id = Auth::guard('web')->user()->id;
            $user = User::whereId($id)->update($data);
            return $user;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updatePersonalInfo($data)
    {
        try {
            $id = Auth::guard('web')->user()->id;
            $user = User::whereId($id)->update($data);
            return $user;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getSubscriptionData()
    {
        try {
            $id = Auth::guard('web')->user()->id;
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
    public function cancelSubscriptionWithoutCredit()
    {
        try {
            $id = Auth::guard('web')->user()->id;
            $data = [
                'grade_status' => 3,
                'grade_date'   => date('Y-m-d H:i:s'),
                'is_active'    => 0,
            ];
            $subscription = PurchasedSubscription::where('user_id',$id)
            ->where('is_active',1)
            ->update($data);

            $cancelData = new CancelSubscription;
            $cancelData->purchase_id = $subscription;
            $cancelData->save();

            $user = User::where('id',$id)->update(['user_type' => 1]);
            return $subscription;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function cancelSubscriptionKeepCredit()
    {
        try {
            $id = Auth::guard('web')->user()->id;
            $subscription = PurchasedSubscription::with('priceMatrice')->with('subscriptionType')
            ->where('user_id',$id)
            ->where('purchased_subscriptions.is_active',1)
            ->first();
            $currentDate = date('Y-m-d H:i:s');
            $temp = $subscription['created_at']->diff($currentDate);
            $usedDays = $temp->format('%r%a');
            $usedMonths = round($usedDays/30);
            $balanceMonth = 12 - $usedMonths;
            $tempAmount = $subscription['priceMatrice']['price'] / 12;
            $creditAmount = round($balanceMonth * $tempAmount);
            $data = [
                'grade_status' => 3,
                'grade_date'   => date('Y-m-d H:i:s'),
                'is_active'    => 0,
            ];

            $update = PurchasedSubscription::where('user_id',$id)
            ->where('is_active',1)
            ->update($data);

            $cancelData = new CancelSubscription;
            $cancelData->purchase_id = $subscription['id'];
            $cancelData->credit_amount = $creditAmount;
            $cancelData->user_id = $id;
            $cancelData->is_active = 1;
            $cancelData->save();
            $temp = [
                'user_type' => 1,
                'subscription_status'   =>  1
            ];
            $user = User::where('id',$id)->update($temp);
            return $subscription;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    
    public function cancelSubscriptionKeepBalanceCredit($amount,$s_id)
    {
        try {
            $id = Auth::guard('web')->user()->id;
            
            $cancelData = new CancelSubscription;
            $cancelData->purchase_id = $s_id;
            $cancelData->credit_amount = $amount;
            $cancelData->user_id = $id;
            $cancelData->is_active = 1;
            $cancelData->save();
            // $temp = [
            //     'user_type' => 1,
            //     'subscription_status'   =>  1
            // ];
            // $user = User::where('id',$id)->update($temp);
            return $cancelData;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function newSubscriptionData($data)
    {
        $result = PriceMatrix::where('payment_type',$data->priceMatrice['payment_type'])
                    ->where('subscription_id','!=',$data->priceMatrice['subscription_id'])
                    ->where('deleted_at',NULL)
                    ->first();
        return $result;
    }

    public function getPricematrixData($id)
    {
        $result = PriceMatrix::where('id',$id)
                    ->where('deleted_at',NULL)
                    ->first();
        return $result;
    }

    public function newSubscriptionDetails($data)
    {
        try {
            // $id = Auth::guard('web')->user()->id;
            $subscription = PurchasedSubscription::with('priceMatrice')->with('subscriptionType')
            ->where('price_matrices.payment_type',$data->priceMatrice['payment_type'])
            ->where('price_matrices.subscription_id','!=',$data->priceMatrice['subscription_id'])
            ->first();
            return $subscription;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateSubscription($update)
    {
        try {
            $id = Auth::guard('web')->user()->id;
            $subscription = PurchasedSubscription::where('user_id',$id)
            ->update($update);
            return $subscription;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getInvoice($id){
        try {
            $auth_id = Auth::guard('web')->user()->id;
            $invoice = Invoice::where('transaction_uuid',$id)->where('user_id',$auth_id)->where('is_pay',0)->first();
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function updateInvoice($id,$txn){
        try {
            $invoice = Invoice::where('id',$id)->update(['is_pay'=>1,'transaction_id'=>$txn]);
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function updateCreditData($id){
        try {
            $data = CancelSubscription::where('user_id',$id)->where('is_active',1)->update(['is_active'=>0]);
            return $data;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function savePurchase($invoice){
        try {
            $auth_id = Auth::guard('web')->user()->id;
            $currentDate = date('Y-m-d H:i:s');
            $type = PriceMatrix::where('id',$invoice['price_id'])
                    ->first();
            if($type['payment_type'] == 'Annual'){
                $days = 364;
                $expire_date =  date('Y-m-d', strtotime($currentDate. ' + '.$days.' days'));
                
            } else {
                $days = 30;
                $expire_date =  date('Y-m-d', strtotime($currentDate. ' + '.$days.' days'));
            }
            $data = [
                'user_id' => $auth_id,
                'subscription_id' => $invoice['subscription_id'],
                'price_matrice_id' => $invoice['price_id'],
                'is_active' => 1,
                'expire_date' => $expire_date,
            ];
            // dd($data);
            $result = PurchasedSubscription::create($data);
            $user = User::where('id',$auth_id)->update(['user_type'=>2]);
            return $result;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function updatePurchase($invoice)
    {
        try{
            $auth_id = Auth::guard('web')->user()->id;
            $currentDate = date('Y-m-d H:i:s');
            $type = PriceMatrix::where('id',$invoice['price_id'])
                    ->first();
            if($type['payment_type'] == 'Annual'){
                $days = 364;
                $expire_date =  date('Y-m-d', strtotime($currentDate. ' + '.$days.' days'));
            } else {
                $days = 30;
                $expire_date =  date('Y-m-d', strtotime($currentDate. ' + '.$days.' days'));
            } 
            if($invoice['subscription_id'] == 2){
                $status = 1;
            } else {
                $status = 2;
            }
            $data = [
                'subscription_id' => $invoice['subscription_id'],
                'price_matrice_id' => $invoice['price_id'],
                'grade_status'  =>  $status,
                'grade_date' => $currentDate,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
                'is_active' => 1,
                'expire_date' => $expire_date,
            ];
            $update = PurchasedSubscription::where('user_id',$auth_id)->update($data);
            return  $update;
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
    public function getSubscriptionCategory($auth_id){
        try {
            $subscriptionCategory = User::leftJoin('purchased_subscriptions','purchased_subscriptions.user_id','=','users.id')
            ->where('users.id',$auth_id)
            ->select('purchased_subscriptions.subscription_id')
            ->first();
        return $subscriptionCategory;
    } catch (Exception $e) {
        logger()->error($e);
        return false;
    }
    }
    public function getUser($auth_id){
        try {
            $user = User::where('id',$auth_id)->first();
            return $user;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }
}