<?php

namespace App\Repository;


use Exception;
use DB;
use App\DocumentPurchase;
use App\DocumentFilling;
use App\LegalDocumentTemplate;
use App\DocumentLegalisationPurchase;
use App\DocumentInvoice;
use Auth;

class NosubscriptionRepository
{
    public function templateTableName($table){

        $table = str_replace(" ","_",strtolower($table));
        
        $tables = DB::select('SHOW TABLES');
                
        $tables = array_map('current',$tables);

        if(in_array($table ,$tables))
        {    
            $template_table= $table;    
        }
        return $template_table;
    }
    public function saveData($template_table, $col_count, $data,$auth_id,$labels,$subscription){
        try {
  
            DB::beginTransaction();
                if(Auth::user()->user_type != 2){
                    $attribute_value_array = [
                        'user_id'       => $auth_id,
                        'document_id'   =>$data['document_id'],
                        'created_by'    => $auth_id,
                        'created_at'=>  date('Y-m-d H:i:s')
        
                    ];
                    
                }
                else{

                
                    if($subscription['subscriptionType']['id'] != 3){
                        $attribute_value_array = [
                            'user_id'       => $auth_id,
                            'document_id'   =>$data['document_id'],
                            'created_by'    => $auth_id,
                            'created_at'=>  date('Y-m-d H:i:s')
            
                        ];
                    }
                    else{
                        if(isset($data['expiry_date'])){
                            $expiry = str_replace(' ', '', $data['expiry_date']);
                            $e_date = str_replace('/', '-', $expiry);
                            $expiry_date = date('Y-m-d', strtotime($e_date));     

                        
                        $attribute_value_array = [
                            'user_id'       => $auth_id,
                            'document_id'   =>$data['document_id'],
                            'expiry_date'   => $expiry_date,
                            'created_by'    => $auth_id,
                            'created_at'=>  date('Y-m-d H:i:s')
            
                        ];
                       }
                       else{
                        $attribute_value_array = [
                            'user_id'       => $auth_id,
                            'document_id'   =>$data['document_id'],
                            'created_by'    => $auth_id,
                            'created_at'=>  date('Y-m-d H:i:s')
            
                        ];  
                       }
                    }
                    
                }
               
                $i=0;
                foreach($labels as $key=>$variable){
                
                        if($variable->label_type !='date'){
    
                            $attribute_value_array['field_'.$i] = $data['field_'.$i];
    
                        }
                        if($variable->label_type =='date'){
                            $var =str_replace(' ', '',  $data['field_'.$i]);
                            $date = str_replace('/', '-', $var);
                            $attribute_value_array['field_'.$i] = date('Y-m-d', strtotime($date));
    
                        }
                        if($variable->label_type == 'decimal'){                          
                             $attribute_value_array['field_'.$i] = str_replace(',', '', $data['field_'.$i]);

                        }
                    
                    $i++;  
                }
               
                    $nosubscription = DB::table($template_table)->insertGetId($attribute_value_array);

                    if(isset($data['invoice_id'])){
                        $purchase = DocumentLegalisationPurchase::where('invoice_id',$data['invoice_id'])->first();
                        $purchase->document_template_id = $nosubscription;
                        $purchase->save();
                        $invoice = DocumentInvoice::where('id',$data['invoice_id'])->first();
                        $invoice->document_template_id = $nosubscription;
                        $invoice->save();    
                    }

                   
                    $document_filling = new DocumentFilling();
                    $document_filling->user_id =  $auth_id;
                    $document_filling->document_id = $data['document_id'];
                    $document_filling->document_template_id = $nosubscription;
                    $document_filling->status_id = 1;
                    $document_filling->download_status  = 2;                   
                    if(Auth::user()->user_type == 1||Auth::user()->user_type == 3){
                        $document_filling->subscription_id = 1;
                    }
                    if(Auth::user()->user_type == 2){

                        if($subscription['subscriptionType']['id'] == 2){

                            $document_filling->subscription_id = $subscription['subscriptionType']['id'];
                        }
                        if($subscription['subscriptionType']['id'] == 3){

                            $document_filling->subscription_id = $subscription['subscriptionType']['id'];
                        }
                       
 
                    }
                    if(isset($data['expiry_date'])){
                        $document_filling->expiry_date = $expiry_date;
                    }
                    $document_filling->created_by    = $auth_id;
                    $document_filling->created_at    = date('Y-m-d H:i:s');
                    $document_filling->save();

                    if(!$document_filling){
                        throw new \Exception('Document Filling Not Added');
                    }
                    DB::commit();
            
            return  $nosubscription;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
   public function getNoSubscripitonData($template_table,$id){
    try {
        $nosubscription = DB::table($template_table)->where('id',$id)->first();
        return $nosubscription;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function updateData($template_table,$col_count, $data,$auth_id,$labels){
        try {
            if(\Auth::user()->user_type == 1){
                $attribute_value_array = [
                    'user_id'       => $auth_id,
                    'document_id'   =>$data['document_id'],
                    'updated_by'    => $auth_id,
                    'updated_at'=>  date('Y-m-d H:i:s')
    
                ];

                $i=0;
                foreach($labels as $key=>$variable){
                
                        if($variable->label_type !='date'){
    
                            $attribute_value_array['field_'.$i] = $data['field_'.$i];
    
    
                        }
                        if($variable->label_type =='date'){
                            $var =str_replace(' ', '', $data['field_'.$i]);
                            $date = str_replace('/', '-', $var);
                            $attribute_value_array['field_'.$i] = date('Y-m-d', strtotime($date));
    
                        }
                        if($variable->label_type == 'decimal'){     

                            $attribute_value_array['field_'.$i] = str_replace(',', '', $data['field_'.$i]);

                       }
                    
                    $i++;  
                }
                $nosubscription = DB::table($template_table)->where('id',$data['id'])->update($attribute_value_array);
            }
            else{
                if(isset($data['expiry_date'])){
                    DB::beginTransaction();
                    $expiry = str_replace(' ', '', $data['expiry_date']);
                    $e_date = str_replace('/', '-', $expiry);
                    $expiry_date = date('Y-m-d', strtotime($e_date));
                
                    $attribute_value_array = [
                        'user_id'       => $auth_id,
                        'document_id'   =>$data['document_id'],
                        'expiry_date'   => $expiry_date,
                        'updated_by'    => $auth_id,
                        'updated_at'=>  date('Y-m-d H:i:s')
        
                    ];
                }
                
             $i=0;
            foreach($labels as $key=>$variable){
            
                    if($variable->label_type !='date'){

                        $attribute_value_array['field_'.$i] = $data['field_'.$i];


                    }
                    if($variable->label_type =='date'){
                        $var =str_replace(' ', '', $data['field_'.$i]);
                        $date = str_replace('/', '-', $var);
                        $attribute_value_array['field_'.$i] = date('Y-m-d', strtotime($date));

                    }
                    if($variable->label_type == 'decimal'){     

                        $attribute_value_array['field_'.$i] = str_replace(',', '', $data['field_'.$i]);
                    }
                
                $i++;  
            }
            $nosubscription = DB::table($template_table)->where('id',$data['id'])->update($attribute_value_array);

            if(isset($data['expiry_date'])){
                $document_filling =   $document_filling = DocumentFilling::where('document_id',$data['document_id'])->first();
                if(isset($data['expiry_date'])){
                    $document_filling->expiry_date = $expiry_date;
                }
                $document_filling->save();
            
        
            if(!$document_filling){
                throw new \Exception('Document Filling Not Updated');
            }
            
        }
        DB::commit();
        }
            return true;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    
    
    public function getNoSubscripiton($template_table,$data){
        try {
            $nosubscription = DB::table($template_table)->where('id',$data['id'])->first();
            return $nosubscription;
            } catch (Exception $e) {
    
                logger()->error($e);
                return false;
            }
    }
    public function documentProgress(){
            try {
                $user_id = Auth::user()->id;
                if(Auth::user()->user_type==1||Auth::user()->user_type==3){
                    $date = \Carbon\Carbon::today()->subDays(30);
                    $documents = LegalDocumentTemplate::leftJoin('categories','categories.id','=','legal_document_templates.category_id')
                    ->leftJoin('document_fillings','document_fillings.document_id','=','legal_document_templates.id')
                    ->leftJoin('legalization_details','legalization_details.id','=','document_fillings.legalization_id')
                    ->select('legal_document_templates.document_name','legal_document_templates.document_description','categories.category_name',
                    'document_fillings.document_template_id','legal_document_templates.id as document_id','legal_document_templates.document_image','document_fillings.legalization_id',
                    'legalization_details.legalisation_status','document_fillings.created_at')
                    ->where('document_fillings.user_id',$user_id)
                    ->where('document_fillings.deleted_at','=',null)
                    ->orderBy('document_fillings.created_at','desc')
                    ->get();
    
                }
                else{
                    $date = \Carbon\Carbon::today();
                    $documents = LegalDocumentTemplate::leftJoin('categories','categories.id','=','legal_document_templates.category_id')
                    ->leftJoin('document_fillings','document_fillings.document_id','=','legal_document_templates.id')
                    ->leftJoin('legalization_details','legalization_details.id','=','document_fillings.legalization_id')
                    ->select('legal_document_templates.document_name','legal_document_templates.document_description','categories.category_name',
                    'document_fillings.document_template_id','legal_document_templates.id as document_id','legal_document_templates.document_image','document_fillings.legalization_id',
                    'document_fillings.expiry_date','legalization_details.legalisation_status')
                    ->where('document_fillings.user_id','=',$user_id)
                    ->orderBy('document_fillings.created_at','desc')
                    ->get();
                }
                return $documents;
            } catch (Exception $e) {
                return false;
            } 
    }
    public function updateStatus($data){
        try {
            $status =DocumentFilling::where('document_id',$data['document_id'])->where('document_template_id',$data['id'])->first();
            $status->download_status = $data['status'];
            $status->save();
            return true;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getDocumentFilling($document_id,$document_template_id){
        try {
            $document_filling =DocumentFilling::where('document_id',$document_id)->where('document_template_id',$document_template_id)->first();
            return $document_filling;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
}