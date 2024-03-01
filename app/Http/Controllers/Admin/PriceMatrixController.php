<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\PriceMatrixRepository;

class PriceMatrixController extends Controller
{
    private $priceRepo;


    public function __construct(PriceMatrixRepository $priceRepo)
    {
        $this->priceRepo = $priceRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = $this->priceRepo->all();
        return view('admin.price_matrix.index')->with(['prices' => $prices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscriptions = $this->priceRepo->getSubscriptionTypes();
        $documents = $this->priceRepo->getDocuments();
        return view('admin.price_matrix.create')->with(['subscriptions' => $subscriptions,'documents'=>$documents]);   
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
            'subscription_id' => 'required',
            'payment_type' =>'required',
            'price' => 'required',

        ]);
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        if(isset($data['subscription_id'])&& isset($data['payment_type'])){
            $payment_type = $this->priceRepo->getPriceSubscription($data['payment_type'],$data['subscription_id']);
            if( $payment_type == null){
                $price = $this->priceRepo->savePrice($data,$auth_id);
            }
            else{
                return redirect('price-matrix')->with('error', __('test.payment-type-price-already-added'));
            }
        }

        if ($price == true) {

            return redirect('price-matrix')->with('success',  __('test.success-price-matrix-store'));
        }
        if ($price == false) {

            return redirect('price-matrix')->with('error', __('test.error-msg'));
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
        $subscriptions = $this->priceRepo->getSubscriptionTypes();
        $documents = $this->priceRepo->getDocuments();
        $price = $this->priceRepo->getPriceMatrix($id);
        return view('admin.price_matrix.edit')->with(['price'=>$price,'subscriptions' => $subscriptions,'documents'=>$documents,'id'=>$id]);   
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
            'subscription_id' => 'required',
            'payment_type' =>'required',
            'price' => 'required',

        ]);
        $data = $request->all();
        $auth_id =\Auth::guard('admin')->user()->id;
        $price = $this->priceRepo->updatePrice($data,$auth_id);
        if ($price == true) {

            return redirect('price-matrix')->with('success',  __('test.success-price-matrix-update'));
        }
        if ($price == false) {

            return redirect('price-matrix')->with('error', __('test.error-msg'));
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
        $price = $this->priceRepo->deletePriceMatrix($data);

        if ($price == true) {

            $json_data = array("status" => "success", "message" => __('test.success-price-matrix-delete'));
        }
        if ($price == false) {

            $json_data = array("status" => "error", "message" =>  __('test.error-msg'));
        }
        return response()->json($json_data);
    }
}
