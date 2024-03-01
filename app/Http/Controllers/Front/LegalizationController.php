<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\LegalizationRepository;
use App\Repository\LegalDocumentTemplateRepository;
use App\Repository\NosubscriptionRepository;
use Validator;
use Auth;

class LegalizationController extends Controller
{
    private $legalizationRepo,$templateRepo,$nosubscrptionRepo;


    public function __construct(LegalizationRepository $legalizationRepo,LegalDocumentTemplateRepository $templateRepo,NosubscriptionRepository $nosubscrptionRepo)
    {
        $this->legalizationRepo = $legalizationRepo;
        $this->templateRepo = $templateRepo;
        $this->nosubscrptionRepo = $nosubscrptionRepo;
    }
    public function store(Request $request)
    {
         
        $data = $request->all();
        $auth_id =\Auth::user()->id;

        $template = $this->templateRepo->getTemplate($data['document_id']);    

        $table = strtolower($template->document_name);

        $template_table  = $this->nosubscrptionRepo->templateTableName($table); 

        $details = $this->legalizationRepo->saveLegalization($data,$auth_id,$template_table);

        if ($details) {

              $json_data = array("status" => "success",'id'=>$details->id);
        } 
        if ($details == false) {

            $json_data = array("status" => "error");
        }  
        return response()->json($json_data);
    }
    public function sentMailLegalisation(Request $request)
    {
        $data = $request->all();

        $auth_id =\Auth::user()->id;

        $templates = $this->legalizationRepo->getTemplateDetails($data['document_id']);

        if( $templates->template_type != 4){

            $purchase = $this->legalizationRepo->legalisationMail($data,$auth_id);

            $table = strtolower($templates->document_name);

            $template_table = $this->legalizationRepo->templateTableName($table);

            $document = $this->legalizationRepo->documentFilling($purchase['document_id'], $data['document_template_id'],$purchase['user_id'], $template_table);

            if ($purchase) {
                    
                    if($document == null){

                        $json_data = array("status" => "success",'redirect' => '../../../../document-filling/nosubscription/'.$purchase['document_id']);
                    }
                    // elseif($purchase['legalization_id'] == null){
    
                    //     $json_data = array("status" => "success",'redirect' => '../../../../../../document-filling/nosubscription/buy-fill/show/'.$purchase['document_id'].'/'.$purchase['document_template_id']);
                    // }
                    else{
    
                        $json_data = array("status" => "success",'redirect' => '../../../../../../document-purchase/after/'.$purchase['document_id'].'/'.$purchase['document_template_id']);
                    }
                
               
            } 
            if ($purchase == false) {

                $json_data = array("status" => "error");
                
            } 
            return response()->json($json_data);
        
        }    
        return response()->json($json_data);
    }
    public function lawyerLink($id){

        $details = $this->legalizationRepo->getLegalisationDetails($id);

        $lawyer = $this->legalizationRepo->getDirectory($details['directory_id']);
        
        $template =$this->legalizationRepo->getTemplateDetails($details['document_id']);

        $statuses = $this->legalizationRepo->getLegalisationStatus();

        $table = strtolower($template->document_name);

        $template_table = $this->legalizationRepo->templateTableName($table);

        $document = $this->legalizationRepo->documentFilling($details['document_id'],$details['document_template_id'],$details['user_id'], $template_table);

        $user = $this->legalizationRepo->getUser($details['user_id']);

        return view('front.legalisation.lawyer_link')->with(['lawyer'=>$lawyer,'statuses'=>$statuses,'template'=>$template,'document'=>$document,'user'=>$user,'id'=>$id,'user_id'=>$details['user_id']]);

    }
    public function changeStatus(Request $request)
    {
        $data =$request->all();

        $status = $this->legalizationRepo->statusChange($data);
        if ($status == true) {
          
            $json_data = array("status" => "success");
        }
        if ($status == false) {

            $json_data = array("status" => "error", 'message' => __('test.error-status'));
        }
        return response()->json($json_data);
    }
    public function legalisationState(){

        $id = Auth::user()->id;
        $legal_details = $this->legalizationRepo->userLegalisationState($id);     
        return view('front.legalisation.profile_legalisation_states')->with(['legal_details'=>$legal_details]);
    }
    public function loadingLegalisation(Request $request){   
        $id = Auth::user()->id;
        $data = $request->all();
        $loading_details = $this->legalizationRepo->loadingLegalisationData($id,$data);     
        if($loading_details) {
            $html =  view('front.legalisation.legalisation_hidden')->with(['loading_details'=>$loading_details])->render();
        }
       return response()->json(["html" => $html]);
    }
    public function getDownload($document_id,$id)
    {       
            $type = 'stream';

            $data = [
                'document_id' => $document_id,
                'id' => $id,
            ];
            $labels = $this->templateRepo->getTemplateLabels($data);
            
            $templates = $this->templateRepo->getTemplateData($data);
                  
            $table = strtolower($templates->document_name);
            
            $template_table  = $this->nosubscrptionRepo->templateTableName($table); 
            $label_names = $this->nosubscrptionRepo->getNoSubscripiton($template_table,$data);
    
    
            $template = $this->templateRepo->getTemplate($document_id); 
    
            $label_count = $labels['label'];
            $fields = [];
            $count = count($label_count);
            for($i=0;$i<=$count;$i++){
                $fields[$i] = 'field_'.$i;
            }
            foreach($fields as $field){
                foreach($labels['label'] as $label){
                    if($label['fields'] == $field){
                        if($label['label_type'] == 'date'){
                            $replace_value = $label['label_name'];
                            $new_value = $label_names->$field;
                            $new_date = date('d-m-Y',strtotime($new_value));
                            $date = str_replace('-', '/', $new_date);
                            $template->text_body = str_replace($replace_value,$date,$template->text_body);
                        }
                        $replace_value = $label['label_name'];
                        $new_value = $label_names->$field;
                        $template->text_body = str_replace($replace_value,$new_value,$template->text_body);
                    }
                } 
            }
    
            $pdf = app('dompdf.wrapper')->loadView('front.document_filling.nosubscription.document_pdf',compact('template','document_id','id'), ['order' => $this]);
    
            if ($type == 'stream') {

                return $pdf->stream('document.pdf');
            }
            if ($type == 'download') {

                return $pdf->download('document.pdf');
            }
    
        }
}
