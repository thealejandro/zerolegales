<?php

namespace App\Repository;
use Illuminate\Support\Facades\Auth;
use Exception;
use DB;
use App\User;
use App\TermsAndCondition;

class ForgotRepository
{
    public function getUserData($email){
        try {
            $user =  User::where('email',$email)->where('is_active',1)->first();
            return $user;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function updatePassword($data)
    {
        try {
            $password = $data['password'];
            $user = User::whereId($data['id'])->update(['password' => $password]);
            return $user;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getTermsAndCondition(){
        try {

            $conditions = TermsAndCondition::first();
            return $conditions;

        }
    catch (Exception $e) {
        return false;

    }
}
   
}