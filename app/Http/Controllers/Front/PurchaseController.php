<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\PurchaseRepository;
use App\Repository\LegalizationRepository;
use App\Repository\PriceMatrixRepository;
use Carbon\Carbon;
use Auth;
use App\Repository\LegalDocumentTemplateRepository;
use Response;
use PDF;

class PurchaseController extends Controller
{
    public function __construct(PurchaseRepository $purchaseRepo,LegalizationRepository $legalizationRepo,PriceMatrixRepository $priceRepo,LegalDocumentTemplateRepository $templateRepo)
    {
        $this->purchaseRepo = $purchaseRepo;
        $this->legalizationRepo = $legalizationRepo;
        $this->priceRepo = $priceRepo;
        $this->templateRepo = $templateRepo;
    }
    
    public function storeBuyFillDocumentPurchase($id,$txn){
        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        $update_invoice = $this->purchaseRepo->updateInvoice($invoice['id'],$txn);
        
        if($invoice){

            $purchase = $this->purchaseRepo->saveBuyFillDocumentPurchase($invoice,$auth_id);
              
            if ($purchase == true) {

                $json_data = array("status" => "success",'redirect' => '../../../../document-filling/buy-fill/'.$purchase['document_id'].'/'.$purchase['invoice_id']);

            }
            if ($purchase == false) {

                $json_data = array("status" => "error");
            }
      
            return response()->json(['status' => true, 'message' => 'Success! Subscription Purchsed']);
        }
        return response()->json(['status' => false, 'message' => 'Success! Subscription Purchsed']);

    }
    public function storeFillBuyDocumentPurchase($id,$txn){

        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        $update_invoice = $this->purchaseRepo->updateInvoice($invoice['id'],$txn);

        if($invoice){

            $purchase = $this->purchaseRepo->saveFillBuyDocumentPurchase($invoice,$auth_id);
              
            if ($purchase == true) {

                $json_data = array("status" => "success",'redirect' => '../../../../../../document-purchase/after/'.$purchase['document_id'].'/'.$purchase['document_template_id']); 
            }
            if ($purchase == false) {

                $json_data = array("status" => "error");
            }
      
            return response()->json($json_data);
        }

    }


    public function storeFillBuyPurchase($id,$txn){

        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        $update_invoice = $this->purchaseRepo->updateInvoice($invoice['id'],$txn);
        
        if($invoice){
            $details = $this->legalizationRepo->getLegalisationDetails($invoice['legalization_id']);

            $user = $this->legalizationRepo->getUser($invoice['user_id']);
        
            $lawyer = $this->legalizationRepo->getDirectory($details['directory_id']);
           
            $template =$this->legalizationRepo->getTemplate($invoice['document_id']);

            $table = strtolower($template->document_name);

            $template_table = $this->legalizationRepo->templateTableName($table);

            $document = $this->legalizationRepo->documentFilling($invoice['document_id'],$invoice['document_template_id'],$invoice['user_id'], $template_table);

            $purchase = $this->purchaseRepo->saveFillBuyPurchase($invoice,$auth_id,$details,$user,$lawyer,$document,$template);

            if ($purchase == true) {

                    $json_data = array("status" => "success",'redirect' => '../../../../../../document-purchase/after/'.$purchase['document_id'].'/'.$purchase['document_template_id']); 

            }
            if ($purchase == false) {

                $json_data = array("status" => "error");
            }  
        }
      
        return response()->json($json_data);

    }

    public function storeLegalisationPurchase($id,$txn){
        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        $update_invoice = $this->purchaseRepo->updateInvoice($invoice['id'],$txn);
        
        if($invoice){
            
            $details = $this->legalizationRepo->getLegalisationDetails($invoice['legalization_id']);

            $user = $this->legalizationRepo->getUser($invoice['user_id']);
        
            $lawyer = $this->legalizationRepo->getDirectory($details['directory_id']);
           
            $template =$this->legalizationRepo->getTemplate($invoice['document_id']);

            $table = strtolower($template->document_name);

            $template_table = $this->legalizationRepo->templateTableName($table);

            $document_required = $this->templateRepo->getDocumentRequired($invoice['document_id']);

            $document = $this->legalizationRepo->documentFilling($invoice['document_id'],$invoice['document_template_id'],$invoice['user_id'], $template_table);

            $purchase = $this->purchaseRepo->saveLegalisationPurchase($invoice,$auth_id,$details,$user,$lawyer,$document,$template,$document_required);

                if ($purchase == true) {

                        $json_data = array("status" => "success",'redirect' => '../../../../../../document-purchase/after/'.$purchase['document_id'].'/'.$purchase['document_template_id']);
                    
                }
                if ($purchase == false) {

                    $json_data = array("status" => "error");
                }
         
        }
      
        return response()->json($json_data);

    }
    public function storeChecklistPurchase($id,$txn){
        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        $update_invoice = $this->purchaseRepo->updateInvoice($invoice['id'],$txn);

        $template = $this->templateRepo->getTemplate($invoice['document_id']);  

        $name = 'checklist'.date('YmdHis') . ".pdf";

        $pdf = PDF::loadView('front.pdf.checklist', compact('template'))->setPaper('a4','protrait');

        $file = storage_path('app/public/checklists').'/'.$name;

        $pdf->save($file);

        return response()->download($file);

    }

    public function storeLegalisationMyFolder($id,$txn)
    {
        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        $update_invoice = $this->purchaseRepo->updateInvoice($invoice['id'],$txn);

        if($invoice){
                            
            $details = $this->legalizationRepo->getLegalisationDetails($invoice['legalization_id']);

            $user = $this->legalizationRepo->getUser($invoice['user_id']);
        
            $lawyer = $this->legalizationRepo->getDirectory($details['directory_id']);
        
            $template =$this->legalizationRepo->getTemplate($invoice['document_id']);

            $table = strtolower($template->document_name);

            $template_table = $this->legalizationRepo->templateTableName($table);

            $document_required = $this->templateRepo->getDocumentRequired($invoice['document_id']);

            $document = $this->legalizationRepo->documentFilling($invoice['document_id'],$invoice['document_template_id'],$invoice['user_id'], $template_table);

            $purchase = $this->legalizationRepo->saveLegalisationPurchase($invoice,$auth_id,$details,$user,$lawyer,$document,$template,$document_required);


            if ($purchase) {
                
                        $json_data = array("status" => "success",'redirect' => '../../../../../../myfolders/show/'.$purchase['document_id'].'/'.$purchase['document_template_id']);          
            } 
            if ($purchase == false) {

                $json_data = array("status" => "error");
                
            }           
            
        }
        return response()->json($json_data);
    }

    // redirect

    public function storeBuyFillDocumentPurchaseRedirect($id,$txn){
        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        if($invoice){

            $json_data = array("status" => "success",'redirect' => '../../../../document-filling/buy-fill/'.$invoice['document_id'].'/'.$invoice['id']);
        }
        if ($invoice == false) {

            $json_data = array("status" => "error");
        }
        return response()->json($json_data);

    }
    public function storeFillBuyDocumentPurchaseRedirect($id,$txn){

        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);

        if($invoice){

            // $purchase = $this->purchaseRepo->saveFillBuyDocumentPurchase($invoice,$auth_id);
              
            // if ($purchase == true) {

                $json_data = array("status" => "success",'redirect' => '../../../../../../document-purchase/after/'.$invoice['document_id'].'/'.$invoice['document_template_id']); 
            // }
            
      
            
        }
        if ($invoice == false) {

            $json_data = array("status" => "error");
        }
        return response()->json($json_data);

    }


    public function storeFillBuyPurchaseRedirect($id,$txn){

        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        
        if($invoice){
            // $details = $this->legalizationRepo->getLegalisationDetails($invoice['legalization_id']);

            // $user = $this->legalizationRepo->getUser($invoice['user_id']);
        
            // $lawyer = $this->legalizationRepo->getDirectory($details['directory_id']);
           
            // $template =$this->legalizationRepo->getTemplate($invoice['document_id']);

            // $table = strtolower($template->document_name);

            // $template_table = $this->legalizationRepo->templateTableName($table);

            // $document = $this->legalizationRepo->documentFilling($invoice['document_id'],$invoice['document_template_id'],$invoice['user_id'], $template_table);

            // $purchase = $this->purchaseRepo->saveFillBuyPurchase($invoice,$auth_id,$details,$user,$lawyer,$document,$template);

            // if ($invoice == true) {

                    $json_data = array("status" => "success",'redirect' => '../../../../../../document-purchase/after/'.$invoice['document_id'].'/'.$invoice['document_template_id']); 

            // }
            if ($invoice == false) {

                $json_data = array("status" => "error");
            }  
        }
      
        return response()->json($json_data);

    }

    public function storeChecklistPurchaseRedirect($id,$txn){
        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);

        $template = $this->templateRepo->getTemplate($invoice['document_id']);  

        $name = 'checklist'.date('YmdHis') . ".pdf";

        $pdf = PDF::loadView('front.pdf.checklist', compact('template'))->setPaper('a4','protrait');

        $file = storage_path('app/public/checklists').'/'.$name;

        $pdf->save($file);

        // return response()->download($file);

        return response()->Json(['status' => true ,'template' => $template, 'message' => 'download pdf']);

    }


    public function storeLegalisationPurchaseRedirect($id,$txn){
        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        
        if($invoice){
            
            // $details = $this->legalizationRepo->getLegalisationDetails($invoice['legalization_id']);

            // $user = $this->legalizationRepo->getUser($invoice['user_id']);
        
            // $lawyer = $this->legalizationRepo->getDirectory($details['directory_id']);
           
            // $template =$this->legalizationRepo->getTemplate($invoice['document_id']);

            // $table = strtolower($template->document_name);

            // $template_table = $this->legalizationRepo->templateTableName($table);

            // $document = $this->legalizationRepo->documentFilling($invoice['document_id'],$invoice['document_template_id'],$invoice['user_id'], $template_table);

            // $purchase = $this->purchaseRepo->saveLegalisationPurchase($invoice,$auth_id,$details,$user,$lawyer,$document,$template);

            //     if ($purchase == true) {

                        $json_data = array("status" => "success",'redirect' => '../../../../../../document-purchase/after/'.$invoice['document_id'].'/'.$invoice['document_template_id']);
                    
                // }
                if ($invoice == false) {

                    $json_data = array("status" => "error");
                }
         
        }
      
        return response()->json($json_data);

    }


    public function storeLegalisationMyFolderRedirect($id,$txn)
    {
        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoice($id,$auth_id);
        // $update_invoice = $this->purchaseRepo->updateInvoice($invoice['id'],$txn);

        if($invoice){
                            
            // $details = $this->legalizationRepo->getLegalisationDetails($invoice['legalization_id']);

            // $user = $this->legalizationRepo->getUser($invoice['user_id']);
        
            // $lawyer = $this->legalizationRepo->getDirectory($details['directory_id']);
        
            // $template =$this->legalizationRepo->getTemplate($invoice['document_id']);

            // $table = strtolower($template->document_name);

            // $template_table = $this->legalizationRepo->templateTableName($table);

            // $document = $this->legalizationRepo->documentFilling($invoice['document_id'],$invoice['document_template_id'],$invoice['user_id'], $template_table);

            // $purchase = $this->legalizationRepo->saveLegalisationPurchase($invoice,$auth_id,$details,$user,$lawyer,$document,$template);


            // if ($purchase) {
                
                        $json_data = array("status" => "success",'redirect' => '../../../../../../myfolders/show/'.$invoice['document_id'].'/'.$invoice['document_template_id']);          
            // } 
                       
            
        }
        if ($invoice == false) {

            $json_data = array("status" => "error");
            
        }
        return response()->json($json_data);
    }




    //end redirect

    public function invoiceBuyFillDocumentPurchase($id){
        $cybersource_conf = \Config::get('cybersource');
        $auth_id =\Auth::user()->id;
        $transaction_uuid = mt_rand(1000000000000,9999999999999);
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $prices =$this->priceRepo->getPriceDocument($id);
        $userData = $this->purchaseRepo->getUserData($auth_id);
        $invoiceData = [
            'user_id'=> $auth_id,
            'document_id'=>$id,
            'price_matrix_id'=>$prices['id'],
            'document_price'=>$prices['price'],
            'amount'=>$prices['price'],
            'transaction_uuid'=> $transaction_uuid,
            'type'=>'Compra de documentos'
        ];
        $invoice = $this->purchaseRepo->createInvoiceBuyFillDocumentPurchase($invoiceData);


        $data = [
            "profile_id" => $cybersource_conf['profile_id'],
            "access_key" => $cybersource_conf['access_key'],
            "secret_key" => $cybersource_conf['secret_key'],
            "transaction_uuid" => $transaction_uuid,
            "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
            "signed_field_names" => "profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_cancel_page,override_custom_receipt_page",
            "unsigned_field_names" => "device_fingerprint_id,signature,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,customer_ip_address,line_item_count,item_0_code,item_0_sku,item_0_name,item_0_quantity,item_0_unit_price,item_1_code,item_1_sku,item_1_name,item_1_quantity,item_1_unit_price,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4",
            "transaction_type" => "sale",
            "reference_number" => "B1611055676089",
            "auth_trans_ref_no" => "B1611055676089",
            "amount" => $prices['price'],
            "currency" => "GTQ",
            "locale" => "es-us",
            "merchant_descriptor" => $userData['first_name'],
            "bill_to_forename" => $userData['first_name'],
            "bill_to_surname" => $userData['surname'],
            "bill_to_email" => $userData['email'],
            "bill_to_phone" => "",
            "bill_to_address_line1" => "",
            "bill_to_address_line2" => "",
            "bill_to_address_city" => "Guatemala",
            "bill_to_address_state" => "Guatemala",
            "bill_to_address_country" => "GT",
            "bill_to_address_postal_code" => "",
            "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
            "override_custom_receipt_page" => url('/')."/cybersource/payment/response/BuyFillDocument",
            "customer_ip_address" => $user_ip,
            "line_item_count" => "2",
            "item_0_sku" => "sku001",
            "item_0_code" => "KFLTFDIV",
            "item_0_name" => "KFLTFDIV",
            "item_0_quantity" => "1",
            "item_0_unit_price" => $prices['price'],
            "merchant_defined_data1" => "MDD#1",
            "merchant_defined_data2" => "MDD#2",
            "merchant_defined_data3" => "MDD#3",
            "merchant_defined_data4" => "MDD#4",
            "allow_payment_token_update"=>"false",
            "auth_type"=>"AUTOCAPTURE",
            "bill_payment"=>"true",
        ];

        return view('cybersource.secure.confirm', compact('data'));

        
    }
    public function invoiceFillBuyDocumentPurchase($id,$u_id){
        $cybersource_conf = \Config::get('cybersource');
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $auth_id =\Auth::user()->id;
        $userData = $this->purchaseRepo->getUserData($auth_id);
        $transaction_uuid = mt_rand(1000000000000,9999999999999);
        $prices =$this->priceRepo->getPriceDocument($id);
        $invoiceData = [
            'user_id'=> $auth_id,
            'document_id'=>$id,
            'document_template_id'=>$u_id,
            'price_matrix_id'=>$prices['id'],
            'document_price'=>$prices['price'],
            'amount'=>$prices['price'],
            'transaction_uuid'=> $transaction_uuid,
            'type'=>'Compra de documentos'
        ];
        $invoice = $this->purchaseRepo->createInvoiceFillBuyDocumentPurchase($invoiceData);

        $data = [
            "profile_id" => $cybersource_conf['profile_id'],
            "access_key" => $cybersource_conf['access_key'],
            "secret_key" => $cybersource_conf['secret_key'],
            "transaction_uuid" => $transaction_uuid,
            "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
            "signed_field_names" => "profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_cancel_page,override_custom_receipt_page",
            "unsigned_field_names" => "device_fingerprint_id,signature,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,customer_ip_address,line_item_count,item_0_code,item_0_sku,item_0_name,item_0_quantity,item_0_unit_price,item_1_code,item_1_sku,item_1_name,item_1_quantity,item_1_unit_price,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4",
            "transaction_type" => "sale",
            "reference_number" => "B1611055676089",
            "auth_trans_ref_no" => "B1611055676089",
            "amount" => $prices['price'],
            "currency" => "GTQ",
            "locale" => "es-us",
            "merchant_descriptor" => $userData['first_name'],
            "bill_to_forename" => $userData['first_name'],
            "bill_to_surname" => $userData['surname'],
            "bill_to_email" => $userData['email'],
            "bill_to_phone" => "",
            "bill_to_address_line1" => "",
            "bill_to_address_line2" => "N",
            "bill_to_address_city" => "Guatemala",
            "bill_to_address_state" => "Guatemala",
            "bill_to_address_country" => "GT",
            "bill_to_address_postal_code" => "",
            "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
            "override_custom_receipt_page" => url('/')."/cybersource/payment/response/FillBuyDocument",
            "customer_ip_address" => $user_ip,
            "line_item_count" => "2",
            "item_0_sku" => "sku001",
            "item_0_code" => "KFLTFDIV",
            "item_0_name" => "KFLTFDIV",
            "item_0_quantity" => "1",
            "item_0_unit_price" => $prices['price'],
            "item_1_sku" => "sku002",
            "item_1_code" => "KFLTFD70",
            "item_1_name" => "KFLTFD70",
            "item_1_quantity" => "1",
            "item_1_unit_price" => $prices['price'],
            "merchant_defined_data1" => "MDD#1",
            "merchant_defined_data2" => "MDD#2",
            "merchant_defined_data3" => "MDD#3",
            "merchant_defined_data4" => "MDD#4",
            "allow_payment_token_update"=>"false",
            "auth_type"=>"AUTOCAPTURE",
            "bill_payment"=>"true",
        ];

        return view('cybersource.secure.confirm', compact('data'));
    }
    public function invoiceFillBuyPurchase($id,$u_id){
        $auth_id =\Auth::user()->id;
        $cybersource_conf = \Config::get('cybersource');
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $userData = $this->purchaseRepo->getUserData($auth_id);
        $transaction_uuid = mt_rand(1000000000000,9999999999999);
        $legalisation = $this->legalizationRepo->legalisationDetail($id,$u_id);
        $prices =$this->priceRepo->getPriceDocument($id);
        $invoiceData = [
            'user_id'=> $auth_id,
            'document_id'=>$id,
            'legalization_id'=>$legalisation['id'],
            'document_template_id'=>$u_id,
            'price_matrix_id'=>$prices['id'],
            'document_price'=>$prices['price'],
            'legalization_price'=>$legalisation['legalization_price'],
            'amount'=>$legalisation['legalization_price']+ $prices['price'],
            'transaction_uuid'=> $transaction_uuid,
            'type'=>'Compra de documentos,Legalización'
        ];
        $amount = $legalisation['legalization_price']+ $prices['price'];
        $invoice = $this->purchaseRepo->createInvoiceFillBuyPurchase($invoiceData);

        $data = [
            "profile_id" => $cybersource_conf['profile_id'],
            "access_key" => $cybersource_conf['access_key'],
            "secret_key" => $cybersource_conf['secret_key'],
            "transaction_uuid" => $transaction_uuid,
            "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
            "signed_field_names" => "profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_cancel_page,override_custom_receipt_page",
            "unsigned_field_names" => "device_fingerprint_id,signature,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,customer_ip_address,line_item_count,item_0_code,item_0_sku,item_0_name,item_0_quantity,item_0_unit_price,item_1_code,item_1_sku,item_1_name,item_1_quantity,item_1_unit_price,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4",
            "transaction_type" => "sale",
            "reference_number" => "B1611055676089",
            "auth_trans_ref_no" => "B1611055676089",
            "amount" => $amount,
            "currency" => "GTQ",
            "locale" => "es-us",
            "merchant_descriptor" => $userData['first_name'],
            "bill_to_forename" => $userData['first_name'],
            "bill_to_surname" => $userData['surname'],
            "bill_to_email" => $userData['email'],
            "bill_to_phone" => "",
            "bill_to_address_line1" => "",
            "bill_to_address_line2" => "",
            "bill_to_address_city" => "Guatemala",
            "bill_to_address_state" => "Guatemala",
            "bill_to_address_country" => "GT",
            "bill_to_address_postal_code" => "",
            "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
            "override_custom_receipt_page" => url('/')."/cybersource/payment/response/FillBuyPurchase",
            "customer_ip_address" => $user_ip,
            "line_item_count" => "2",
            "item_0_sku" => "sku001",
            "item_0_code" => "KFLTFDIV",
            "item_0_name" => "KFLTFDIV",
            "item_0_quantity" => "1",
            "item_0_unit_price" => $amount,
            "item_1_sku" => "sku002",
            "item_1_code" => "KFLTFD70",
            "item_1_name" => "KFLTFD70",
            "item_1_quantity" => "1",
            "item_1_unit_price" => $amount,
            "merchant_defined_data1" => "MDD#1",
            "merchant_defined_data2" => "MDD#2",
            "merchant_defined_data3" => "MDD#3",
            "merchant_defined_data4" => "MDD#4",
            "allow_payment_token_update"=>"false",
            "auth_type"=>"AUTOCAPTURE",
            "bill_payment"=>"true",
        ];

        return view('cybersource.secure.confirm', compact('data'));
    }
    public function invoiceLegalisationPurchase($id,$u_id){
        $auth_id =\Auth::user()->id;
        $cybersource_conf = \Config::get('cybersource');
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $userData = $this->purchaseRepo->getUserData($auth_id);
        $transaction_uuid = mt_rand(1000000000000,9999999999999);
        $legalisation = $this->legalizationRepo->legalisationDetail($id,$u_id);
        $prices =$this->priceRepo->getPriceDocument($id);
        $invoiceData = [
            'user_id'=> $auth_id,
            'document_id'=>$id,
            'legalization_id'=>$legalisation['id'],
            'document_template_id'=>$u_id,
            'price_matrix_id'=>$prices['id'],
            'legalization_price'=>$legalisation['legalization_price'],
            'amount'=>$legalisation['legalization_price'],
            'transaction_uuid'=> $transaction_uuid,
            'type'=>'Legalización'
        ];
        $invoice = $this->purchaseRepo->createInvoiceLegalisationPurchase($invoiceData);
        $amount = $legalisation['legalization_price'];
        $data = [
            "profile_id" => $cybersource_conf['profile_id'],
            "access_key" => $cybersource_conf['access_key'],
            "secret_key" => $cybersource_conf['secret_key'],
            "transaction_uuid" => $transaction_uuid,
            "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
            "signed_field_names" => "profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_cancel_page,override_custom_receipt_page",
            "unsigned_field_names" => "device_fingerprint_id,signature,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,customer_ip_address,line_item_count,item_0_code,item_0_sku,item_0_name,item_0_quantity,item_0_unit_price,item_1_code,item_1_sku,item_1_name,item_1_quantity,item_1_unit_price,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4",
            "transaction_type" => "sale",
            "reference_number" => "B1611055676089",
            "auth_trans_ref_no" => "B1611055676089",
            "amount" => $amount,
            "currency" => "GTQ",
            "locale" => "es-us",
            "merchant_descriptor" => $userData['first_name'],
            "bill_to_forename" => $userData['first_name'],
            "bill_to_surname" => $userData['surname'],
            "bill_to_email" => $userData['email'],
            "bill_to_phone" => "",
            "bill_to_address_line1" => "",
            "bill_to_address_line2" => "",
            "bill_to_address_city" => "Guatemala",
            "bill_to_address_state" => "Guatemala",
            "bill_to_address_country" => "GT",
            "bill_to_address_postal_code" => "",
            "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
            "override_custom_receipt_page" => url('/')."/cybersource/payment/response/LegalisationPurchase",
            "customer_ip_address" => $user_ip,
            "line_item_count" => "2",
            "item_0_sku" => "sku001",
            "item_0_code" => "KFLTFDIV",
            "item_0_name" => "KFLTFDIV",
            "item_0_quantity" => "1",
            "item_0_unit_price" => $amount,
            "item_1_sku" => "sku002",
            "item_1_code" => "KFLTFD70",
            "item_1_name" => "KFLTFD70",
            "item_1_quantity" => "1",
            "item_1_unit_price" => $amount,
            "merchant_defined_data1" => "MDD#1",
            "merchant_defined_data2" => "MDD#2",
            "merchant_defined_data3" => "MDD#3",
            "merchant_defined_data4" => "MDD#4",
            "allow_payment_token_update"=>"false",
            "auth_type"=>"AUTOCAPTURE",
            "bill_payment"=>"true",
        ];

        return view('cybersource.secure.confirm', compact('data'));
    }
    public function invoiceChecklist($id){
        $auth_id =\Auth::user()->id;
        $cybersource_conf = \Config::get('cybersource');
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $userData = $this->purchaseRepo->getUserData($auth_id);
        $transaction_uuid = mt_rand(1000000000000,9999999999999);
        $prices =$this->priceRepo->getPriceDocument($id);
        $invoiceData = [
            'user_id'=> $auth_id,
            'document_id'=>$id,
            'price_matrix_id'=>$prices['id'],
            'document_price'=>$prices['price'],
            'amount'=>$prices['price'],
            'transaction_uuid'=> $transaction_uuid,
            'type'=>'Compra de documentos'
        ];
        $invoice = $this->purchaseRepo->createInvoiceChecklist($invoiceData);

        $data = [
            "profile_id" => $cybersource_conf['profile_id'],
            "access_key" => $cybersource_conf['access_key'],
            "secret_key" => $cybersource_conf['secret_key'],
            "transaction_uuid" => $transaction_uuid,
            "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
            "signed_field_names" => "profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_cancel_page,override_custom_receipt_page",
            "unsigned_field_names" => "device_fingerprint_id,signature,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,customer_ip_address,line_item_count,item_0_code,item_0_sku,item_0_name,item_0_quantity,item_0_unit_price,item_1_code,item_1_sku,item_1_name,item_1_quantity,item_1_unit_price,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4",
            "transaction_type" => "sale",
            "reference_number" => "B1611055676089",
            "auth_trans_ref_no" => "B1611055676089",
            "amount" => $prices['price'],
            "currency" => "GTQ",
            "locale" => "es-us",
            "merchant_descriptor" => $userData['first_name'],
            "bill_to_forename" => $userData['first_name'],
            "bill_to_surname" => $userData['surname'],
            "bill_to_email" => $userData['email'],
            "bill_to_phone" => "",
            "bill_to_address_line1" => "",
            "bill_to_address_line2" => "",
            "bill_to_address_city" => "Guatemala",
            "bill_to_address_state" => "Guatemala",
            "bill_to_address_country" => "GT",
            "bill_to_address_postal_code" => "",
            "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
            "override_custom_receipt_page" => url('/')."/cybersource/payment/response/Checklist",
            "customer_ip_address" => $user_ip,
            "line_item_count" => "2",
            "item_0_sku" => "sku001",
            "item_0_code" => "KFLTFDIV",
            "item_0_name" => "KFLTFDIV",
            "item_0_quantity" => "1",
            "item_0_unit_price" => $prices['price'],
            "item_1_sku" => "sku002",
            "item_1_code" => "KFLTFD70",
            "item_1_name" => "KFLTFD70",
            "item_1_quantity" => "1",
            "item_1_unit_price" => $prices['price'],
            "merchant_defined_data1" => "MDD#1",
            "merchant_defined_data2" => "MDD#2",
            "merchant_defined_data3" => "MDD#3",
            "merchant_defined_data4" => "MDD#4",
            "allow_payment_token_update"=>"false",
            "auth_type"=>"AUTOCAPTURE",
            "bill_payment"=>"true"
        ];

        return view('cybersource.secure.confirm', compact('data'));
    }
    public function invoiceMyFolderLegalisationPurchase($id,$u_id){
        $auth_id =\Auth::user()->id;
        $cybersource_conf = \Config::get('cybersource');
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $userData = $this->purchaseRepo->getUserData($auth_id);
        $transaction_uuid = mt_rand(1000000000000,9999999999999);
        $legalisation = $this->legalizationRepo->legalisationDetail($id,$u_id);
        $prices =$this->priceRepo->getPriceDocument($id);
        $invoiceData = [
            'user_id'=> $auth_id,
            'document_id'=>$id,
            'legalization_id'=>$legalisation['id'],
            'document_template_id'=>$u_id,
            'price_matrix_id'=>$prices['id'],
            'legalization_price'=>$legalisation['legalization_price'],
            'amount'=>$legalisation['legalization_price'],
            'transaction_uuid'=> $transaction_uuid,
            'type'=>'Legalización'
        ];
        $invoice = $this->purchaseRepo->createInvoiceMyFolderLegalisationPurchase($invoiceData);
        $data = [
            "profile_id" => $cybersource_conf['profile_id'],
            "access_key" => $cybersource_conf['access_key'],
            "secret_key" => $cybersource_conf['secret_key'],
            "transaction_uuid" => $transaction_uuid,
            "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
            "signed_field_names" => "profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_cancel_page,override_custom_receipt_page",
            "unsigned_field_names" => "device_fingerprint_id,signature,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,customer_ip_address,line_item_count,item_0_code,item_0_sku,item_0_name,item_0_quantity,item_0_unit_price,item_1_code,item_1_sku,item_1_name,item_1_quantity,item_1_unit_price,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4",
            "transaction_type" => "sale",
            "reference_number" => "B1611055676089",
            "auth_trans_ref_no" => "B1611055676089",
            "amount" => $legalisation['legalization_price'],
            "currency" => "GTQ",
            "locale" => "es-us",
            "merchant_descriptor" => $userData['first_name'],
            "bill_to_forename" => $userData['first_name'],
            "bill_to_surname" => $userData['surname'],
            "bill_to_email" => $userData['email'],
            "bill_to_phone" => "",
            "bill_to_address_line1" => "",
            "bill_to_address_line2" => "",
            "bill_to_address_city" => "Guatemala",
            "bill_to_address_state" => "Guatemala",
            "bill_to_address_country" => "GT",
            "bill_to_address_postal_code" => "",
            "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
            "override_custom_receipt_page" => url('/')."/cybersource/payment/response/Checklist",
            "customer_ip_address" => $user_ip,
            "line_item_count" => "2",
            "item_0_sku" => "sku001",
            "item_0_code" => "KFLTFDIV",
            "item_0_name" => "KFLTFDIV",
            "item_0_quantity" => "1",
            "item_0_unit_price" => $legalisation['legalization_price'],
            "item_1_sku" => "sku002",
            "item_1_code" => "KFLTFD70",
            "item_1_name" => "KFLTFD70",
            "item_1_quantity" => "1",
            "item_1_unit_price" => $legalisation['legalization_price'],
            "merchant_defined_data1" => "MDD#1",
            "merchant_defined_data2" => "MDD#2",
            "merchant_defined_data3" => "MDD#3",
            "merchant_defined_data4" => "MDD#4",
            "allow_payment_token_update"=>"false",
            "auth_type"=>"AUTOCAPTURE",
            "bill_payment"=>"true",
        ];

        return view('cybersource.secure.confirm', compact('data'));
    }
    public function userPurchaseHistory()
    {
        $auth_id =\Auth::user()->id;
        $invoice = $this->purchaseRepo->getInvoiceData($auth_id);
        $invoiceDocument = $this->purchaseRepo->getInvoiceDocumentData($auth_id);
        return view('front.prices.purchase_history',compact('invoice','invoiceDocument'));
    }
}
