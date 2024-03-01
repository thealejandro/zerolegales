<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\LawyersDirectoryRepository;
use Validator;

class LawyersDirectoryController extends Controller
{
    private $directoryRepo;


    public function __construct(LawyersDirectoryRepository $directoryRepo)
    {
        $this->directoryRepo = $directoryRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directories = $this->directoryRepo->all();
        return view('admin.lawyers_directory.index')->with(['directories' => $directories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lawyers_directory.create');

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
            'lawyer_name'           =>      'required',
            'lawyer_address'        =>      'required',
            'zone'                  =>      'required',
            'department'            =>      'required',
            'township'              =>      'required',
            'email'                 =>      'required|email|unique:lawyers_directories',
            'phone'                 =>      'required|min:8|regex:/^([0-9\s\-\+\(\)]*)$/',
            

        ]);
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $directory = $this->directoryRepo->saveDirectory($data,$auth_id);


        if ($directory == true) {


            return redirect('/lawyers-directory')->with('success',  __('test.success-directory-store'));
        }
        if ($directory == false) {

            return redirect('/lawyers-directory')->with('error', __('test.error-msg'));
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
        $directory = $this->directoryRepo->getDirectory($id);
        return view('admin.lawyers_directory.edit')->with(['directory'=>$directory,'id'=>$id]);
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
            'lawyer_name'           =>      'required',
            'lawyer_address'        =>      'required',
            'zone'                  =>      'required',
            'department'            =>      'required',
            'township'              =>      'required',
            'email'                 =>      'required|email|unique:lawyers_directories,email,' .$id,
            'phone'                 =>      'required|min:8|regex:/^([0-9\s\-\+\(\)]*)$/',
            

        ]);
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $directory = $this->directoryRepo->updateDirectory($data,$id,$auth_id);


        if ($directory == true) {


            return redirect('/lawyers-directory')->with('success',  __('test.success-directory-update'));
        }
        if ($directory == false) {

            return redirect('/lawyers-directory')->with('error', __('test.error-msg'));
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
        $directory = $this->directoryRepo->deleteDirectory($data);

        if ($directory == true) {

            $json_data = array("status" => "success", "message" => __('test.success-directory-delete'));
        }
        if ($directory == false) {

            $json_data = array("status" => "error", "message" =>  __('test.error-msg'));
        }
        return response()->json($json_data);
    }
    public function changeStatus(Request $request)
    {
        $data =$request->all();
        $status = $this->directoryRepo->statusChange($data);
        if ($status == true) {
            if ($request->status == "1") {
                $json_data = array("status" => "success", 'message' => __('test.success-directory-status_1'));
            }
            if ($request->status == "0") {
                $json_data = array("status" => "success", 'message' => __('test.success-directory-status_0'));
            }
        }
        if ($status == false) {

            $json_data = array("status" => "error", 'message' => __('test.error-status'));
        }
        return response()->json($json_data);
    }
    public function assignPrice(Request $request)
    {
       
        $directory_id = $request->id;
        $directory = $this->directoryRepo->getDirectoryPrice($directory_id);
        return response()->json($directory);

    }
    public function updatePrice(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'price'=>'required',
            ]
        );
        if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => __('test.please-fill'),
                    'errors' => $validator->errors()
                ], 401);
        }
        $data =$request->all();
        $price = $this->directoryRepo->updateDirectoryPrice($data);
        if ($price == true) {

            $json_data = array("status" => "success", "message" => __('test.success-price-store'));

        }
        if ($price == false) {

            $json_data = array("status" => "error", 'message' => __('test.error-msg'));
        }
        return response()->json($json_data);
    }
}
