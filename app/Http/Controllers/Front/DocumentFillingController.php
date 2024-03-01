<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\LegalDocumentTemplateRepository;
use App\Repository\InputVariableTemplateRepository;
use App\Repository\NosubscriptionRepository;
use App\Repository\TemplateLabelRepository;
use App\Repository\LawyersDirectoryRepository;
use App\Repository\PriceMatrixRepository;
use Validator;
use App\Repository\PurchaseRepository;
use App\Repository\LegalizationRepository;
use App\Repository\ProfileRepository;
use Auth;
use PDF;

class DocumentFillingController extends Controller
{
    private $templateRepo,$nosubscrptionRepo,$variableDocumentRepo,$labelRepo,$priceRepo,$purchaseRepo,$legalizationRepo;

    public function __construct(LegalDocumentTemplateRepository $templateRepo,InputVariableTemplateRepository  $variableDocumentRepo,PurchaseRepository $purchaseRepo,ProfileRepository $profileRepo,
    TemplateLabelRepository $labelRepo,NosubscriptionRepository $nosubscrptionRepo,LawyersDirectoryRepository $lawyersRepo,PriceMatrixRepository $priceRepo,LegalizationRepository $legalizationRepo)
    {
        $this->templateRepo = $templateRepo;
        $this->variableDocumentRepo = $variableDocumentRepo;
        $this->nosubscrptionRepo = $nosubscrptionRepo;
        $this->labelRepo = $labelRepo;
        $this->lawyersRepo=$lawyersRepo;
        $this->priceRepo = $priceRepo;
        $this->purchaseRepo = $purchaseRepo;
        $this->legalizationRepo=$legalizationRepo;
        $this->profileRepo=$profileRepo;

    }
    public function createFillBuy($id){
        $labels = $this->labelRepo->all($id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplateDetail($id);
        return view('front.document_filling.fillandbuy.create')->with(['template' => $template,'col_count'=>$col_count,'labels'=>$labels,'id'=>$id]);
    }
     public function createBuyFill($id,$invoice_id){
        $labels = $this->labelRepo->all($id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplateDetail($id);
        return view('front.document_filling.buyandfill.create')->with(['template' => $template,'labels'=>$labels,'id'=>$id,'col_count'=>$col_count,'invoice_id'=>$invoice_id]);
    }
    public function createDocumentFilling($id){
        $labels = $this->labelRepo->all($id);
        $col_count = $labels->count();
        $subscription = $this->profileRepo->getSubscriptionData();
        $template = $this->templateRepo->getTemplateDetail($id);
        return view('front.document_filling.subscription.create')->with(['template' => $template,'labels'=>$labels,'id'=>$id,'col_count'=>$col_count,'subscription'=> $subscription]);
    }
    public function storeFillBuy(Request $request){
        $document_id = $request->document_id;
        $labels = $this->labelRepo->all($document_id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplate($document_id);      
        $table = strtolower($template->document_name);
        $template_table  = $this->nosubscrptionRepo->templateTableName($table); 
        $subscription = $this->profileRepo->getSubscriptionData();
        $validate_array = [];
        $messages = [
            'required' =>'este campo es requerido',
            'regex' =>'Ingrese un número correcto, formato 0.00',
            'integer' => 'Este campo debe ser un número entero',
        ];
        foreach($labels as $key=>$label){
            if($label->label_type == 'date'){
                $validate_array['field_'. $key] = 'required';
            }
            if($label->label_type == 'string'){
                $validate_array['field_'. $key] = 'required'; 
            }
          if($label->label_type == 'decimal'){
                $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
            }
            if($label->label_type == 'integer'){
                $validate_array['field_'. $key] = 'required|integer';
            }
            if($label->label_type == 'year'){
                $validate_array['field_'. $key] = 'required'; 
            }
               
        }
        $v = Validator::make($request->all(),$validate_array,$messages);
        if ($v->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $v->errors()
            ], 401);
        }       
        $data = $request->all();
        $auth_id =\Auth::user()->id;
        // $documentPurchase = $this->legalizationRepo->documentPurchaseDetails($document_id);
        $nosubscription = $this->nosubscrptionRepo->saveData($template_table ,$col_count,$data,$auth_id,$labels,$subscription); 

        if ($nosubscription) {

            $json_data = array("status" => "success",'redirect' => '../../../../document-filling/nosubscription/fill-buy/show/'.$document_id.'/'.$nosubscription,'id'=>$nosubscription,'labels'=>$labels);

        }
        if ($nosubscription == false) {

            $json_data = array("status" => "error");
        }
        return response()->json($json_data);

    }
    public function storeBuyFill(Request $request){

        $document_id = $request->document_id;
        $labels = $this->labelRepo->all($document_id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplate($document_id);      
        $table = strtolower($template->document_name);
        $template_table  = $this->nosubscrptionRepo->templateTableName($table); 
        $subscription = $this->profileRepo->getSubscriptionData();
        $validate_array = [];
        $messages = [
            'required' =>'este campo es requerido',
            'regex' =>'Ingrese un número correcto, formato 0.00',
            'integer' => 'Este campo debe ser un número entero',
        ];
        foreach($labels as $key=>$label){
            if(Auth::user()->user_type==2){
               if($subscription['subscriptionType']['id'] != 3){

                 if($label->user_relation == 0){   
                    
                        if($label->label_type == 'date'){
                            $validate_array['field_'. $key] = 'required';
                        }
                        if($label->label_type == 'string'){
                            $validate_array['field_'. $key] = 'required'; 
                        }
                      if($label->label_type == 'decimal'){
                            $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
                        }
                        if($label->label_type == 'integer'){
                            $validate_array['field_'. $key] = 'required|integer';
                        }
                        if($label->label_type == 'year'){
                            $validate_array['field_'. $key] = 'required'; 
                        }
                           
                    
                 }
               }
               else{
                if($label->user_relation == 0){   
                    
                        if($label->label_type == 'date'){
                            $validate_array['field_'. $key] = 'required';
                        }
                        if($label->label_type == 'string'){
                            $validate_array['field_'. $key] = 'required'; 
                        }
                      if($label->label_type == 'decimal'){
                            $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
                        }
                        if($label->label_type == 'integer'){
                            $validate_array['field_'. $key] = 'required|integer';
                        }
                        if($label->label_type == 'year'){
                            $validate_array['field_'. $key] = 'required'; 
                        }
                           
                    
                }
                // $validate_array['expiry_date'] = 'required'; 
               }
                
            }
            else{

                
                    if($label->label_type == 'date'){
                        $validate_array['field_'. $key] = 'required';
                    }
                    if($label->label_type == 'string'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                  if($label->label_type == 'decimal'){
                        $validate_array['field_'. $key] = 'required||regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
                    }
                    if($label->label_type == 'integer'){
                        $validate_array['field_'. $key] = 'required|integer';
                    }
                    if($label->label_type == 'year'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                       
                
            }
               
        }
        $v = Validator::make($request->all(),$validate_array,$messages);
        if ($v->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $v->errors()
            ], 401);
        }       
        $data = $request->all();
        $auth_id =\Auth::user()->id;
        
        // $documentPurchase = $this->legalizationRepo->documentPurchaseDetails($document_id);

        $nosubscription = $this->nosubscrptionRepo->saveData($template_table ,$col_count,$data,$auth_id,$labels,$subscription); 

        if ($nosubscription) {

            $json_data = array("status" => "success",'redirect' => '../../../../document-filling/nosubscription/buy-fill/show/'.$document_id.'/'.$nosubscription,'id'=>$nosubscription,'labels'=>$labels);

        }
        if ($nosubscription == false) {

            $json_data = array("status" => "error");
        }
        return response()->json($json_data);

    }
    public function showFillBuy($document_id,$id){

        $price = $this->priceRepo->getPriceDocument($document_id);
        $departments = $this->lawyersRepo->directoryDepartment();
        $legalization_price = 297.00;
        $total_price = $price['price'] +$legalization_price;
        $template = $this->templateRepo->getTemplateDetail($document_id); 
        $legal_document = $this->legalizationRepo->legalisationDetail($document_id,$id);  
        $purchases = $this->purchaseRepo->getDocumentInvoice($document_id,$id); 
        $document_filling = $this->nosubscrptionRepo->getDocumentFilling($document_id,$id);
        return view('front.document_filling.fillandbuy.show')->with(['document_filling'=>$document_filling,'total_price'=>$total_price,'template' => $template,'id'=>$id,'document_id'=>$document_id,'departments'=>$departments,'legal_document'=>$legal_document,'price'=> $price,'purchases'=>$purchases]);
    }
    public function showBuyFill($document_id,$id){
        $price = $this->priceRepo->getPriceDocument($document_id);
        $departments = $this->lawyersRepo->directoryDepartment();
        $template = $this->templateRepo->getTemplateDetail($document_id); 
        $purchases = $this->purchaseRepo->getDocumentInvoice($document_id,$id);
        $legal_document = $this->legalizationRepo->legalisationDetail($document_id,$id);
        $document_filling = $this->nosubscrptionRepo->getDocumentFilling($document_id,$id);
        return view('front.document_filling.buyandfill.show')->with(['document_filling'=>$document_filling,'template' => $template,'id'=>$id,'document_id'=>$document_id,'departments'=>$departments,'legal_document'=>$legal_document,'price'=> $price,'purchases'=>$purchases]);
    }
    public function getLabels(Request $request){
        $data=$request->all();
        $labels = $this->templateRepo->getTemplateLabels($data);
        $template = $this->templateRepo->getTemplateData($data);      
        $table = strtolower($template->document_name);
        $template_table  = $this->nosubscrptionRepo->templateTableName($table); 
        $label_names = $this->nosubscrptionRepo->getNoSubscripiton($template_table,$data);
        return response()->json(['labels'=>$labels,'label_names'=>$label_names]);
    }
   
    public function editFillBuy($document_id,$id){
        $labels = $this->labelRepo->all($document_id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplate($document_id);      
        $table = strtolower($template->document_name);
        $template_table  = $this->nosubscrptionRepo->templateTableName($table); 
        $nosubscription = $this->nosubscrptionRepo->getNoSubscripitonData($template_table,$id);
        return view('front.document_filling.fillandbuy.edit')->with(['template' => $template,'labels'=>$labels,'id'=>$id,'document_id'=>$document_id,'nosubscription'=>$nosubscription,'col_count'=>$col_count]);
    }
    public function updateFillBuy(Request $request){
        
        $document_id = $request->document_id;
        $id  = $request->id;
        $labels = $this->labelRepo->all($document_id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplate($document_id);      
        // $table = strtolower($template->document_name);
        $table = str_replace(" ","_",strtolower($template->document_name));
        $validate_array = [];
        $messages = [
            'required' =>'este campo es requerido',
            'regex' =>'Ingrese un número correcto, formato 0.00',
            'integer' => 'Este campo debe ser un número entero',
        ];
        foreach($labels as $key=>$label){
            if($label->label_type == 'date'){
                $validate_array['field_'. $key] = 'required';
            }
            if($label->label_type == 'string'){
                $validate_array['field_'. $key] = 'required'; 
            }
          if($label->label_type == 'decimal'){
                $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
            }
            if($label->label_type == 'integer'){
                $validate_array['field_'. $key] = 'required|integer';
            }
            if($label->label_type == 'year'){
                $validate_array['field_'. $key] = 'required'; 
            }
               
        }
        $v = Validator::make($request->all(),$validate_array,$messages);
        if ($v->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $v->errors()
            ], 401);
        }       
        $data = $request->all();
        $auth_id =\Auth::user()->id;
        
        $nosubscription = $this->nosubscrptionRepo->updateData($table,$col_count,$data,$auth_id,$labels); 
        if ($nosubscription == true) {

            $json_data = array("status" => "success", 'redirect' => './../../../../../document-filling/nosubscription/fill-buy/show/'.$document_id.'/'.$id);

        }
        if ($nosubscription == false) {

            $json_data = array("status" => "error");
        }
        return response()->json($json_data);
    }
    public function editBuyFill($document_id,$id){
        $labels = $this->labelRepo->all($document_id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplate($document_id);      
        $table = strtolower($template->document_name);
        $template_table  = $this->nosubscrptionRepo->templateTableName($table); 
        $nosubscription = $this->nosubscrptionRepo->getNoSubscripitonData($template_table,$id);
        $subscription = $this->profileRepo->getSubscriptionData();
        return view('front.document_filling.buyandfill.edit')->with(['template' => $template,'labels'=>$labels,'id'=>$id,'document_id'=>$document_id,'nosubscription'=>$nosubscription,'col_count'=>$col_count,'subscription'=>$subscription]);
    }
    public function updateBuyFill(Request $request){
        
        $document_id = $request->document_id;
        $id  = $request->id;
        $labels = $this->labelRepo->all($document_id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplate($document_id);      
        // $table = strtolower($template->document_name);
        $table = str_replace(" ","_",strtolower($template->document_name));
        $subscription = $this->profileRepo->getSubscriptionData();
        $validate_array = [];
        $messages = [
            'required' =>'este campo es requerido',
            'regex' =>'Ingrese un número correcto, formato 0.00',
            'integer' => 'Este campo debe ser un número entero',
        ];
        foreach($labels as $key=>$label){
            if(Auth::user()->user_type==2){
               if($subscription['subscriptionType']['id'] != 3){

                 if($label->user_relation == 0){   
                    if($label->label_type == 'date'){
                        $validate_array['field_'. $key] = 'required';
                    }
                    if($label->label_type == 'string'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                  if($label->label_type == 'decimal'){
                        $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
                    }
                    if($label->label_type == 'integer'){
                        $validate_array['field_'. $key] = 'required|integer';
                    }
                    if($label->label_type == 'year'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                       
                 }
               }
               else{
                if($label->user_relation == 0){   
                    if($label->label_type == 'date'){
                        $validate_array['field_'. $key] = 'required';
                    }
                    if($label->label_type == 'string'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                  if($label->label_type == 'decimal'){
                        $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
                    }
                    if($label->label_type == 'integer'){
                        $validate_array['field_'. $key] = 'required|integer';
                    }
                    if($label->label_type == 'year'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                       
                }
                // $validate_array['expiry_date'] = 'required'; 
               }
                
            }
            else{

                if($label->label_type == 'date'){
                    $validate_array['field_'. $key] = 'required';
                }
                if($label->label_type == 'string'){
                    $validate_array['field_'. $key] = 'required'; 
                }
                if($label->label_type == 'decimal'){
                    $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
                }
                if($label->label_type == 'integer'){
                    $validate_array['field_'. $key] = 'required|integer';
                }
                if($label->label_type == 'year'){
                    $validate_array['field_'. $key] = 'required'; 
                }
                   
            }
               
        }
        $v = Validator::make($request->all(),$validate_array,$messages);
        if ($v->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $v->errors()
            ], 401);
        }       
        $data = $request->all();
        $auth_id =\Auth::user()->id;
        $nosubscription = $this->nosubscrptionRepo->updateData($table,$col_count,$data,$auth_id,$labels); 
        if ($nosubscription == true) {

            $json_data = array("status" => "success", 'redirect' => './../../../../../document-filling/nosubscription/buy-fill/show/'.$document_id.'/'.$id);

        }
        if ($nosubscription == false) {

            $json_data = array("status" => "error");
        }
        return response()->json($json_data);
    }
    public function change(Request $request){
        $data = $request->all();
        $directories = $this->lawyersRepo->directoryAll($data);
        if($directories) {

            $html =  view('front.document_filling.nosubscription.legaldocument')->with(['directories'=>$directories])->render();
        }
       return response()->json(["html" => $html]);
    }
    public function editAfterPurchase($document_id,$id){
        $labels = $this->labelRepo->all($document_id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplate($document_id);      
        $table = strtolower($template->document_name);
        $template_table  = $this->nosubscrptionRepo->templateTableName($table); 
        $nosubscription = $this->nosubscrptionRepo->getNoSubscripitonData($template_table,$id);
        $subscription = $this->profileRepo->getSubscriptionData();
        return view('front.document_filling.nosubscription.after_purchase_edit')->with(['template' => $template,'col_count'=>$col_count,'labels'=>$labels,'id'=>$id,'document_id'=>$document_id,'nosubscription'=>$nosubscription,'subscription'=>$subscription]);
    }
    public function updateAfterPurchase(Request $request){
        
        $document_id = $request->document_id;
        $id  = $request->id;
        $legalisation_id = $request->legalisation_id ;
        $labels = $this->labelRepo->all($document_id);
        $col_count = $labels->count();
        $template = $this->templateRepo->getTemplate($document_id);      
        // $table = strtolower($template->document_name);
        $table = str_replace(" ","_",strtolower($template->document_name));
        $subscription = $this->profileRepo->getSubscriptionData();
         $validate_array = [];
         $messages = [
            'required' =>'este campo es requerido',
            'regex' =>'Ingrese un número correcto, formato 0.00',
            'integer' => 'Este campo debe ser un número entero',
        ];
         foreach($labels as $key=>$label){
            if(Auth::user()->user_type==2){
               if($subscription['subscriptionType']['id'] != 3){

                 if($label->user_relation == 0){   
                    if($label->label_type == 'date'){
                        $validate_array['field_'. $key] = 'required';
                    }
                    if($label->label_type == 'string'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                    if($label->label_type == 'decimal'){
                        $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
                    }
                    if($label->label_type == 'integer'){
                        $validate_array['field_'. $key] = 'required|integer';
                    }
                    if($label->label_type == 'year'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                 }
               }
               else{
                if($label->user_relation == 0){   
                    if($label->label_type == 'date'){
                        $validate_array['field_'. $key] = 'required';
                    }
                    if($label->label_type == 'string'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                    if($label->label_type == 'decimal'){
                        $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
                    }
                    if($label->label_type == 'integer'){
                        $validate_array['field_'. $key] = 'required|integer';
                    }
                    if($label->label_type == 'year'){
                        $validate_array['field_'. $key] = 'required'; 
                    }
                }
                // $validate_array['expiry_date'] = 'required'; 
               }
                
            }
            else{

                if($label->label_type == 'date'){
                    $validate_array['field_'. $key] = 'required';
                }
                if($label->label_type == 'string'){
                    $validate_array['field_'. $key] = 'required'; 
                }
                if($label->label_type == 'decimal'){
                    $validate_array['field_'. $key] = 'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/';
                }
                if($label->label_type == 'integer'){
                    $validate_array['field_'. $key] = 'required|integer';
                }
                if($label->label_type == 'year'){
                    $validate_array['field_'. $key] = 'required'; 
                } 
            }
               
        }
        $v = Validator::make($request->all(),$validate_array,$messages);
        if ($v->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $v->errors()
            ], 401);
        }       
        $data = $request->all();
        $auth_id =\Auth::user()->id;
        
        $nosubscription = $this->nosubscrptionRepo->updateData($table,$col_count,$data,$auth_id,$labels);

        if ($nosubscription == true) {

            $json_data = array("status" => "success", 'redirect' => '../../../../../../document-purchase/after/'.$data['document_id'].'/'.$id );

        }
        if ($nosubscription == false) {

            $json_data = array("status" => "error");
        }
        return response()->json($json_data);
    }
    public function removeWatermark($document_id,$id){
        $template = $this->templateRepo->getTemplate($document_id);    
        $conditions = $this->templateRepo->getTermsAndCondition();  
        return view('front.document_filling.nosubscription.save_download')->with(['template'=>$template,'document_id'=>$document_id,'id'=>$id,'conditions'=>$conditions]);
    }

    /**
     * Document PDF View
     */
    public function documentPdfVAiew($document_id,$id){
        $type = 'download';

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
        // return view('front.document_filling.nosubscription.document_pdf')->with(['template'=>$template,'document_id'=>$document_id,'id'=>$id]);

        if ($type == 'stream') {
            return $pdf->stream('document.pdf');
        }
    
        if ($type == 'download') {
             
            return $pdf->download('document.pdf');
        }
    }

    public function documentInProgress(){
        $documents = $this->nosubscrptionRepo->documentProgress();
        return view('front.document.document_in_progress')->with(['documents'=>$documents]);
    }

    public function pdfDownload(Request $request,$document_id,$id){
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
        // return view('front.document_filling.nosubscription.document_pdf')->with(['template'=>$template,'document_id'=>$document_id,'id'=>$id]);

        if ($type == 'stream') {
            return $pdf->stream('document.pdf');
        }
    

    }
    public function afterPurchase($document_id,$id){

        $user_id = Auth::user()->id;

        $template = $this->legalizationRepo->getTemplateDetails($document_id);

        $table = strtolower($template->document_name);

        $template_table = $this->legalizationRepo->templateTableName($table);

        $document = $this->legalizationRepo->documentFilling($document_id,$id,$user_id, $template_table);
        
        $document_filling = $this->nosubscrptionRepo->getDocumentFilling($document_id,$id);

        return view('front.document_filling.nosubscription.after_purchase')->with(['template'=>$template,'id'=>$document->id,'document_id'=>$document_id,'document_filling'=>$document_filling]);
    }
    // public function afterDownload($document_id,$id){

    //     $template = $this->templateRepo->getTemplate($document_id);  

    //     return view('front.document_filling.nosubscription.after_download')->with(['template'=>$template,'document_id'=>$document_id,'id'=>$id]);

    // }
    public function updateDownloadStatus(Request $request){
        $data = $request->all();
        $status = $this->nosubscrptionRepo->updateStatus($data);
        if ($status == true) {
            $json_data = array("status" => "success");
        }
        if ($status == false) {
            $json_data = array("status" => "error");
        }
    }
}
