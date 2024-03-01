<?php

namespace App\Repository;


use App\DocumentPurchase;
use App\LegalizationDetails;
use App\LegalDocumentTemplate;
use App\LawyersDirectory;
use Exception;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\LawyerMail;
use Auth;
use App\User;

class DocumentPurchaseRepository
{
    public function saveDocumentPurchase($data,$auth_id){
        try {  
            DB::beginTransaction();
            $purchase = new DocumentPurchase();
            $purchase->user_id = $data['user_id'];
            $purchase->document_id = $data['document_id'];
            $purchase->legalization_id = $data['legalization_id'];
            $purchase->name = $data['name'];
            $purchase->card_no = $data['card_no'];
            $purchase->expiry_date = $data['expiry_date'];
            $purchase->cvv = $data['cvv'];
            $purchase->created_by = $auth_id;
            $purchase->save();

            $details = $this->getLegalisationDetails($data['legalization_id']);

            $user = $this->getUser($data['user_id']);

            $lawyer = $this->getDirectory($details['directory_id']);
            
            $template =$this->getTemplate($data['document_id']);

            $table = strtolower($template->document_name);

            $template_table = $this->templateTableName($table);

            $document = $this->documentFilling($data['document_id'],$data['user_id'], $template_table);

            $data = array(
                'lawyer_name'   => $lawyer->lawyer_name,
                'email'         => $lawyer->email,
                'user_name'     => $user->full_name ,
                'user_email'    => $user->email ,
                'date'          => $document->created_at,
                'document_name' => $template->document_name,
                'document_image'=> $template->document_image,
                'purchase_id'   => $purchase->id
            );
            Mail::to($data['email'])->send(new LawyerMail($data));

            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }
            DB::commit();
            return $purchase;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function getLegalisationDetails($id){
        try {  

            $details = LegalizationDetails::where('id',$id)->first();
            return $details ;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }

    public function getDirectory($id){
        try {  

            $directory = LawyersDirectory::find($id);
            return $directory ;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        } 
    }

    public function getTemplate($id){
        try {  

            $template = LegalDocumentTemplate::find($id);
           
            return $template ;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        } 
    }
    public function templateTableName($table){
        try {  
            $table = str_replace(" ","_",strtolower($table));
            $tables = DB::select('SHOW TABLES');
                    
            $tables = array_map('current',$tables);

            if(in_array($table ,$tables))
            {    
                $template_table= $table;    
            }
            return $template_table;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function documentFilling($document_id,$user_id,$template_table){
        try {  
            $document = DB::table($template_table)->where('document_id',$document_id)->where('user_id',$user_id)->first();
            return $document;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function getUser($id){

        try {  
            $user = User::find($id);
            return $user;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }

    }
   
}