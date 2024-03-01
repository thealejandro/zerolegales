<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\InvoiceData;

class InvoiceDataController extends Controller
{

    public function __construct()
    {
        $this->user =  \Auth::guard('web');
    }
    public function index()
    {
        return view('front.user.invoice-request-data');
    }

    public function saveSubscribedInvoiceData($id,$isCheck,$nit="",$name="",$address="")
    {
       $user_id = $this->user->user()->id;
       if($isCheck == 'nit'){
           $data = [
               'nit' => $nit,
               'name' => $name,
               'address' => $address,
           ];
            $validatedData = \Validator::make($data, [
                'nit' => 'required|regex:/[a-zA-Z0-9\s]+/',
                'name' => 'required|regex:/[a-zA-Z0-9\s]+/',
                'address' => 'required|regex:/[a-zA-Z0-9\s]+/',
            ]);
            if ($validatedData->fails()) {
                return response()->json(['status' => false, 'message' => $validatedData->messages(), 'error' => 0]);
            }
        
            $saveData = new InvoiceData;
            $saveData->invoice = 0;
            $saveData->user_id = $user_id;
            $saveData->subscription_transaction = $id;
            $saveData->nit = $nit;
            $saveData->customer_name = $name;
            $saveData->customer_address = $address;
            $saveData->save();
            return response()->json(['status' => true, 'message' => 'Invoice data created successfully']);

       } else {
            $saveData = new InvoiceData;
            $saveData->invoice = 1;
            $saveData->user_id = $user_id;
            $saveData->subscription_transaction = $id;
            $saveData->save();
            return response()->json(['status' => true, 'message' => 'Invoice data created successfully']);
       }

    }

    public function saveDocumentInvoiceData($id,$isCheck,$nit="",$name="",$address="")
    {

       $user_id = $this->user->user()->id;
       if($isCheck == 'nit'){
           $data = [
               'nit' => $nit,
               'name' => $name,
               'address' => $address,
           ];
            $validatedData = \Validator::make($data, [
                'nit' => 'required|regex:/[a-zA-Z0-9\s]+/',
                'name' => 'required|regex:/[a-zA-Z0-9\s]+/',
                'address' => 'required|regex:/[a-zA-Z0-9\s]+/',
            ]);
            if ($validatedData->fails()) {
                return response()->json(['status' => false, 'message' => $validatedData->messages(), 'error' => 0]);
            }
        
            $saveData = new InvoiceData;
            $saveData->invoice = 0;
            $saveData->user_id = $user_id;
            $saveData->document_transaction = $id;
            $saveData->nit = $nit;
            $saveData->customer_name = $name;
            $saveData->customer_address = $address;
            $saveData->save();
            return response()->json(['status' => true, 'message' => 'Invoice data created successfully']);

       } else {
            $saveData = new InvoiceData;
            $saveData->invoice = 1;
            $saveData->user_id = $user_id;
            $saveData->document_transaction = $id;
            $saveData->save();
            return response()->json(['status' => true, 'message' => 'Invoice data created successfully']);
       }

    }
}
