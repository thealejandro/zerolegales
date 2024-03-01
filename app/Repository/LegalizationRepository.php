<?php

namespace App\Repository;


use App\LegalizationDetails;
use Exception;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotificationMail;
use App\DocumentPurchase;
use App\DocumentFilling;
use App\LegalDocumentTemplate;
use App\LawyersDirectory;
use App\Mail\LawyerMail;
use App\User;
use App\Model\UserLegalisation;
use Auth;
use Carbon\Carbon;

class LegalizationRepository
{
    public function saveLegalization($data,$auth_id,$template_table){
        try {    
                DB::beginTransaction();
  
                $details = new LegalizationDetails();
                $details->directory_id = $data['directory_id'];
                $details->document_id = $data['document_id'];
                $details->user_id = $data['user_id'];
                $details->legalization_price = $data['legalization_price'];
                $details->document_price = $data['document_price'];
                $details->document_template_id = $data['document_template_id'];
                $details->total_price = $data['total_price'];
                $details->created_by = $auth_id;
                $details->save();


               $document = DB::table($template_table)             
               ->where('id', $data['document_template_id'])
               ->update(['legalization_id'=>$details->id,'updated_at'=>  date('Y-m-d H:i:s')]);

               if(!$document){
                throw new \Exception('Legalization failed');
               }

               DB::commit();                     
            return $details;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function legalisationMail($data,$auth_id){
        try {
            if(isset($data['legalization_id'])){

                    $details = $this->getLegalisationDetails($data['legalization_id']);
        
                    if(isset($details)){
        
                        $user = $this->getUser($data['user_id']);
        
                        $lawyer = $this->getDirectory($details['directory_id']);
            
                         
                        $template =$this->getTemplate($data['document_id']);
            
                        $table = strtolower($template->document_name);
            
                        $template_table = $this->templateTableName($table);
            
                        $document = $this->documentFilling($data['document_id'],$data['document_template_id'],$data['user_id'], $template_table);
            
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
            
                        if (Mail::failures()) {
                            throw new \Exception('Mail Sending Failed');
                        }   
                        
                        $document_filling = DocumentFilling::where('document_id',$data['document_id'])
                        ->where('document_template_id',$data['document_template_id'])
                        ->update(['legalization_id'=>$data['legalization_id']]);

                        $legal_details = LegalizationDetails::find($data['legalization_id']);
        
                        $legal_details->legalisation_status = 'Enviada al Abogado';
                        
                        $legal_details->save();
    
                        if(!$legal_details){
                            throw new \Exception('Legalisation status not updated');
                        }
                        DB::commit();
                    }
            
            }
        return $data;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function getLegalisationDetails($id){
        try {  

            $details = LegalizationDetails::leftJoin('user_legalisations','user_legalisations.id','=','legalization_details.legalisation_status')->select('legalization_details.*','user_legalisations.legalisation_status')->where('legalization_details.id',$id)->first();
            return $details ;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getDirectory($id){
        try {  

            $directory = LawyersDirectory::find($id);
            return $directory ;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }

    public function getTemplate($id){
        try {  

            $template = LegalDocumentTemplate::find($id);
           
            return $template ;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }
    public function getTemplateDetails($id){
        try {  

            $template = LegalDocumentTemplate::with('category')->find($id);
           
            return $template ;
        } catch (Exception $e) {
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
            logger()->error($e);
            return false;
        }
    }
    public function documentFilling($document_id,$id,$user_id,$template_table){
        try {  
            $document = DB::table($template_table)->where('document_id',$document_id)->where('id',$id)->where('user_id',$user_id)->first();
            return $document;
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
   
    public function statusChange($data)
    {
        try {
            DB::beginTransaction();

            $status = LegalizationDetails::find($data['id']);

            $status->legalisation_status = $data['status'];

            $status->save();

            $document_filling = DocumentFilling::where('legalization_id',$data['id'])->first();

            $document_filling->updated_at = date('Y-m-d H:i:s');

            $document_filling->save();

            $details = $this->getLegalisationDetails($data['id']);

            $user = $this->getUser($data['user_id']);

            $lawyer = $this->getDirectory($details['directory_id']);
            
            $template =$this->getTemplate($details['document_id']);

            $table = strtolower($template->document_name);

            $template_table = $this->templateTableName($table);

            $document = $this->documentFilling($details['document_id'], $details['document_template_id'],$data['user_id'], $template_table);

            $data = array(
                'lawyer_name'   => $lawyer->lawyer_name,
                'email'         => $lawyer->email,
                'phone'         =>$lawyer->phone,
                'lawyer_address'=>$lawyer->lawyer_address,
                'zone'          =>$lawyer->zone,
                'township'      =>$lawyer->township,
                'department'    =>$lawyer->department,
                'user_name'     => $user->full_name ,
                'user_email'    => $user->email ,
                'date'          => $document->updated_at,
                'document_name' => $template->document_name,
                'document_image'=> $template->document_image,
                'legalisation_status'=>$details->legalisation_status
            );

            Mail::to($data['user_email'])->send(new UserNotificationMail($data));

            if (Mail::failures()) {
                throw new \Exception('Mail Sending Failed');
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function userLegalisationState($id){
        try {  

            $details = LegalizationDetails::leftJoin('legal_document_templates','legal_document_templates.id','=','legalization_details.document_id')
            ->leftJoin('document_types','document_types.id','=','legal_document_templates.template_type')
            ->select('legal_document_templates.id','legal_document_templates.document_name','legalization_details.created_at','legalization_details.document_template_id','legalization_details.legalisation_status','document_types.type_name')
            ->where('user_id',$id)
            ->get();
            return $details;

        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }

    public function loadingLegalisationData($id,$data){
        try {  
            $loading_datas = LegalizationDetails::leftJoin('lawyers_directories','lawyers_directories.id','=','legalization_details.directory_id')
            ->where('user_id',$id)
            ->where('document_id',$data['document_id'])
            ->where('document_template_id',$data['document_template_id'])
            ->first();
            
            return $loading_datas;

        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }
    public function documentPurchase($document_id,$document_template_id){
        try {
            $user_id = Auth::user()->id;
            
            $purchase = DocumentPurchase::where('document_id',$document_id)->where('user_id',$user_id)->where('document_template_id',$document_template_id)->first();

            return $purchase;
            
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }

    public function documentPurchaseDetails($document_id){
        try {
            $user_id = Auth::user()->id;
            
            $purchase = DocumentPurchase::where('document_id',$document_id)->where('user_id',$user_id)->first();

            return $purchase;
            
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }

    public function legalisationDetails($document_id){
        try {
            $user_id = Auth::user()->id;
            $legal_details = LegalizationDetails::where('document_id',$document_id)->where('user_id',$user_id)->first();
            return $legal_details;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }
    public function legalisationDetail($document_id,$document_template_id){
        try {
            $user_id = Auth::user()->id;
            $legal_details = LegalizationDetails::where('document_id',$document_id)->where('document_template_id',$document_template_id)->where('user_id',$user_id)->first();
            return $legal_details;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }
    public function getLegalisationStatus(){
        try {  

            $status = UserLegalisation::where('id','!=','1')->get();
           
            return $status ;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        } 
    }
}