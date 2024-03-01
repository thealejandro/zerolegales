<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repository\AdminRepository;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo=$adminRepo;
        $this->middleware('auth:admin');
    }
 
    /*
     * After logging as client the dashboard for client
     * @return \Illuminate\Contracts\Support\Referable
     * */
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function manageUserReport(){
        return view ('admin.report.manage-user-report');
    }

    public function getUserReportList(Request $request){
        $data['search']  = $request->search['value'];
        $data['sort']     = $request->order;
        $data['column']   = $data['sort'][0]['column'];
        $data['order']   = $data['sort'][0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $listUsers = $this->adminRepo->listUsers($data);

        $result['data']= $listUsers['userData']->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $listUsers['total'];
        $result['recordsFiltered'] =  $listUsers['total'];
        echo json_encode($result);
    }


    public function filterUser(Request $request) 
    {
        $data = [
            'from' => $request->from,
            'to' => $request->to,
        ];
        dd($data);
        $listPayment = $this->adminmasterRepo->filterPayment($data);
        foreach($listPayment as $value) {

            if($value['user']['role'] != 1) {
                $value['address'] ='NA';
            } else {
                $value['address'] = $value['students']['address'];
            }
            $discount = $this->adminmasterRepo->getDiscount($value['coupon_code']);
            if($discount) {
                $saved_amount = ($value['total_amount'] * $discount['discountvalue']) / 100;
                $value['total_amount'] = $value['total_amount'] - $saved_amount;
                $coupon = $this->adminmasterRepo->getCouponCodeDetail($value['coupon_code']);
                $value['coupon_code'] = $coupon['couponcode'];
            } else {
                $value['coupon_code'] = 'NA';
            }
            if($value['currency'] == 'INR') {
                $value['cgst'] = ($value['total_amount'] * 9) / 100;
                $value['sgst'] = ($value['total_amount'] * 9) / 100;
                $value['fs'] = ($value['total_amount'] * 1) / 100;
                $value['taxable_value'] =$value['total_amount'] - $value['cgst'] - $value['sgst'] - $value['fs'];

            } else if($value['currency'] == 'USD'){
                $value['cgst'] = 'NA';
                $value['sgst'] = 'NA';
                $value['fs'] = 'NA';
                $value['taxable_value'] =$value['total_amount'];
            } else {
                $value['cgst'] = 'NA';
                $value['sgst'] = 'NA';
                $value['fs'] = 'NA';
                $value['taxable_value'] ='NA';
            }
           

            
         if($value['is_payed'] == 1) {
            $value['is_payed'] = "PayuMoney";
         } else if($value['is_payed'] == 2) {
            $value['is_payed'] = "Paypal";
         } else if($value['is_payed'] == 3) {
            $value['is_payed'] = "SBI";
         } else if($value['is_payed'] == 4) {
            $value['is_payed'] = "Gpay";
         }else {
            $value['is_payed'] = "Undefined";
         }
        }
        // foreach($listPayment as $value) {
        //     dd($value['students']);
        // }
        // dd($listPayment);
        // echo json_encode($listPayment);
        return response()->Json(['status' => true ,'payment' => $listPayment, 'message' => 'Payment filter data']);

    }

    public function manageSubscriptionReport(){
        return view ('admin.report.manage-subscription-report');
    }

    public function getSubscriptionReportList(Request $request){
        // dd('mnc');
        $data['search']  = $request->search['value'];
        $data['sort']     = $request->order;
        $data['column']   = $data['sort'][0]['column'];
        $data['order']   = $data['sort'][0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $listSubscription = $this->adminRepo->listSubscription($data);

        $result['data']= $listSubscription['subscriptionData']->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $listSubscription['total'];
        $result['recordsFiltered'] =  $listSubscription['total'];
        // dd($result);
        echo json_encode($result);
    }
}
