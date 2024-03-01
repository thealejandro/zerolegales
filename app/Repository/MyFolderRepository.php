<?php

namespace App\Repository;


use App\MyFolder;
use App\LegalDocumentTemplate;
use Exception;


class MyFolderRepository
{
    public function all($auth_id){
        try {
            $folders = MyFolder::leftJoin('legal_document_templates','my_folders.document_id','=','legal_document_templates.id')
            ->leftJoin('categories','categories.id','=','legal_document_templates.category_id')
            ->select('legal_document_templates.category_id','legal_document_templates.document_image','categories.category_name','my_folders.document_name','my_folders.document_description',
            'my_folders.id')
            ->where('my_folders.user_id',$auth_id)
            ->orderBy('category_id')->get()->groupBy(function($data) {
                return $data->category_name;
            });
            return $folders;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function saveMyFolder($data,$file,$auth_id){

        try {
            $folder = new MyFolder();
            $folder->user_id = $auth_id;
            $folder->document_id = $data['document_id'];
            $folder->document_template_id = $data['id'];
            $folder->document_name = $data['document_name'];
            $folder->document_description =$data['document_description'];
            $folder->document_file = $file;
            $folder->created_by = $auth_id;
            $folder->save();

            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function documentInfo($folder_id){
        try {
            $folders = MyFolder::leftJoin('legal_document_templates','my_folders.document_id','=','legal_document_templates.id')
            ->where('my_folders.id','=',$folder_id)
            ->select('legal_document_templates.text_body','legal_document_templates.document_authentication','my_folders.*')
            ->first();
            return $folders;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function searchFolder($data)
    {
       
        try {
            $folder = MyFolder::leftJoin('legal_document_templates','my_folders.document_id','=','legal_document_templates.id')
            ->leftJoin('categories','categories.id','=','legal_document_templates.category_id')            
            ->select('legal_document_templates.template_type','legal_document_templates.document_image','categories.category_name','my_folders.document_name','my_folders.document_description',
            'my_folders.document_id','my_folders.document_template_id')
            ->where('my_folders.document_name', 'like', '%' .$data. '%')
            ->get();
            return $folder;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
       
   
    }
}