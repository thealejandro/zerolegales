<?php

namespace App\Repository;


use App\DocumentLegalisationPurchase;
use App\DocumentFilling;
use Exception;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\LawyerMail;
use App\Mail\PaymentMail;
use App\LegalizationDetails;
use App\DocumentInvoice;
use App\Model\Invoice;
use App\User;
use App\Model\PurchasedSubscription;

class PurchaseRepository
{

    public function saveBuyFillDocumentPurchase($data,$auth_id){
        try {
            DB::beginTransaction();
            $purchase = new DocumentLegalisationPurchase();
            $purchase->invoice_id = $data['id'];
            $purchase->user_id = $data['user_id'];
            $purchase->document_id = $data['document_id'];
            $purchase->document_price = $data['document_price'];
            $purchase->amount = $data['document_price'];
            $purchase->document_filling_type = 'buy_fill';
            $purchase->created_by = $auth_id;
            $purchase->save();

            $invoice = DocumentInvoice::where('id',$data['id'])->where('user_id',$auth_id)->first();

            $user_details = User::find($data['user_id']);

            $payment_data = array(
                'user_name'         => $user_details->full_name ,
                'user_email'        => $user_details->email ,
                'transaction_id' =>$invoice['transaction_id'],
                'date' => $invoice['created_at'],
                'document_price'=>$invoice['document_price']
            );

            Mail::to($payment_data['user_email'])->send(new PaymentMail($payment_data));
        
            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }

            $user_type = User::find($data['user_id']);
            $user_type->user_type= 3;
            $user_type->save();

            if(!$user_type){
                throw new \Exception('User Type not updated');
            }

            DB::commit();
            return $purchase;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function saveFillBuyDocumentPurchase($data,$auth_id){
        try {
            DB::beginTransaction();
            $purchase = new DocumentLegalisationPurchase();
            $purchase->invoice_id = $data['id'];
            $purchase->user_id = $data['user_id'];
            $purchase->document_id = $data['document_id'];
            $purchase->document_price = $data['document_price'];
            $purchase->amount = $data['document_price'];
            $purchase->document_template_id = $data['document_template_id'];
            $purchase->document_filling_type = 'fill_buy';
            $purchase->created_by = $auth_id;
            $purchase->save();

            $invoice = DocumentInvoice::where('id',$data['id'])->where('user_id',$auth_id)->first();

            $user_details = User::find($data['user_id']);

            $payment_data = array(
                'user_name'         => $user_details->full_name ,
                'user_email'        => $user_details->email ,
                'transaction_id' =>$invoice['transaction_id'],
                'date' => $invoice['created_at'],
                'document_price'=>$invoice['document_price']
            );

            Mail::to($payment_data['user_email'])->send(new PaymentMail($payment_data));
        
            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }

            $document_filling = DocumentFilling::where('document_id',$data['document_id'])->where('document_template_id',$data['document_template_id'])->first();
            $document_filling->status_id = 1;
            $document_filling->updated_by = $auth_id;
            $document_filling->updated_at = date('Y-m-d H:i:s');
            $document_filling->save();

            $user_type = User::find($data['user_id']);
            $user_type->user_type= 3;
            $user_type->save();

            if(!$user_type){
                throw new \Exception('User Type not updated');
            }

            DB::commit();
            return $purchase;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function saveFillBuyPurchase($data,$auth_id,$details,$user,$lawyer,$document,$template){
        try {
            DB::beginTransaction();

            if(isset($data['legalization_id'])){
             
                    $purchase = new DocumentLegalisationPurchase();
                    $purchase->invoice_id = $data['id'];
                    $purchase->user_id = $data['user_id'];
                    $purchase->document_id = $data['document_id'];
                    $purchase->document_template_id = $data['document_template_id'];
                    $purchase->legalization_id = $data['legalization_id'];
                    $purchase->document_price = $data['document_price'];
                    $purchase->legalization_price = $data['legalization_price'];
                    $purchase->amount = $data['document_price'] + $data['legalization_price'];
                    $purchase->document_filling_type = 'fill_buy';
                    $purchase->created_by = $auth_id;
                    $purchase->save();

                    $invoice = DocumentInvoice::where('id',$data['id'])->where('user_id',$auth_id)->first();

                    $user_details = User::find($data['user_id']);

                    $payment_data = array(
                        'user_name'         => $user_details->full_name ,
                        'user_email'        => $user_details->email ,
                        'transaction_id' =>$invoice['transaction_id'],
                        'date' => $invoice['created_at'],
                        'document_price'=>$invoice['document_price']
                    );
                
                    $datas = array(
                        'lawyer_name'       => $lawyer->lawyer_name,
                        'email'             => $lawyer->email,
                        'user_name'         => $user->full_name ,
                        'user_email'        => $user->email ,
                        'dpi_number'        => $user->dpi_number,
                        'date'              => $document->created_at,
                        'document_name'     => $template->document_name,
                        'document_image'    => $template->document_image,
                        'legalisation_id'   => $details->id,
                        'id'                => $document->id,
                        'document_id'       => $details->document_id
                    );                
                    Mail::to($datas['email'])->send(new LawyerMail($datas));
        
                    Mail::to($payment_data['user_email'])->send(new PaymentMail($payment_data));
        
                    if (Mail::failures()) {
                        throw new \Exception('Mail Sending Failed');
                    }   

                    $user_type = User::find($data['user_id']);
                    $user_type->user_type= 3;
                    $user_type->save();
                    
                    $document_filling = DocumentFilling::where('document_id',$data['document_id'])->where('document_template_id',$data['document_template_id'])->first();
                    $document_filling->legalization_id = $data['legalization_id'];
                    $document_filling->status_id = 2;
                    $document_filling->document_completed_date = date('Y-m-d H:i:s');
                    $document_filling->updated_by = $auth_id;
                    $document_filling->updated_at = date('Y-m-d H:i:s');
                    $document_filling->save();

                    $legal_details = LegalizationDetails::find($data['legalization_id']);
                    $legal_details->legalisation_status = 1;   
                    $legal_details->updated_by = $auth_id;
                    $legal_details->updated_at = date('Y-m-d H:i:s');            
                    $legal_details->save();

                    if(!$legal_details){
                        throw new \Exception('Legalisation status not updated');
                    }
                      
                    
            }
            DB::commit();
            return $data;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function saveLegalisationPurchase($data,$auth_id,$details,$user,$lawyer,$document,$template,$document_required){
        try {
            DB::beginTransaction();

            if(isset($data['legalization_id'])){
                $purchase = DocumentLegalisationPurchase::where('invoice_id','=',$data['id'])->first();
                if($purchase != null){
                    $purchase->legalization_id = $data['legalization_id'];
                    $purchase->legalization_price = $data['legalization_price'];
                    $purchase->amount = $purchase['document_price']+$data['legalization_price'];
                    $purchase->updated_by = $auth_id;
                    $purchase->save();
                }
                else{
                    $purchase = new DocumentLegalisationPurchase();
                    $purchase->invoice_id = $data['id'];
                    $purchase->user_id = $data['user_id'];
                    $purchase->document_id = $data['document_id'];
                    $purchase->document_template_id = $data['document_template_id'];
                    $purchase->legalization_id = $data['legalization_id'];
                    $purchase->legalization_price = $data['legalization_price'];
                    $purchase->amount = $data['legalization_price'];
                    $purchase->created_by = $auth_id;
                    $purchase->save();
                }  
                $user = User::find($data['user_id']);

                    if($user->user_type == 2){

                        $subscription = PurchasedSubscription::with('subscriptionType')->where('user_id',$data['user_id'])->where('purchased_subscriptions.is_active',1)->first();

                    
                    if(isset($subscription)){

                        if($subscription['subscriptionType']['id'] == 3){ 
                

                            $required = explode(',',$document_required);
    
                            $text_data = str_replace (array('{', '}','"','[',']','document_required:'), '' , $required);
    
                                                
                            $attachments = array('rtu'=> $user->rtu,'appointment'=>$user->appointment,'company_trade_patent'=>$user->company_trade_patent,'society_trade_patent'=>$user->society_trade_patent);
                            
                            $data_attached[] = storage_path().'/app/public/'.$user->dpi_file;
    
                            foreach($attachments as $key=>$value) {
    
                                if(in_array($key, $text_data)){
    
                                    $data_attached[] = storage_path().'/app/public/'.$value;
                                }
                            }
                            $datas = array(
                                'lawyer_name'       => $lawyer->lawyer_name,
                                'email'             => $lawyer->email,
                                'user_name'         => $user->full_name ,
                                'user_email'        => $user->email ,
                                'dpi_number'        => $user->dpi_number,
                                'date'              => $document->created_at,
                                'document_name'     => $template->document_name,
                                'document_image'    => $template->document_image,
                                'legalisation_id'   => $details->id,
                                'id'                => $document->id,
                                'document_id'       => $details->document_id,
                                'data_attached'     => $data_attached
                            );
                        }
                        if($subscription['subscriptionType']['id'] == 2){ 
                            
                            $datas = array(
                                'lawyer_name'       => $lawyer->lawyer_name,
                                'email'             => $lawyer->email,
                                'user_name'         => $user->full_name ,
                                'user_email'        => $user->email ,
                                'dpi_number'        => $user->dpi_number,
                                'date'              => $document->created_at,
                                'document_name'     => $template->document_name,
                                'document_image'    => $template->document_image,
                                'legalisation_id'   => $details->id,
                                'id'                => $document->id,
                                'document_id'       => $details->document_id,
                            );
                        }
                    }

                    }
                
                    if($user->user_type == 1||$user->user_type == 3){
                        
                        $datas = array(
                            'lawyer_name'       => $lawyer->lawyer_name,
                            'email'             => $lawyer->email,
                            'user_name'         => $user->full_name ,
                            'user_email'        => $user->email ,
                            'dpi_number'        => $user->dpi_number,
                            'date'              => $document->created_at,
                            'document_name'     => $template->document_name,
                            'document_image'    => $template->document_image,
                            'legalisation_id'   => $details->id,
                            'id'                => $document->id,
                            'document_id'       => $details->document_id,
                        );

                    }
               
                Mail::to($datas['email'])->send(new LawyerMail($datas));
    
                if (Mail::failures()) {
                    throw new \Exception('Mail Sending Failed');
                }   
                
                $document_filling = DocumentFilling::where('document_id',$data['document_id'])->where('document_template_id',$data['document_template_id'])->first();
                $document_filling->legalization_id = $data['legalization_id'];
                $document_filling->status_id = 2;
                $document_filling->document_completed_date = date('Y-m-d H:i:s');
                $document_filling->updated_by = $auth_id;
                $document_filling->updated_at = date('Y-m-d H:i:s');
                $document_filling->save();

                $legal_details = LegalizationDetails::find($data['legalization_id']);
                $legal_details->legalisation_status = 1;   
                $legal_details->updated_by = $auth_id;
                $legal_details->updated_at = date('Y-m-d H:i:s');            
                $legal_details->save();

                if(!$legal_details){
                    throw new \Exception('Legalisation status not updated');
                }
                   
                
            
            }
            DB::commit();
        return $data;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function createInvoiceBuyFillDocumentPurchase($invoiceData){
        try {
            $invoice = DocumentInvoice::create($invoiceData);
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function createInvoiceFillBuyDocumentPurchase($invoiceData){
        try {
            $invoice = DocumentInvoice::create($invoiceData);
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function createInvoiceFillBuyPurchase($invoiceData){
        try {
            $invoice = DocumentInvoice::create($invoiceData);
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function createInvoiceLegalisationPurchase($invoiceData){
        try {
            $invoice = DocumentInvoice::create($invoiceData);
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function createInvoiceChecklist($invoiceData){
        try {
            $invoice = DocumentInvoice::create($invoiceData);
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function createInvoiceMyFolderLegalisationPurchase($invoiceData){
        try {
            $invoice = DocumentInvoice::create($invoiceData);
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getUserData($id){
        try {
            $user =  User::where('id',$id)->where('is_active',1)->first();
            return $user;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getInvoice($id,$auth_id){
        try {
            $invoice = DocumentInvoice::where('transaction_uuid',$id)->where('user_id',$auth_id)->first();
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getInvoiceData($id)
    {
        try {
            $invoice = Invoice::where('user_id',$id)
                        ->where('is_pay',1)
                        ->get();
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getInvoiceDocumentData($id)
    {
        try {
            $invoice = DocumentInvoice::where('user_id',$id)
                        ->where('is_pay',1)
                        ->get();
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function updateInvoice($id,$txn){
        try {
            $invoice = DocumentInvoice::where('id',$id)->update(['is_pay'=>1,'transaction_id'=>$txn]);
            return $invoice;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getDocumentInvoice($document_id,$document_template_id){
        try {
            $user_id = \Auth::user()->id;
            $purchase = DocumentInvoice::where('document_id',$document_id)->where('document_template_id',$document_template_id)->where('user_id',$user_id)
            ->where('is_pay',1)->first();
            return $purchase;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    
}