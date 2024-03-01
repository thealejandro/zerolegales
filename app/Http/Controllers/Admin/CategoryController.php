<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepo;


    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepo->all();
        return view('admin.category.index')->with(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',

        ]);
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $category = $this->categoryRepo->saveCategory($data,$auth_id);
        if ($category == true) {

            return redirect('/category')->with('success',  __('test.success-category-store'));
        }
        if ($category == false) {

            return redirect('/category')->with('error', __('test.error-msg'));
        }
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
        $category = $this->categoryRepo->getCategory($id);
        return view('admin.category.edit')->with(['category'=>$category,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $category = $this->categoryRepo->updateCategory($data,$id,$auth_id);


        if ($category == true) {


            return redirect('/category')->with('success',  __('test.success-category-update'));
        }
        if ($category == false) {

            return redirect('/category')->with('error', __('test.error-msg'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $data = $request->all();
        $auth_id = \Auth::guard('admin')->user()->id;
        $category = $this->categoryRepo->deleteCategory($data,$auth_id);

        if ($category == true) {

            $json_data = array("status" => "success", "message" => __('test.success-category-delete'));
        }
        if ($category == false) {

            $json_data = array("status" => "error", "message" =>  __('test.error-msg'));
        }
        return response()->json($json_data);
    }
}
