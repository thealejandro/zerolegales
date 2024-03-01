<?php

namespace App\Repository;


use App\InputVariable;
use Exception;
use App\InputVariableType;

class InputVariableRepository
{

    public function all(){
        try {

            $variables =  InputVariable::with('variableType')->orderBy('id', 'DESC')->where('user_relation','=',0)->get();
            return $variables;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function saveInputVariable($data,$auth_id){
        try {

            $variable = new InputVariable();
            $variable->variable_name = $data['variable_name'];
            $variable->variable_type = $data['variable_type'];
            $variable->created_by = $auth_id;
            $variable->document_id = $data['document_id'];
            $variable->save();

            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function getInputVariable($id)
    {
        try {
            $variable = InputVariable::with('variableType')->findOrFail($id);
            return $variable;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function updateInputVariable($data,$id,$auth_id)
    {
        try {

            $variableUpdate =InputVariable::findOrFail($id);
            $variableUpdate->variable_name = $data['variable_name'];
            $variableUpdate->variable_type = $data['variable_type'];
            $variableUpdate->updated_by = $auth_id;
            $variableUpdate->save();

            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function deleteInputVariable($data)
    {
        try {
            $variable =  InputVariable::findOrFail($data['id']);
            $variable->deleted_by =$data['auth_id'];
            $variable->save();
            $variable->delete();
            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function allInputVariableTypes(){
        try {

            $types =  InputVariableType::all();
            return $types;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
}