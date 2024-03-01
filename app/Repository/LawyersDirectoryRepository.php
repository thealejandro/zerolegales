<?php

namespace App\Repository;


use App\LawyersDirectory;
use Exception;


class LawyersDirectoryRepository
{

    public function all(){
        try {
            $directories =  LawyersDirectory::orderBy('id', 'DESC')->get();
            return $directories;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function saveDirectory($data,$auth_id){
        try {
            $directory = new LawyersDirectory();
            $directory->lawyer_name = $data['lawyer_name'];
            $directory->lawyer_address = $data['lawyer_address'];
            $directory->email = $data['email'];
            $directory->phone = $data['phone'];
            $directory->zone = $data['zone'];
            $directory->township = $data['township'];
            $directory->department = $data['department'];
            $directory->created_by = $auth_id;
            $directory->save();

            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function getDirectory($id)
    {
        try {
            $directory = LawyersDirectory::find($id);
            return $directory;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function updateDirectory($data, $id,$auth_id)
    {
        try {

            $directoryUpdate =LawyersDirectory::find($id);
            $directoryUpdate->lawyer_name = $data['lawyer_name'];
            $directoryUpdate->lawyer_address = $data['lawyer_address'];
            $directoryUpdate->email = $data['email'];
            $directoryUpdate->phone = $data['phone'];
            $directoryUpdate->zone = $data['zone'];
            $directoryUpdate->township = $data['township'];
            $directoryUpdate->department = $data['department'];
            $directoryUpdate->updated_by = $auth_id;
            $directoryUpdate->save();

            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function statusChange($data)
    {
        try {
            $directoryStatus = LawyersDirectory::find($data['id']);
            $directoryStatus->is_active = $data['status'];
            $directoryStatus->save();
            return true;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function deleteDirectory($data)
    {
        try {
            $directory =  LawyersDirectory::findOrFail($data['id']);
            $directory->deleted_by =$data['auth_id'];
            $directory->save();
            $directory->delete();
            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function getDirectoryPrice($directory_id){
        try {
            $directory = LawyersDirectory::select('id','price')->where(['id'=>$directory_id])->first();
            return $directory;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
     
    }
    public function updateDirectoryPrice($data){
        try {
            $directoryPrice =  LawyersDirectory::find($data['id']);
            $directoryPrice->price = $data['price'];
            $directoryPrice->save();
            return true;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function directoryDepartment(){
        try {
            $directories =  LawyersDirectory::select('department')->distinct()->where('is_active','=',1)->get();
            return $directories;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function directoryAll($data){
        try {
            $directories = LawyersDirectory::where(['department'=>$data['department']])->get();
            return $directories;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
}