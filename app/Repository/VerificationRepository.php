<?php

namespace App\Repository;


use App\VerifyUser;
use Exception;


class VerificationRepository
{

    public function getVerifyUser($token)
    {
        try {
            $verifyUser = VerifyUser::where('token', $token)->first();
            return $verifyUser;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
}