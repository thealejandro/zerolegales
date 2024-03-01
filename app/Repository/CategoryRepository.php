<?php

namespace App\Repository;


use App\Category;
use Exception;

class CategoryRepository
{

    public function all(){
        try {

            $categories =  Category::orderBy('id', 'DESC')->get();
            return $categories;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function saveCategory($data,$auth_id){
        try {
            $category = new Category();
            $category->category_name = $data['category_name'];
            $category->created_by = $auth_id;
            $category->save();

            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function getCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            return $category;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function updateCategory($data, $id,$auth_id)
    {
        try {

            $categoryUpdate =Category::findOrFail($id);
            $categoryUpdate->category_name = $data['category_name'];
            $categoryUpdate->updated_by = $auth_id;
            $categoryUpdate->save();

            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
    public function deleteCategory($data,$auth_id)
    {
        try {
            $category =  Category::findOrFail($data['id']);
            $category->deleted_by = $auth_id;
            $category->save();
            $category->delete();
            return true;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }

}