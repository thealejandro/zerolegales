<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\InputVariableRepository;

class InputVariableController extends Controller
{
    private $variableRepo;


    public function __construct(InputVariableRepository $variableRepo)
    {
        $this->variableRepo = $variableRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variables = $this->variableRepo->all();
        return view('admin.input_variable.index')->with(['variables' => $variables]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = $this->variableRepo->allInputVariableTypes();
        return view('admin.input_variable.create')->with(['types' => $types]);
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
            'variable_name' => 'required',
            'variable_type' => 'required',
            'document_id'   => 'required'
        ]);
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $variable = $this->variableRepo->saveInputVariable($data,$auth_id);
        if ($variable == true) {

            // return redirect('/input-variable')->with('success',  __('test.success-variable-store'));
            return response()->json(['status' => true, 'message' => __('test.success-variable-store')]);
        }
        if ($variable == false) {

            // return redirect('/input-variable')->with('error', __('test.error-msg'));
            return response()->json(['status' => false, 'message' => __('test.error-msg')]);
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
        $types = $this->variableRepo->allInputVariableTypes();
        $variable = $this->variableRepo->getInputVariable($id);
        return view('admin.input_variable.edit')->with(['variable'=>$variable,'id'=>$id,'types'=>$types]);
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
            'variable_name' => 'required',
            'variable_type' => 'required',        
        ]);
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $variable = $this->variableRepo->updateInputVariable($data,$id,$auth_id);


        if ($variable == true) {


            return redirect('/input-variable')->with('success',  __('test.success-variable-update'));
        }
        if ($variable == false) {

            return redirect('/input-variable')->with('error', __('test.error-msg'));
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
        $variable = $this->variableRepo->deleteInputVariable($data);

        if ($variable == true) {

            $json_data = array("status" => "success", "message" => __('test.success-variable-delete'));
        }
        if ($variable == false) {

            $json_data = array("status" => "error", "message" =>  __('test.error-msg'));
        }
        return response()->json($json_data);
    }

}
