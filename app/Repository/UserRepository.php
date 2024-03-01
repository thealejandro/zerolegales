<?php

namespace App\Repository;


use App\User;
use App\VerifyUser;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use DB;
use App\TermsAndCondition;

class UserRepository
{
    public function all(){
        try {

            $users =  User::orderBy('id', 'DESC')->get();
            return $users;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function saveUser($data){
        try {

            DB::beginTransaction();

            $user = new User();
            $user->first_name = $data['first_name'];
            $user->surname = $data['surname'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->terms_conditions = $data['terms_conditions'];
            $user->user_type=1;
            $user->save();


            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);

            $data = array(
                'user_name'         => $user->full_name ,
                'user_email'        => $user->email ,
                'token'             => $verifyUser->token
            );
            Mail::to($data['user_email'])->send(new VerificationMail($data));

            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }  

            DB::commit();  

            return $user;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function statusChange($data)
    {
        try {
            $userStatus = User::find($data['id']);
            $userStatus->is_active = $data['status'];
            $userStatus->save();
            return true;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getUserData($data){
        try {

            $user = User::find($data['id']);

            return $user;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function getUser($id){
        try {

            $user = User::find($id);

            return $user;
        } catch (Exception $e) {

            logger()->error($e);
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