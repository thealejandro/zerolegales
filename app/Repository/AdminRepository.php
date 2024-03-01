<?php

namespace App\Repository;


use App\User;
use App\PriceMatrix;
use Exception;


class AdminRepository
{
    public function listUsers($data){
        try
        {
            $userData = User::leftjoin('purchased_subscriptions','purchased_subscriptions.user_id','users.id')
            ->where('users.is_active',1)->select('users.first_name','users.last_name','users.email','users.created_at','purchased_subscriptions.subscription_id','purchased_subscriptions.expire_date');
            // ->where('purchased_subscriptions.is_active',1);
            if ($data['search'] != '')
            {
                $userData->where('first_name', 'LIKE', '%'.$data['search'].'%');
            }

            if($data['column'] == 0)
                $userData->orderBy('users.id',$data['order']);
            if($data['column'] == 1)
                $userData->orderBy('users.first_name',$data['order']);
            if($data['column'] == 2)
                $userData->orderBy('users.email',$data['order']);
            if($data['column'] == 3)
                $userData->orderBy('users.created_at',$data['order']);
            if($data['column'] == 4)
                $userData->orderBy('purchased_subscriptions.subscription_id',$data['order']);
            if($data['column'] == 5)
                $userData->orderBy('users.created_at',$data['order']);
            // $total  = Invoice::count();

            $total  = User::count();

            return ['total' => $total, 'userData' => $userData ];

        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }


    public function listSubscription($data){
        try
        {
            $subscriptionData = PriceMatrix::with('subscription')->with('document'); 
            // dd($subscriptionData);
            if ($data['search'] != '')
            {
                $subscriptionData->where('first_name', 'LIKE', '%'.$data['search'].'%');
            }

            if($data['column'] == 0)
                $subscriptionData->orderBy('id',$data['order']);
            if($data['column'] == 1)
                $subscriptionData->orderBy('id',$data['order']);
            if($data['column'] == 2)
                $subscriptionData->orderBy('id',$data['order']);
            if($data['column'] == 3)
                $subscriptionData->orderBy('id',$data['order']);
            // if($data['column'] == 4)
            //     $userData->orderBy('purchased_subscriptions.subscription_id',$data['order']);
            // if($data['column'] == 5)
            //     $userData->orderBy('users.created_at',$data['order']);
            // $total  = Invoice::count();

            $total  = PriceMatrix::count();

            return ['total' => $total, 'subscriptionData' => $subscriptionData ];

        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
}