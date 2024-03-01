<?php

namespace App\Repository;


use App\LegalDocumentTemplate;
use App\Category;
use App\InputVariable;
use App\DocumentType;
use App\InputVariableTemplate;
use Exception;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\TemplateLabel;
use App\PriceMatrix;
use App\TermsAndCondition;

class LegalDocumentTemplateRepository
{
    public function all(){
        try {
            $templates =  LegalDocumentTemplate::with(['documentType','category'])->orderBy('id', 'DESC')->get();
            return $templates;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getCategory(){
        try {

            $categories =  Category::get();
            return $categories;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getInputVariable($document_id){
        try {
            $variableList = [];
            $inputVariableTemplates = InputVariableTemplate::where('document_id', '=', $document_id)
                                                            ->pluck('variable_id')
                                                            ->toArray();

            $variables =  InputVariable:://where('user_relation', '=', 1)
                                        // ->orwhere('document_id', '=', $document_id)
                                        // ->whereNotIn('id', $inputVariableTemplates)
                                        // ->get();
                                        all();

            if(count($variables) > 0) {

                foreach($variables as $variable) {

                    if(!in_array($variable->id, $inputVariableTemplates)) {

                        $variableList[] = $variable;
                    }
                }
            }

            return $variableList;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function saveDocumentTemplate($data,$auth_id){
        try {
            DB::beginTransaction();

            if($data['document_id'] == null) {
                if($data['template_type'] == 2) {
                 
                    $template = new LegalDocumentTemplate();
                    $template->template_type = $data['template_type'];
                    $template->category_id = $data['category_id'];
                    $template->document_name = $data['document_name'];
                    $template->document_description = $data['document_description'];
                    $template->information_document = $data['information_document'];
                    $template->document_image = $data['document_image'];
                    $template->subscription_category =  implode(",", $data['subscription_category']);
                    $template->price = $data['price'];
                    $template->created_by = $auth_id;
                    $template->step1 = 1;
                    $template->save();
                    $price = new PriceMatrix();
                    $price->subscription_id = 1;      
                    $price->document_id = $template->id;                  
                    $price->price = $data['price'];
                    $price->created_by = $auth_id;
                    $price->save();                
                } else {
                    $template = new LegalDocumentTemplate();
                    $template->template_type = $data['template_type'];
                    $template->document_name = $data['document_name'];
                    $template->category_id = $data['category_id'];
                    $template->document_description = $data['document_description'];
                    $template->information_document = $data['information_document'];
                    $template->document_authentication = $data['document_authentication'];
                    $template->document_required= implode(",", $data['document_required']);
                    $template->subscription_category =  implode(",", $data['subscription_category']);
                    $template->document_image = $data['document_image'];
                    $template->price = $data['price'];
                    $template->created_by = $auth_id;
                    $template->step1 = 1;
                    $template->save();
                    $price = new PriceMatrix();
                    $price->subscription_id = 1;      
                    $price->document_id = $template->id;                              
                    $price->price = $data['price'];
                    $price->created_by = $auth_id;
                    $price->save();                
                }

                if(!$price) {
                    throw new \Exception('Table Creation Failed');
                }

            } else {

                if($data['template_type'] == 2) {
                 
                    $template = LegalDocumentTemplate::find($data['document_id']);
                    $template->template_type = $data['template_type'];
                    $template->category_id = $data['category_id'];
                    $template->document_name = $data['document_name'];
                    $template->document_description = $data['document_description'];
                    $template->information_document = $data['information_document'];
                    \Storage::disk('public')->delete($template->document_image);
                    $template->document_image = $data['document_image'];
                    $template->subscription_category =  implode(",", $data['subscription_category']);
                    $template->price = $data['price'];
                    $template->created_by = $auth_id;
                    $template->step1 = 1;
                    $template->document_authentication = null;
                    $template->document_required = null;
                    $template->save();
                    $price = PriceMatrix::find($data['document_id']);
                    $price->subscription_id = 1;      
                    $price->document_id = $template->id;                  
                    $price->price = $data['price'];
                    $price->created_by = $auth_id;
                    $price->save();

                } else {

                    $template = LegalDocumentTemplate::find($data['document_id']);
                    $template->template_type = $data['template_type'];
                    $template->document_name = $data['document_name'];
                    $template->category_id = $data['category_id'];
                    $template->document_description = $data['document_description'];
                    $template->information_document = $data['information_document'];
                    $template->document_authentication = $data['document_authentication'];
                    $template->document_required= implode(",", $data['document_required']);
                    $template->subscription_category =  implode(",", $data['subscription_category']);
                    \Storage::disk('public')->delete($template->document_image);
                    $template->document_image = $data['document_image'];
                    $template->price = $data['price'];
                    $template->created_by = $auth_id;
                    $template->step1 = 1;
                    $template->save();
                    $price = PriceMatrix::find($data['document_id']);
                    $price->subscription_id = 1;      
                    $price->document_id = $template->id;                              
                    $price->price = $data['price'];
                    $price->created_by = $auth_id;
                    $price->save();

                }

                if(!$price) {
                    throw new \Exception('Table Creation Failed');
                }
            }
                
            DB::commit();
            
            return  $template;
        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }
    public function statusChange($data)
    {
        try {
            $templateStatus = LegalDocumentTemplate::find($data['id']);
            $templateStatus->is_active = $data['status'];
            $templateStatus->save();
            return true;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function saveDocumentBody($data,$auth_id,$input_variables){
        try {
            if($data['template_type'] != 2){

                DB::beginTransaction();

                $tableColumns = [];

                $template = LegalDocumentTemplate::find($data['document_id']);
                $template->text_body = html_entity_decode($data['text_body']);
                $template->created_by = $auth_id;
                $template->created_at = date('Y-m-d H:i:s');
                $template->step3 = 1;
                $template->save();

                // foreach($input_variables as $key=>$variable) {

                //     $attribute_column = $variable->variable_name;
                
                //     $templateLabels = TemplateLabel::select('id', 'fields', 'table_name')->where(['document_id' => $data['document_id'], 'label_name' => $attribute_column])->first();

                //     if($templateLabels)
                //         $tableColumns[] = $templateLabels->id;
                // }

                // $docTemaplates = TemplateLabel::where('document_id', '=', $data['document_id'])->get();
                // $deletedLabels = [];

                // if(count($docTemaplates) > 0) {

                //     foreach($docTemaplates as $docTemaplate) {
                //         if(!in_array($docTemaplate->id, $tableColumns)) {

                //             $deletedLabels[] = ['id' => $docTemaplate->id, 'column_name' => $docTemaplate->fields, 'table_name' => $docTemaplate->table_name];
                //             $docTemaplate->delete();

                //         }
                //     }
                // }

                // if(count($deletedLabels) > 0) {
                //     $this->deleteTableColumns(str_replace(" ","_",strtolower($template->document_name)), $deletedLabels);
                // }

                    foreach($input_variables as $key=>$variable){

                        $attribute_column = $variable->variable_name;
                        $label_type       = strtolower($variable->variable_type);
            
                        $fields[] = ['name' => $variable->fields, 'type' =>$variable->variable_type]; // fields

                        $label[] = [
                                    'document_id'   =>  $data['document_id'],
                                    'table_name'    =>  str_replace(" ","_",strtolower($template->document_name)), // strtolower($template->document_name)
                                    'fields'        =>  $variable->fields,
                                    'user_relation' =>  $variable->user_relation,
                                    'label_name'    =>  $attribute_column,
                                    'label_type'    =>  $label_type,
                                    'created_by'    =>  $auth_id,
                                    'created_at'    =>  date('Y-m-d H:i:s')            
                                   ];
                    }

                    $table_name = str_replace(" ","_",strtolower($template->document_name));
                    $this->createTable($table_name,$fields);
                    $labels = TemplateLabel::insert($label);
                    if(!$labels) {
                        throw new \Exception('Table Creation Failed');
                    }
                    DB::commit();
            }
            else{

                $template = LegalDocumentTemplate::find($data['document_id']);
                $template->text_body = $data['text_body'];
                $template->created_by = $auth_id;
                $template->step2 = 1;
                $template->created_at = date('Y-m-d H:i:s');
                $template->save();
            }
             
            return $template;

        } catch (Exception $e) {
            DB::rollback();
            logger()->error($e);
            return false;
        }
    }

    public function deleteTableColumns($tableName, $droppingColumns = [])
    {
        Schema::table($tableName, function (Blueprint $table) use($droppingColumns){

            if(count($droppingColumns) > 0) {

                foreach($droppingColumns as $droppingColumn) {

                    $table->dropColumn($droppingColumn['column_name']);

                }
                
            }
        });

        return true;
    }

    public function getTemplate($id){
            try {
                $template = LegalDocumentTemplate::find($id);

                return $template;
            } catch (Exception $e) {
    
                logger()->error($e);
                return false;
            }
        
    }
    public function updateDocumentTemplate($data,$auth_id,$input_variables){
        try {
                DB::beginTransaction();
                $template = LegalDocumentTemplate::find($data['document_id']);
                $template->document_name = $data['document_name'];

                if($template->template_type != 2){
                    $template->category_id = $data['category_id'];
                    $template->document_required= implode(",", $data['document_required']);
                    $template->document_authentication = $data['document_authentication'];
                    $template->step3 = 1;
                    /****************************************** */
                    $tableColumns = [];
                    $newColumns = [];
                    $newLabels = [];
                    $tableName = str_replace(" ","_",strtolower($template->document_name));

                    // foreach($input_variables as $key=>$variable) {

                    //     $attribute_column = $variable->variable_name;
                    //     $label_type       = strtolower($variable->variable_type);
                    
                    //     $templateLabels = TemplateLabel::select('id', 'fields', 'table_name')->where(['document_id' => $data['document_id'], 'label_name' => $attribute_column])->first();
    
                    //     if($templateLabels) {

                    //         $tableColumns[] = $templateLabels->id;

                    //     } else {

                    //         // for($i=0; $i<=count($input_variables); $i++) {
                                
                    //         //     $fieldExist = TemplateLabel::where(['document_id' => $data['document_id'], 'table_name' => str_replace(" ","_",strtolower($template->document_name)), 'fields' => 'field_'.$i])->exists();
                                
                    //         //     if($fieldExist) {
                    //         //         continue;
                    //         //     }

                    //         //     $fieldName = 'field_'.$i;
                    //         //     break;
                    //         // }
                    //         $fieldName = $variable->fields;
                            
                    //         $newColumns[] = ['name' => $fieldName, 'type' =>$variable->variable_type];

                    //         $newLabels[] = [
                    //                             'document_id'   =>  $data['document_id'],
                    //                             'table_name'    =>  str_replace(" ","_",strtolower($template->document_name)), // strtolower($template->document_name)
                    //                             'fields'        =>  $fieldName,
                    //                             'user_relation' =>  $variable->user_relation,
                    //                             'label_name'    =>  $attribute_column,
                    //                             'label_type'    =>  $label_type,
                    //                             'created_by'    =>  $auth_id, // \Auth::guard('admin')->user()->id,
                    //                             'created_at'    =>  date('Y-m-d H:i:s'),             
                    //                         ];
                    //     }
                    // }
    
                    // $docTemaplates = TemplateLabel::where('document_id', '=', $data['document_id'])->get();
                    // $deletedLabels = [];
    
                    // if(count($docTemaplates) > 0) {
    
                    //     foreach($docTemaplates as $docTemaplate) {

                    //         if(!in_array($docTemaplate->id, $tableColumns)) {
    
                    //             $deletedLabels[] = ['id' => $docTemaplate->id, 'column_name' => $docTemaplate->fields, 'table_name' => $docTemaplate->table_name];
                    //             $docTemaplate->delete();
    
                    //         }
                    //     }
                    // }
    
                    // if(count($deletedLabels) > 0) {
                    //     $this->deleteTableColumns(str_replace(" ","_",strtolower($template->document_name)), $deletedLabels);
                    // }

                    // if(count($newColumns) > 0)
                    //     $this->addNewColumns(str_replace(" ","_",strtolower($template->document_name)), $newColumns);

                    // if(count($newLabels) > 0)
                    //     TemplateLabel::insert($newLabels);

                    /****************************************** */

                    /* ========================================== */

                    $template_table  = $this->templateTableName($tableName);

                    if(!$template_table) {

                        foreach($input_variables as $key=>$variable){

                            $attribute_column = $variable->variable_name;
                            $label_type       = strtolower($variable->variable_type);
                
                            $fields[] = ['name' => $variable->fields, 'type' =>$variable->variable_type]; // fields
    
                            $label[] = [
                                        'document_id'   =>  $data['document_id'],
                                        'table_name'    =>  str_replace(" ","_",strtolower($template->document_name)), // strtolower($template->document_name)
                                        'fields'        =>  $variable->fields,
                                        'user_relation' =>  $variable->user_relation,
                                        'label_name'    =>  $attribute_column,
                                        'label_type'    =>  $label_type,
                                        'created_by'    =>  $auth_id,
                                        'created_at'    =>  date('Y-m-d H:i:s')            
                                       ];
                        }
    
                        $table_name = str_replace(" ","_",strtolower($template->document_name));
                        $this->createTable($tableName, $fields);
                        $labels = TemplateLabel::insert($label);

                    } else {

                        foreach($input_variables as $key => $variable) {

                            $attribute_column = $variable->fields;
                            $label_type       = strtolower($variable->variable_type);
                        
                            $templateLabels = TemplateLabel::select('id', 'fields', 'table_name')->where(['document_id' => $data['document_id'], 'fields' => $attribute_column])->first();
        
                            if(!$templateLabels) {
    
                                $fieldName = $variable->fields;
                                
                                $newColumns[] = ['name' => $fieldName, 'type' =>$variable->variable_type];
    
                                $newLabels[] = [
                                                    'document_id'   =>  $data['document_id'],
                                                    'table_name'    =>  str_replace(" ","_",strtolower($template->document_name)), // strtolower($template->document_name)
                                                    'fields'        =>  $fieldName,
                                                    'user_relation' =>  $variable->user_relation,
                                                    'label_name'    =>  $variable->variable_name,
                                                    'label_type'    =>  $label_type,
                                                    'created_by'    =>  $auth_id, // \Auth::guard('admin')->user()->id,
                                                    'created_at'    =>  date('Y-m-d H:i:s')           
                                                ];
                            } 
                        }
    
                        if(count($newColumns) > 0)
                            $this->addNewColumns(str_replace(" ","_",strtolower($template->document_name)), $newColumns);
    
                        if(count($newLabels) > 0)
                            TemplateLabel::insert($newLabels);

                    }

                    /* ========================================== */

                }
                $template->document_description = $data['document_description'];
                $template->information_document = $data['information_document'];
                $template->subscription_category =  implode(",", $data['subscription_category']);               
                $template->text_body = html_entity_decode($data['text_body']);
                if (isset($data['document_image'])) {
                    $template->document_image = $data['document_image'];
                }
                $template->price = $data['price'];
                $template->updated_by = $auth_id;
                $template->step1 = 1;
                $template->step2 = 1;
                $template->save();

                $price = PriceMatrix::where('document_id',$data['document_id'])->first();              
                $price->price = $data['price'];
                $price->updated_by = $auth_id;
                $price->save();

                if(!$price) {
                    throw new \Exception('Price Updation Failed');
                }
                DB::commit();

            return $template;
        } catch (Exception $e) {
            logger()->error($e);
            DB::rollback();
            return false;
        }
    }

    public function addNewColumns($tableName, $newColumns = [])
    {
        Schema::table($tableName, function (Blueprint $table) use ($newColumns) {

            if (count($newColumns) > 0) {
                foreach ($newColumns as $field) {
                    if($field['type'] == 'decimal'){

                        $table->{$field['type']}($field['name'],15, 2)->nullable();

                    } else {
                        $table->{$field['type']}($field['name'])->nullable();
                    }
                    // elseif($field['type'] == 'string') {

                    //     $table->{$field['type']}($field['name'])->nullable();

                    // } elseif($field['type'] == 'integer'){

                    //     $table->{$field['type']}($field['name'])->nullable();

                    // } elseif($field['type'] == 'date' || $field['type'] == 'year'){

                    //     $table->{$field['type']}($field['name'])->nullable();

                    // } elseif($field['type'] == 'year'){

                    //     $table->{$field['type']}($field['name'])->nullable();

                    // }
                }
            }
        });
    }

    public function createTable($table_name, $fields = [])
    {
        try {
            Schema::create($table_name, function (Blueprint $table) use ($fields, $table_name) {
                $table->increments('id');
                $table->bigInteger('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
                $table->bigInteger('document_id')->unsigned()->nullable();
                $table->foreign('document_id')->references('id')->on('legal_document_templates')->onDelete('cascade')->onUpdate('no action');
                $table->bigInteger('legalization_id')->unsigned()->nullable();
                $table->foreign('legalization_id')->references('id')->on('legalization_details')->onDelete('cascade')->onUpdate('no action');              
                $table->date('expiry_date')->nullable();
                if (count($fields) > 0) {
                    foreach ($fields as $field) {
                        if($field['type'] == 'decimal'){
                            $table->{$field['type']}($field['name'],15, 2)->nullable();

                        }
                        else{
                            $table->{$field['type']}($field['name'])->nullable();
                        }
                        
                    }
                }
                $table->bigInteger('created_by')->unsigned()->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
                $table->bigInteger('updated_by')->unsigned()->nullable();
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
                $table->timestamps();
            });

            return true;
    
        }
        catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }  

    public function getDocumentType(){
        try {
            $document_types = DocumentType::all();

            return $document_types;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    
    }
    public function getAllTemplates($subscription_category){
        try {
            $templates = LegalDocumentTemplate::with(['category','priceMatrix'])
            ->where('text_body','!=',null)
            ->whereRaw("find_in_set('".$subscription_category."',subscription_category)")
            ->orderBy('category_id')->where(['is_active'=>'1'])->get()->groupBy(function($data) {
                return $data->category->category_name;
            });               
            return $templates;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getAllTemplatesWithOutAuth(){
        try {
            $templates = LegalDocumentTemplate::with(['category','priceMatrix'])
            ->where('text_body','!=',null)
            ->orderBy('category_id')->where(['is_active'=>'1'])->get()->groupBy(function($data) {
                return $data->category->category_name;
            });               
            return $templates;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getTemplateDetail($id){
        try {
            $template = LegalDocumentTemplate::with('category')->find($id);

            return $template;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    
    }
    public function searchDocument($data)
    {      
        try {
            $template = LegalDocumentTemplate::with(['category','priceMatrix'])
            ->orderBy('category_id')
            ->where(['is_active'=>'1'])
            ->where('text_body','!=',null)
            ->where('document_name', 'like', '%' .$data. '%')
            ->get();
            return $template;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
       
   
    }  

    // public function updateTable($table_name, $fields = [])
    // {
    //     try {
    //         if (Schema::hasTable($table_name){
    //             Schema::table($table_name, function (Blueprint $table) {
    //                 if (count($fields) > 0) {
    //                     foreach ($fields as $field) {
    //                         $table->{$field['type']}($field['name'])->nullable();
    //                     }
    //                 }
    //             })
    //         });
    //         return true;
    
    //     }
    //     catch (Exception $e) {

    //         logger()->error($e);
    //         return false;
    //     }
    // }    

    public function removeTable($table_name)
    {
        try {
            Schema::dropIfExists($table_name); 
            
            return true;
        }catch (Exception $e) {

            logger()->error($e);
            return false;
            }
    }

    public function getTemplateLabels($data){
        try {
          
            $template = LegalDocumentTemplate::with('label')->find($data['document_id']);
            return $template;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    
    }

    public function getTemplateData($data){
        try {
            $template = LegalDocumentTemplate::find($data['document_id']);

            return $template;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    
    }
    public function getTemplateDataDetail($id){
        try {
            $template = LegalDocumentTemplate::find($id);

            return $template;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }

    }
public function getLabels($document_id){
    try {
      
        $template = LegalDocumentTemplate::with('label')->find($document_id);
        return $template;
    } catch (Exception $e) {

        logger()->error($e);
        return false;
    }

}
public function documentAll(){
    try {
        $templates =  LegalDocumentTemplate::with('documentType')->where('template_type','=',['1','2','3'])->orderBy('id', 'DESC')->get();
        return $templates;
    } catch (Exception $e) {
        logger()->error($e);
        return false;
    }
}
  
public function templateTableName($table){
    try {  
        $tables = DB::select('SHOW TABLES');
                
        $tables = array_map('current',$tables);

        $template_table = false;

        if(in_array($table ,$tables))
        {    
            $template_table = true;    
        }

        if($template_table){
            
            return true;
            
        } else {

            return false;

        }

    } catch (Exception $e) {
        logger()->error($e);
        return false;
    }
}
public function getTermsAndCondition(){
        try {

            $conditions = TermsAndCondition::first();
            return $conditions;

        }
    catch (Exception $e) {
        return false;

    }
}
public function getDocumentRequired($document_id){
    try {

        $documents = LegalDocumentTemplate::where('id',$document_id)->select('document_required')->get();
        return $documents;

    }
catch (Exception $e) {
    return false;

}
 }


}