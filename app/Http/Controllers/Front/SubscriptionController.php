<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\LegalDocumentTemplateRepository;
use App\Repository\UserRepository;
use App\Repository\MyFolderRepository;
use App\Repository\NosubscriptionRepository;
use App\Repository\LawyersDirectoryRepository;
use App\Repository\PriceMatrixRepository;
use App\Repository\LegalizationRepository;

class SubscriptionController extends Controller
{

    public function __construct(LegalDocumentTemplateRepository $templateRepo,UserRepository $userRepo,MyFolderRepository $myFolderRepo,
    NosubscriptionRepository $nosubscrptionRepo,LawyersDirectoryRepository $lawyersRepo,PriceMatrixRepository $priceRepo,LegalizationRepository $legalizationRepo)
    {
        $this->templateRepo = $templateRepo;
        $this->userRepo = $userRepo;
        $this->myFolderRepo = $myFolderRepo;
        $this->nosubscrptionRepo = $nosubscrptionRepo;
        $this->lawyersRepo=$lawyersRepo;
        $this->priceRepo = $priceRepo;
        $this->legalizationRepo = $legalizationRepo;


    }
    public function getDataForAutoFetch(Request $request){
        $data=$request->all();
        $labels = $this->templateRepo->getTemplateLabels($data);
        $user = $this->userRepo->getUserData($data);
        return response()->json(['labels'=>$labels,'user'=>$user]);
    }
    public function storeMyFolder(Request $request){
        $request->validate([
           // 'document_name' => 'required|unique:my_folders,document_name|unique:legal_document_templates,document_name',
            'document_name' => 'required',
            'document_description' => 'required|max:150',
        ]);
        $data=$request->all();
        $document_id =$data['document_id'];
        $id = $data['id'];
        $auth_id =\Auth::user()->id;

        $details = [
            'document_id' =>  $document_id,
            'id' => $id,
        ];
        $labels = $this->templateRepo->getTemplateLabels($details);
        
        $templates = $this->templateRepo->getTemplateData($details);
              
        $table = strtolower($templates->document_name);
        
        $template_table  = $this->nosubscrptionRepo->templateTableName($table); 
        $label_names = $this->nosubscrptionRepo->getNoSubscripiton($template_table,$data);


        $template = $this->templateRepo->getTemplate($data['document_id']); 

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

        $name = 'document'.date('YmdHis') . ".pdf" ;

        $file = 'myfolder'.'/'.$name;

        $storage_file = storage_path().'/app/public/'.$file;

        $pdf->save($storage_file);

        $folder = $this->myFolderRepo->saveMyFolder($data,$file,$auth_id);

        if($folder == true){

            return response()->download($storage_file);    
        }
    }
    public function myFolders(){
        $user = \Auth::guard('web');
        $categories = $this->templateRepo->getCategory();
        if($user->user() != null) {
            $auth_id = \Auth::user()->id; 
            $folders = $this->myFolderRepo->all($auth_id);
        } else {
            $folders = '';
        }
        
        return view('front.myfolder.index')->with(['folders' => $folders,'categories'=>$categories]);
    }
    public function show($folder_id){
        $folder = $this->myFolderRepo->documentInfo($folder_id);
        $document = $this->nosubscrptionRepo->getDocumentFilling($folder->document_id,$folder->document_template_id);
        $departments = $this->lawyersRepo->directoryDepartment();
        return view('front.myfolder.show')->with(['folder' => $folder,'departments'=>$departments,'document'=>$document,'document_id'=>$folder->document_id,'id'=>$folder->document_template_id]);
    }
    public function searchFolder(Request $request)
    {
        $data = $request->search;

        if ($request->ajax())
        {
            $folders = $this->myFolderRepo->searchFolder($data);
           
            if ($folders)
            {
                $json_data = view('front.myfolder.search_folder')->with(['folders'=>$folders])->render();
            }
            if($folders == false) {

                $json_data = array("status" => "error", "message" => __('test.error-msg'));
            }
            return response()->json($json_data);
        }
    }
    public function legalisationMyFolder(Request $request)
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
                    
                        $json_data = array("status" => "success",'redirect' => '../../../../../../myfolders/show/'.$purchase['document_id'].'/'.$purchase['document_template_id']);
                
               
            } 
            if ($purchase == false) {

                $json_data = array("status" => "error");
                
            } 
            return response()->json($json_data);
        
        }    
        return response()->json($json_data);
    }

    
}
