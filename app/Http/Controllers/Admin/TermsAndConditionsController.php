<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\TermsAndConditionsRepository;

class TermsAndConditionsController extends Controller
{
    private $conditionRepo;


    public function __construct(TermsAndConditionsRepository $conditionRepo)
    {
        $this->conditionRepo = $conditionRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = $this->conditionRepo->all();
        return view('admin.terms_conditions.index')->with(['terms' => $terms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $condition = $this->conditionRepo->getCondition($id);
        return view('admin.terms_conditions.edit')->with(['condition'=>$condition,'id'=>$id]);
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
                'condition_text'           =>      'required',
    
            ]);
            $data = $request->all();
            $auth_id =\Auth::guard('admin')->user()->id;
            $condition = $this->conditionRepo->updateCondition($data,$id,$auth_id);
    
            if ($condition == true) {
    
                return redirect('/terms-conditions')->with('success',  __('test.success-terms-conditions-update'));
            }
            if ($condition == false) {
    
                return redirect('/terms-conditions')->with('error', __('test.error-msg'));
            }
        
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
}
