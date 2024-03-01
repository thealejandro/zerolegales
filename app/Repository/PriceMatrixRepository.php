<?php

namespace App\Repository;


use App\PriceMatrix;
use Exception;
use App\SubscriptionType;
use App\LegalDocumentTemplate;

class PriceMatrixRepository
{

    public function all(){
        try {

            $prices =  PriceMatrix::with('subscription')->where('subscription_id','!=',1)->orderBy('id', 'DESC')->get();
            return $prices;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getSubscriptionTypes(){
        try {
            $types = SubscriptionType::where('id','!=',1)->get();
            return $types;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }

    public function getDocuments(){
        try {
            $documents = LegalDocumentTemplate::all();
            return $documents;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function savePrice($data,$auth_id){
        try {
                $price = new PriceMatrix();
                $price->subscription_id = $data['subscription_id'];
                if(isset($data['payment_type'])){
                    $price->payment_type = $data['payment_type'];
                }
                $price->price = $data['price'];
                $price->created_by = $auth_id;
                $price->save();
                return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function updatePrice($data,$auth_id){
        try {        
                $price = PriceMatrix::find($data['id']);
                $price->subscription_id = $data['subscription_id'];            
                if(($data['subscription_id'] == '2'||$data['subscription_id'] == '3')){                   
                    $price->payment_type = $data['payment_type'];
                }         
                $price->price = $data['price'];
                $price->updated_by = $auth_id;
                $price->save();
                return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function getPriceMatrix($id){
        try {
            $price = PriceMatrix::find($id);
            return $price;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function deletePriceMatrix($data)
    {
        try {
            $price =  PriceMatrix::findOrFail($data['id']);
            $price->deleted_by =$data['auth_id'];
            $price->save();
            $price->delete();
            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function getPriceDocument($document_id){
        try {
            $price = PriceMatrix::where('document_id',$document_id)->first();
            return $price;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function getPriceSubscription($payment_type,$subscription_id){
        try {
            $price = PriceMatrix::where('payment_type',$payment_type)->where('subscription_id',$subscription_id)->first();
            return $price;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
}