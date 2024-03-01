<?php

namespace App\Repository;


use App\TermsAndCondition;
use Exception;


class TermsAndConditionsRepository
{
    public function all(){
        try {
            $terms =  TermsAndCondition::orderBy('id', 'DESC')->get();
            return $terms;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    // public function saveCondition($data,$auth_id){
    //     try {
    //         $condition = new TermsAndCondition();
    //         $condition->terms_conditions = $data['terms_conditions'];
    //         $condition->created_by = $auth_id;
    //         $condition->save();

    //         return true;
    //     } catch (Exception $e) {

    //         logger()->error($e);
    //         return false;
    //     }
    // }
    public function getCondition($id)
    {
        try {
            $condition = TermsAndCondition::findOrFail($id);
            return $condition;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function updateCondition($data, $id,$auth_id)
    {
        try {

            $conditionUpdate = TermsAndCondition::findOrFail($id);
            $conditionUpdate->condition_text = $data['condition_text'];
            $conditionUpdate->updated_by = $auth_id;
            $conditionUpdate->save();

            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }

}