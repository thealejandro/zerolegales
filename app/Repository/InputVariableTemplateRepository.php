<?php

namespace App\Repository;

use App\InputVariableTemplate;
use Exception;
use App\InputVariable;
use App\LegalDocumentTemplate;
use App\TemplateLabel;
use App\InputVariableType;
use App\Repository\LegalDocumentTemplateRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class InputVariableTemplateRepository
{
    public function all($document_id){
        try {
                $input_variables = InputVariableTemplate::leftJoin('input_variables','input_variables.id','=','input_variable_templates.variable_id')
                            ->leftJoin('input_variable_types','input_variable_types.id','=','input_variables.variable_type')
                             ->select('input_variable_templates.variable_id','input_variables.variable_name','input_variables.user_relation','input_variable_types.variable_type','input_variable_types.id as variable_type_id','input_variable_templates.id','input_variable_templates.fields','input_variables.user_relation')
                             ->where(['input_variable_templates.document_id'=>$document_id])
                              ->orderBy('input_variable_templates.id')
                             ->get();
                return $input_variables;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
        
    }

    public function saveInputVariable($data,$auth_id)
    {
        try {
            $inputs =  InputVariableTemplate::orderby('id','DESC')->where('document_id','=',$data['document_id'])->first();   
            $variable = new InputVariableTemplate();

            if($inputs == null) {

                $variable->document_id = $data['document_id'];
                $variable->variable_id = $data['variable_id'];
                $variable->fields = 'field_0';
                $variable->created_by = $auth_id;
    
            } else {
                
                // $temp =explode('_',$inputs['fields']);
                // $number = $temp[1]+1;
                $templateLabelCount = InputVariableTemplate::where(['document_id' => $data['document_id']])->get();
                for($i=0; $i<=count($templateLabelCount); $i++) {
                                
                    $fieldExist = InputVariableTemplate::where(['document_id' => $data['document_id'], 'fields' => 'field_'.$i])->exists();
                                
                    if($fieldExist) {
                        continue;
                    }

                    $number = 'field_'.$i;
                    break;
                }

                $variable->document_id  = $data['document_id'];
                $variable->variable_id  = $data['variable_id'];
                $variable->fields       = $number;
                $variable->created_by   = $auth_id;
            }

            $legalDocumentTemplate = LegalDocumentTemplate::find($data['document_id']);
            $legalDocumentTemplate->step2 = 1;
            $legalDocumentTemplate->save();
               
            $variable->save();

            return $variable;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    // public function getInputvariable($id){
    //     try {
    //         $input_variables = InputVariableTemplate::find($id);  
    //         return $input_variables;
    //     } catch (Exception $e) {

    //         logger()->error($e);
    //         return false;
    //     }
    // }

    public function getInputvariable($id){
        try {
            $inputVariableTemplate = InputVariableTemplate::find($id); 

            $documentVariables = InputVariableTemplate::where('document_id', '=', $inputVariableTemplate->document_id)
                                                        ->pluck('variable_id')
                                                        ->toArray();

            $inputVariables = InputVariable::leftjoin('input_variable_types', 'input_variable_types.id', 'input_variables.variable_type')
                                            ->select('input_variables.*', 'input_variable_types.variable_type as variable_type_name')
                                            ->get();

            return ['inputVariables' => $inputVariables, 'documentVariables' => $documentVariables];

        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    // public function updateInputvariable($data,$auth_id)
    // {
    //     try {
    //         $input_variables = InputVariableTemplate::find($data['id']);  

    //         $inputs =  InputVariableTemplate::orderby('id','DESC')->where('document_id','=',$input_variables->document_id)->first();   
 
    //         if($inputs == null){

    //             $input_variables->variable_id = $data['variable_id'];
    //             $input_variables->fields = 'field_0';
    //             $input_variables->updated_by = $auth_id;
    //             $input_variables->save();
    //         }

    //             $input_variables->variable_id = $data['variable_id'];
    //             $input_variables->updated_by = $auth_id;
    //             $input_variables->save();

    //         return $input_variables;
    //     } catch (Exception $e) {

    //         logger()->error($e);
    //         return false;
    //     }
    // }

    public function updateInputvariable($data,$auth_id)
    {
        try {

            $input_variables = InputVariableTemplate::find($data['edit_variable_template_id']); 
            
            $varaiableExist = InputVariableTemplate::where(['document_id' => $input_variables->document_id, 'variable_id' => $data['variable_id2']])->exists();

            if($varaiableExist) {

                return 'exists';

            }

            $oldVariable = $input_variables->variable_id;

            $input_variables->variable_id = $data['variable_id2'];
            $input_variables->updated_by = $auth_id;
            $input_variables->save();

            $legalDocumentTemplate = LegalDocumentTemplate::find($input_variables->document_id);
            $tableName = str_replace(" ","_",strtolower($legalDocumentTemplate->document_name));

            $templateLabel = TemplateLabel::where(['table_name' => $tableName, 'document_id' => $input_variables->document_id, 'fields' => $input_variables->fields])->first();
            
            if($templateLabel) {
                
                $inputVariable = InputVariable::find($data['variable_id2']);
                $templateLabel->label_name = $inputVariable->variable_name;
                $templateLabel->updated_by = $auth_id;
                // $templateLabel->updated_at =
                $inputVariableType = InputVariableType::find($inputVariable->variable_type);
                $templateLabel->label_type = $inputVariableType->variable_type;
                $templateLabel->user_relation = $inputVariable->user_relation;
                $templateLabel->save();
                
                if($oldVariable != $input_variables->variable_id) {

                    $legalDocumentTemplateRepository = new LegalDocumentTemplateRepository();

                    $template_table  = $legalDocumentTemplateRepository->templateTableName($tableName);

                    if($template_table) {

                        $this->alterTable($tableName, $templateLabel->fields, $templateLabel->label_type);
                        
                    }
                }

            }

            return $input_variables;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }

    public function alterTable($tableName, $alteringColumn, $newDataType)
    {
        if(Schema::hasColumn($tableName, $alteringColumn)) {

            Schema::table($tableName, function (Blueprint $table) use ($alteringColumn, $newDataType) {

                // $table->{$newDataType}($alteringColumn)->change();

                if($newDataType == 'decimal'){

                    $table->{$newDataType}($alteringColumn,15, 2)->change()->nullable();

                } else {
                    // $table->{$field['type']}($field['name'])->nullable();
                    $table->{$newDataType}($alteringColumn)->change()->nullable();
                }

            });

        }
    }

    // public function updateInputvariable($data,$auth_id)
    // {
    //     try {
    //         $input_variables = InputVariableTemplate::find($data['edit_variable_template_id']);  

    //         $inputVariable = InputVariable::find($data['edit_variable_id']);
    //         $oldvariableName = $inputVariable->variable_name;
    //         $oldvaribleType = $inputVariable->variable_type;
    //         $inputVariable->variable_name = $data['edit_variable_name'];
    //         $inputVariable->variable_type = $data['edit_variable_type'];
    //         $inputVariable->updated_by    = $auth_id;
    //         $inputVariable->save();

    //         if($oldvariableName != $inputVariable->variable_name) {

    //             $legalTemplate = LegalDocumentTemplate::find($input_variables->document_id);

    //             if($legalTemplate) {

    //                 $htmlString = $legalTemplate->text_body;

    //                 $newTextBody = str_replace($oldvariableName, $inputVariable->variable_name, $htmlString);
    //                 $legalTemplate->text_body = $newTextBody;
    //                 $legalTemplate->save();

    //             }

    //         }

    //         $inputVariableType = InputVariableType::find($oldvaribleType);

    //         $templateLabel = TemplateLabel::where(['document_id' => $input_variables->document_id, 'fields' => $input_variables->fields, 'label_type' => $inputVariableType->variable_type])->first();
            
    //         if($templateLabel) {

    //             $templateLabelOldDataType = $templateLabel->label_type;
            
    //             $templateLabel->label_name = $inputVariable->variable_name;
    //             $newVariableType = InputVariableType::find($inputVariable->variable_type);
    //             $templateLabel->label_type = $newVariableType->variable_type;
    //             $templateLabel->save();

    //             if($templateLabelOldDataType != $newVariableType->variable_type) {

    //                 $legalDocumentTemplate = LegalDocumentTemplate::find($input_variables->document_id);

    //                 if($legalDocumentTemplate) {

    //                     $legalDocumentTemplateRepository = new LegalDocumentTemplateRepository();

    //                     $template_table  = $this->legalDocumentTemplateRepository->templateTableName($tableName);

    //                     if($template_table) {

    //                         $this->alterTable(str_replace(" ","_",strtolower($legalDocumentTemplate->document_name)), $input_variables->fields, $templateLabel->label_type);
                        
    //                     }
    //                 }

    //             }
    //         }

    //         return $input_variables;

    //     } catch (Exception $e) {

    //         logger()->error($e);
    //         return false;
    //     }
    // }

    

    // public function deleteInputVariable($data)
    // {
    //     try {
    //         $variable =  InputVariableTemplate::findOrFail($data['id']);
    //         $variable->delete();
    //         return true;
    //     } catch (Exception $e) {

    //         logger()->error($e);
    //         return false;
    //     }
    // }

    public function deleteInputVariable($data)
    {
        try {
            $variable =  InputVariableTemplate::findOrFail($data['id']);
            $inputVariableId    = $variable->variable_id;
            $fieldName          = $variable->fields;
            $variable->delete();

            $inputVariable = InputVariable::findOrFail($inputVariableId);

            /****************************************** */
            $legalDocumentTemplate = LegalDocumentTemplate::find($data['document_id']);
    
            if($legalDocumentTemplate) {

                $tableName = str_replace(" ","_",strtolower($legalDocumentTemplate->document_name));

                $legalDocumentTemplateRepository = new LegalDocumentTemplateRepository();

                $template_table  = $legalDocumentTemplateRepository->templateTableName($tableName);
    
                if($template_table == true) {
    
                    $totalRecordscount = \DB::select('select * from '.$tableName.' where document_id = ?', [$data['document_id']]);
                    
                    if(Schema::hasColumn($tableName, $fieldName)) {
                        
                        $field = \DB::table($tableName)
                                        ->where([
                                            ['document_id',$data['document_id']],
                                            [$fieldName , null], // [$templateLabel->fields , null OR ''],
                                            ]
                                        )
                                        ->get();
        
                        if(count($totalRecordscount) == count($field)) {
        
                            Schema::table($tableName, function (Blueprint $table) use($fieldName){

                                $table->dropColumn($fieldName);
                    
                            });

                        }

                        $templateLabel = TemplateLabel::where(['document_id' => $data['document_id'], 'fields' => $fieldName])->first();

                        if($templateLabel) {

                            $templateLabel->delete();
                            
                        }

                    }
                }
            }
            /****************************************** */

            // if($inputVariable->user_relation != 1) {
            //     $inputVariable->deleted_by = \Auth::guard('admin')->user()->id;
            //     $inputVariable->save();
            //     $inputVariable->delete();
            // }

            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }

}
