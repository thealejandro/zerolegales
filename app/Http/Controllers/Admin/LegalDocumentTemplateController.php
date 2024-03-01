<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\LegalDocumentTemplateRepository;
use App\Repository\InputVariableTemplateRepository;
use App\Repository\TemplateLabelRepository;
use App\Repository\InputVariableRepository;
use Validator;
use App\InputVariable;
use App\InputVariableTemplate;
use App\LegalDocumentTemplate;
use App\TemplateLabel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class LegalDocumentTemplateController extends Controller
{
    private $templateRepo,$variableDocumentRepo,$labelRepo,$variableRepo;


    public function __construct(LegalDocumentTemplateRepository $templateRepo,InputVariableTemplateRepository  $variableDocumentRepo,TemplateLabelRepository $labelRepo, InputVariableRepository $variableRepo)
    {
        $this->templateRepo = $templateRepo;
        $this->variableDocumentRepo = $variableDocumentRepo;
        $this->labelRepo =$labelRepo;
        $this->variableRepo = $variableRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = $this->templateRepo->all();
        return view('admin.template.index')->with(['templates' => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->templateRepo->getCategory(); 
        // $variables = InputVariable::where('user_relation', '=', 1)->get();
        $variables = InputVariable::all();
        $document_types = $this->templateRepo->getDocumentType();
        $types = $this->variableRepo->allInputVariableTypes(); // dd($types);
        return view('admin.template.create')->with(['categories' => $categories,'variables'=>$variables,'document_types'=> $document_types, 'input_variable_types' => $types]);
    }

    public function getInputVariables(Request $request)
    {
        $variables = $this->templateRepo->getInputVariable($request->document_id);

        if(count($variables) > 0) {
            return response()->json(['status' => true, 'data' => $variables]);
        } else {
            return response()->json(['status' => false, 'data' => []]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {// dd($request->all());
        $v = Validator::make($request->all(), $this->_rules('add', $request->document_id));
        if ($v->fails()) {
            return response()->json([
                'status' => false,
                'message' => __('test.please-fill'),
                'errors' => $v->errors()
            ], 401);
        }
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        if ($request->document_image) {
            $data['document_image'] =  $request->document_image->store('document_templates',['disk' => 'public']);
        }
        //dd($data);
        $table = str_replace(" ","_",strtolower($data['document_name']));
        $template_table  = $this->templateRepo->templateTableName($table); 
        if($data['template_type']!= 2){
            if($template_table == true){
                $json_data = array("status" => "error", "message" => __('test.document-name-exists'));        
            }
            if($template_table == false){
                $template = $this->templateRepo->saveDocumentTemplate($data,$auth_id);
            
            if ($template) {
                $json_data = array("status" => "success", "message" => __('test.success-document-store'),'id'=>$template->id,'template_type'=>$template->template_type,'redirect' => '/template');
            }
            if ($template == false) {
                $json_data = array("status" => "error", "message" => __('test.error-msg'));
    
            }
            
         }
        }
        else{

            $template = $this->templateRepo->saveDocumentTemplate($data,$auth_id);

            if ($template) {

                $json_data = array("status" => "success", "message" => __('test.success-document-store'),'id'=>$template->id,'template_type'=>$template->template_type,'redirect' => '/template');
            }
            if ($template == false) {
                
                $json_data = array("status" => "error", "message" => __('test.error-msg'));
    
            }
        }
       
     return response()->json($json_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->templateRepo->getCategory(); 
        $variables = $this->templateRepo->getInputVariable($id);
        $template = $this->templateRepo->getTemplate($id);
        $document_required = explode(",", $template->document_required);
        $subscription_category = explode(",", $template->subscription_category);
        $input_variables = $this->variableDocumentRepo->all($id);
        $document_types = $this->templateRepo->getDocumentType();
        $types = $this->variableRepo->allInputVariableTypes();
        return view('admin.template.edit')->with(['template'=>$template,'input_variables'=>$input_variables,'id'=>$id,
        'categories' => $categories,'variables'=>$variables,'document_required'=>$document_required,'subscription_category'=>$subscription_category,'document_types'=>$document_types,'input_variable_types' => $types]);
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $v = Validator::make($request->all(), $this->_rules('update'));
        if ($v->fails()) {
            return response()->json([
                'status' => false,
                'message' => __('test.please-fill'),
                'errors' => $v->errors()
            ], 401);
        }
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        if ($request->file('document_image')) {

            $data['document_image'] =  $request->document_image->store('document_templates',['disk' => 'public']);
        }
        $document_id = $data['document_id'];
        $input_variables = $this->variableDocumentRepo->all($document_id);
        $template = $this->templateRepo->updateDocumentTemplate($data,$auth_id,$input_variables);
        if ($template) {
             $json_data = array("status" => "success", "message" => __('test.success-document-update'),'id'=>$template->id,'redirect' => '/template');
        }
        if ($template == false) {
            $json_data = array("status" => "error", "message" => __('test.error-msg'));

        }
        return response()->json($json_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changeStatus(Request $request)
    {
        $data =$request->all();
        $status = $this->templateRepo->statusChange($data);
        if ($status == true) {
            if ($request->status == "1") {
                $json_data = array("status" => "success", 'message' => __('test.success-document-status_1'));
            }
            if ($request->status == "0") {
                $json_data = array("status" => "success", 'message' => __('test.success-document-status_0'));
            }
        }
        if ($status == false) {

            $json_data = array("status" => "error", 'message' => __('test.error-status'));
        }
        return response()->json($json_data);
    }
   
    public function storeVariableDocument(Request $request)
    {
        $request->validate([
            'variable_id' => 'required'
        ]);

        $fieldDetails = [];

        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $document_id = $data['document_id'];
        $variable = $this->variableDocumentRepo->saveInputVariable($data,$auth_id);
        $input_variables = $this->variableDocumentRepo->all($document_id);
        
        if($variable) {

            $fieldDetails = $this->fieldDetails($request->document_id);

            $json_data =[ 'view_1' => view('admin.template.input_variable')->with(['input_variables'=>$input_variables, 'fieldDetails' => $fieldDetails])->render(),
                          'view_2' => view('admin.template.body_variable')->with(['input_variables'=>$input_variables])->render(),
            ];
        }

        if($variable == false) {

            $json_data = array("status" => "error", "message" => __('test.error-msg'));
        }

        return response()->json($json_data);
    }
    // public function editVariableDocument(Request $request)
    // {

    //     $id = $request->input('id');

    //     $variable = $this->variableDocumentRepo->getInputvariable($id);

    //     return response()->json($variable);
    // }

    public function editVariableDocument(Request $request)
    {

        $id = $request->input('id');

        $variable = $this->variableDocumentRepo->getInputvariable($id);

        return response()->json($variable);
    }
    
    // public function updateVariableDocument(Request $request)
    // {
    //     $request->validate([
    //         'variable_id' => 'required'
    //     ]);
    //     $data = $request->all();
    //     $auth_id =\Auth::guard('admin')->user()->id;
    //     $variable = $this->variableDocumentRepo->updateInputvariable($data,$auth_id);
    //     $document_id = $variable->document_id;
    //     $input_variables = $this->variableDocumentRepo->all($document_id);
    //     if($variable) {

    //         $json_data =[ 'view_1' => view('admin.template.input_variable')->with(['input_variables'=>$input_variables])->render(),
    //         'view_2' => view('admin.template.body_variable')->with(['input_variables'=>$input_variables])->render(),
    //         ];  
    //     }
    //     if($variable == false) {

    //         $json_data = array("status" => "error", "message" => __('test.error-msg'));
    //     }
    //     return response()->json($json_data);
    // }

    public function updateVariableDocument(Request $request)
    {
        $request->validate([
            'edit_variable_template_id' => 'required',
            'variable_id2' => 'required'
        ]);
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $variable = $this->variableDocumentRepo->updateInputvariable($data,$auth_id);

        if($variable == 'exists') {

            $json_data = array("status" => false, "message" => __('test.variable_exist'));
            return response()->json($json_data);

        }

        if($variable) {

            $document_id = $variable->document_id;
            $input_variables = $this->variableDocumentRepo->all($document_id);

            $fieldDetails = $this->fieldDetails($document_id);

            $json_data =[ "status" => true, 'view_1' => view('admin.template.input_variable')->with(['input_variables'=>$input_variables, 'fieldDetails' => $fieldDetails])->render(),
            'view_2' => view('admin.template.body_variable')->with(['input_variables'=>$input_variables])->render(),
            'message' => __('test.input-variable-updated')
            ];  
        }
        if($variable == false) {

            $json_data = array("status" => false, "message" => __('test.error-msg'));
        }
        return response()->json($json_data);
    }

    // public function updateVariableDocument(Request $request)
    // {
    //     $request->validate([
    //         'edit_variable_id'          => 'required',
    //         'edit_variable_name'        => 'required',
    //         'edit_variable_type'        => 'required|exists:input_variable_types,id',
    //         'edit_variable_template_id' => 'required|exists:input_variable_templates,id'
    //     ]);
    //     $data = $request->all();
    //     $auth_id =\Auth::guard('admin')->user()->id;
    //     $variable = $this->variableDocumentRepo->updateInputvariable($data,$auth_id);
    //     $document_id = $variable->document_id;
    //     $input_variables = $this->variableDocumentRepo->all($document_id);
    //     if($variable) {

    //         $fieldDetails = $this->fieldDetails($document_id);

    //         $json_data =[ 'status' => true,'view_1' => view('admin.template.input_variable')->with(['input_variables'=>$input_variables, 'fieldDetails' => $fieldDetails])->render(),
    //         'view_2' => view('admin.template.body_variable')->with(['input_variables'=>$input_variables])->render(), 'message' => __('test.input-variable-updated')
    //         ];  
    //     }
    //     if($variable == false) {

    //         $json_data = array("status" => "error", "message" => __('test.error-msg'));
    //     }
    //     return response()->json($json_data);
    // }

    public function getEditFormInputVariables(Request $request)
    {
        $input_variables = $this->variableDocumentRepo->all($request->document_id);

        $fieldDetails = $this->fieldDetails($request->document_id);

        if($input_variables) {
            return $json_data =[ 'status' => true,'view_1' => view('admin.template.input_variable')->with(['input_variables'=>$input_variables, 'fieldDetails' => $fieldDetails])->render()]; 
        } 
    }

    public function fieldDetails($document_id)
    {
        $legalDocumentTemplate = LegalDocumentTemplate::find($document_id);

        $fieldDetails = [];

        if($legalDocumentTemplate) {

            $tableName = str_replace(" ","_",strtolower($legalDocumentTemplate->document_name));

            $template_table  = $this->templateRepo->templateTableName($tableName);

            if($template_table == true) {

                $totalRecordscount = \DB::table($tableName)->where('document_id',$document_id)->get(); 

                //  $totalRecordscount = \DB::select('select * from "'.$tableName.'" where document_id = ?', [$document_id]);  

                $templateLabels = TemplateLabel::where('document_id', '=', $document_id)->get();

                if(count($templateLabels) > 0) {

                    foreach($templateLabels as $templateLabel) {

                        if(Schema::hasColumn($tableName, $templateLabel->fields)) {

                            $field = \DB::table($tableName)
                                    ->where([
                                        ['document_id',$document_id],
                                        [$templateLabel->fields , null], // [$templateLabel->fields , null OR ''],
                                        ]
                                    )
                                    ->get();

                            if(count($totalRecordscount) == count($field)) {

                                $fieldDetails[] = $templateLabel->fields;

                            }
                        } 
                    }
                }
            }

            $inputVariableTemplates = InputVariableTemplate::where('document_id', '=', $document_id)->get();

            if(count($inputVariableTemplates) > 0) {

                foreach($inputVariableTemplates as $inputVariableTemplate) {

                    if(!Schema::hasColumn($tableName, $inputVariableTemplate->fields)) {
                            
                        $fieldDetails[] = $inputVariableTemplate->fields;

                    }

                }

            }
        }

        return $fieldDetails;
    }

    public function destroyVariableDocument(Request $request,$id)
    {
        $data = $request->all();
        $in_variables = $this->variableDocumentRepo->deleteInputVariable($data);

        $inputVariables = InputVariableTemplate::where('document_id', $data['document_id'])->count();

        if($inputVariables == 0) {

            $legalDocumentTemplate = LegalDocumentTemplate::find($data['document_id']);
            $legalDocumentTemplate->step2 = 0;
            $legalDocumentTemplate->save();
        }

        $input_variables = $this->variableDocumentRepo->all($data['document_id']);
        if ($in_variables == true) {

            $fieldDetails = $this->fieldDetails($request->document_id);

            $json_data =[ 'view_1' => view('admin.template.input_variable')->with(['input_variables'=>$input_variables, 'fieldDetails' => $fieldDetails])->render(),
            'view_2' => view('admin.template.body_variable')->with(['input_variables'=>$input_variables])->render(),
            ];          }
        if ($in_variables == false) {

            $json_data = array("status" => "error", "message" =>  __('test.error-msg'));
        }
        return response()->json($json_data);
    }
    private function _rules($key, $id = null)
    {
        if($id != null) {
            $validationString = 'required|regex:/^[A-Za-z0-9a-zñáéíóúü\s]+$/u|unique:legal_document_templates,document_name,'.$id;
        } else {
            $validationString = 'required|regex:/^[A-Za-z0-9a-zñáéíóúü\s]+$/u|unique:legal_document_templates,document_name';
        }

        $r = [
            'add' => [
                'template_type' => 'required',
                'document_name' => $validationString,
                'category_id' => 'required_with:template,[1,2]',
                'document_description' => 'required',
                'information_document' => 'required',
                'document_authentication' => 'required_with:template,[1]|in:yes,no',
                'subscription_category'=>'required',
                'document_required' => 'required_with:template,[1]',
                'subscription_category'=>'required_with:template,[1,2]',
                'document_image'=> 'required|image|mimes:png',
                // 'price'=>'required|max:22|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
                'price'=>'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/'
            ],
            'add_body' => [
              
                'text_body' => 'required',

            ],
            'update'=>[     
                'document_name' => 'required',
                'category_id' => 'required_with:template,[1,2]',
                'document_description' => 'required',
                'information_document' => 'required',
                'document_authentication' => 'required_with:template,[1]|in:yes,no',
                'subscription_category'=>'required_with:template,[1,2]',
                'document_required' => 'required_with:template,[1]',
                'subscription_category'=>'required_with:template,[1,2]',
                'text_body' => 'required',
                'document_image' => 'image|mimes:png',
                'price'=>'required|regex:/^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/'
            ]
        ];
        return $r[$key];
    }

    public function storeBody(Request $request)
    {
        $v = Validator::make($request->all(), $this->_rules('add_body'));
        if ($v->fails()) {
            return response()->json([
                'status' => false,
                'message' => __('test.please-fill'),
                'errors' => $v->errors()
            ], 401);
        }
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $document_id = $data['document_id'];
        $input_variables = $this->variableDocumentRepo->all($document_id);
        $template = $this->templateRepo->saveDocumentBody($data,$auth_id,$input_variables);
        if ($template) {

            $json_data = array("status" => "success", "message" => __('test.success-document-store'),'redirect' => '/template');
        }
        if ($template == false) {
        
            $json_data = array("status" => "error", "message" =>  __('test.error-msg'));
        }
        return response()->json($json_data);
    }
}
