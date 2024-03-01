<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repository\ProfileRepository;
use App\Repository\MailRepository;
use App\Repository\UserRepository;
// use IlluminateSupportFacadesHash;
use JustGeeky\LaravelCybersource\Facades\Cybersource as Cybersource;
use Illuminate\Support\Facades\Http;

// use App\Helpers\SiteHelper;
use Storage;

class ProfileController extends Controller
{
    private $profileRepo;


    public function __construct(ProfileRepository $profileRepo,UserRepository $userRepo,MailRepository $mailRepo)
    {
        $this->profileRepo=$profileRepo;
        $this->user =  \Auth::guard('web');
        $this->userRepo = $userRepo;
        $this->mailRepo = $mailRepo;
    }

    /**
     * get profile data
     */
    public function getProfile()
    { 
        $user_id = $this->user->user()->id;
        $user_data = $this->profileRepo->getUserData($user_id);
        if($user_data['date_of_birth'])
            $user_data['date_of_birth'] = date('m/d/Y' , strtotime($user_data['date_of_birth']));
        $subscription = $this->profileRepo->getSubscriptionData();
        return view('front.user.profile',compact('user_data','subscription'));
    
    }
    public function changeProfileImage(Request $request)
    { 
        $validatedData = \Validator::make($request->all(), [
            'profileimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['status' => false, 'message' => $validatedData->messages(), 'error' => 0]);
        }

        if ($request->file('profileimg') != null) {
            $filename = $request->file('profileimg')->store('user',['disk' => 'public']);
            $update = $this->profileRepo->updateProfilePic($filename);

            if (!$update)
                return response()->Json(['status' => false, 'message' => 'Sorry! Technical error']);
            return response()->json(['status' => true, 'message' => 'Image Uploaded successfully']);
        }
        return response()->Json(['status' => false, 'message' => 'Sorry! Technical error']);
    
    }

    public function currentPasswordCheck($data)
    {
        if(Hash::check($data, Auth::user()->password)) {
            return response()->json(['status' => true, 'message' => 'Matched']);
        } else {
            return response()->json(['status' => false, 'message' => "Invalid", 'error' => 0]);
        }
    }

    public function saveAccountData(Request $request)
    {
        $rule = [
            'name'  =>  'required|regex:/^[a-zA-Z ]+$/',
            'email' =>  'required|email',
        ];
        $data = [
            'first_name' => $request->post('name'),
            'email'  =>  $request->post('email')
        ];
        // if($request->current_password != null) {
            if(Hash::check($request->get('current_password'), Auth::user()->password)) {
            $id = $this->user->user()->id;
            $pword = $request->post('current_password');
            // if (Auth::guard('web')->attempt(['id' => $id, 'password' => $pword])) {
                $rule = [
                    // 'current_password' =>'required|min:6',
                    'new_password' =>'required|min:8|required_with:confirm_password|same:confirm_password',
                ];
                $data['password']  =  bcrypt($request->post('new_password'));
            // } else {
            //     return response()->json(['status' => false, 'message' => "Invalid Password", 'error' => 0]);
            // }
        } else {
            return response()->json(['status' => false, 'message' => "!Contraseña invalida", 'error' => 0]);
        }
        $validatedData = \Validator::make($request->all(),$rule);
        if ($validatedData->fails()) {
            return response()->json(['status' => false, 'message' => $validatedData->messages(), 'error' => 0]);
        }
      
        $update = $this->profileRepo->updateAccountInfo($data);
        if(!$update){
            return response()->Json(['status' => false, 'message' => 'Technical error!', 'error' => 1]);
        }
        return response()->json(['status' => true, 'message' => '¡Éxito! Contraseña actualizada exitosamente']);
    }

    public function savePersonalData(Request $request)
    {
        $rule = [
            'first_name'  =>  'required|regex:/^[a-zA-Z ]+$/',
            'surname'  =>  'required|regex:/^[a-zA-Z ]+$/',
            //'dpi_number'  =>  'required',
            'dob'  =>  'required',
            'passport_file'  =>  'mimetypes:application/pdf|max:10000',
            'rtu'  =>  'mimetypes:application/pdf|max:10000',
            'appointment'  =>  'mimetypes:application/pdf|max:10000',
            'company_trade_patent'  =>  'mimetypes:application/pdf|max:10000',
            'society_trade_patent'  =>  'mimetypes:application/pdf|max:10000',
        ];

        if($request->post('dpi_file_already')) {
            $rule['dpi_file']  =  'mimetypes:application/pdf|max:10000';
        } else {
                $rule['dpi_file']  =  'mimetypes:application/pdf|max:10000';
        }

        $validatedData = \Validator::make($request->all(),$rule);
        if ($validatedData->fails()) {
            return response()->json(['status' => false, 'message' => $validatedData->messages(), 'error' => 0]);
        }
        
        $data = [
            'first_name' => $request->post('first_name'),
            'second_name' => $request->post('second_name'),
            'surname' => $request->post('surname'),
            'second_surname' => $request->post('second_surname'),
            'married_surname' => $request->post('married_surname'),
            'dpi_number' => $request->post('dpi_number'),
            'date_of_birth'  =>  date('Y-m-d H:i:s' , strtotime($request->post('dob'))),
            'nationality'  =>  $request->post('nationality'),
            'passport_number'  =>  $request->post('passport_number'),
            'profession'  =>  $request->post('profession'),
            'direction'  =>  $request->post('direction'),
        ];
        if(!empty($request->post('dob'))){
            $year = date('Y' , strtotime($request->post('dob')));
            $today = date('Y');
            $age = $today - $year;
            $data['age'] = $age;
        }
        if($request->dpi_file){
            
            $filename = $request->file('dpi_file')->store('personal_info',['disk' => 'public']);
            $data['dpi_file'] = $filename;
            $data['dpi_file_name'] = $request->dpi_file->getClientOriginalName();
        }
        if($request->passport_file){
            $filename = $request->file('passport_file')->store('personal_info',['disk' => 'public']);
            $data['passport_file'] = $filename;
            $data['passport_file_name'] = $request->passport_file->getClientOriginalName();
        }
        if($request->rtu){
            $filename = $request->file('rtu')->store('personal_info',['disk' => 'public']);
            $data['rtu'] = $filename;
            $data['rtu_file_name'] = $request->rtu->getClientOriginalName();
        }
        if($request->appointment){
            $filename = $request->file('appointment')->store('personal_info',['disk' => 'public']);
            $data['appointment'] = $filename;
            $data['appointment_file_name'] = $request->appointment->getClientOriginalName();
        }
        if($request->company_trade_patent){
            $filename = $request->file('company_trade_patent')->store('personal_info',['disk' => 'public']);
            $data['company_trade_patent'] = $filename;
            $data['company_trade_patent_file_name'] = $request->company_trade_patent->getClientOriginalName();
        }
        if($request->society_trade_patent){
            $filename = $request->file('society_trade_patent')->store('personal_info',['disk' => 'public']);
            $data['society_trade_patent'] = $filename;
            $data['society_trade_patent_file_name'] = $request->society_trade_patent->getClientOriginalName();
        }
        $update = $this->profileRepo->updatePersonalInfo($data);
        if(!$update){
            return response()->Json(['status' => false, 'message' => 'Technical error!', 'error' => 1]);
        }
        return response()->json(['status' => true, 'message' => 'Success! Personal Details Updated']);
      
    }

    public function removePdf($id)
    {
        if($id == 1){
            $data['rtu'] = NULL;
            $data['rtu_file_name'] = NULL;
        } elseif($id == 2){
            $data['appointment'] = NULL;
            $data['appointment_file_name'] = NULL;
        } elseif($id == 3){
            $data['company_trade_patent'] = NULL;
            $data['company_trade_patent_file_name'] = NULL;
        } elseif($id == 4){
            $data['society_trade_patent'] = NULL;
            $data['society_trade_patent_file_name'] = NULL;
        } elseif($id == 5){
            $data['dpi_file'] = NULL;
            $data['dpi_file_name'] = NULL;
        } elseif($id == 6){
            $data['passport_file'] = NULL;
            $data['passport_file_name'] = NULL;
        } else {
            return response()->Json(['status' => false, 'message' => 'Technical error!', 'error' => 1]);
        }
        $update = $this->profileRepo->updatePersonalInfo($data);
        if(!$update){
            return response()->Json(['status' => false, 'message' => 'Technical error!', 'error' => 1]);
        }
        return response()->json(['status' => true, 'message' => 'Success! Personal Details Updated']);
    }

    public function cancelWithoutCredit()
    {
        $subscription = $this->profileRepo->cancelSubscriptionWithoutCredit();
        if(!$subscription){
            return response()->Json(['status' => false, 'message' => 'Technical error!', 'error' => 1]);
        }

        //Send Mail
        $auth_id = Auth::user()->id;
        $user = $this->userRepo->getUser($auth_id);
        $subData = $this->profileRepo->getPricematrixData($subscription['price_matrice_id']);
        $cancel_subscription = $this->mailRepo->cancelSubscriptionMail($user);
        //End Mail

        Auth::logout();
        return response()->json(['status' => true, 'message' => 'Success! Subscription Cancelled']);
    }

    public function cancelKeepCredit()
    {
        $subscription = $this->profileRepo->cancelSubscriptionKeepCredit();
        if(!$subscription){
            return response()->Json(['status' => false, 'message' => 'Technical error!', 'error' => 1]);
        }

        //Send Mail
        $auth_id = Auth::user()->id;
        $user = $this->userRepo->getUser($auth_id);
        $subData = $this->profileRepo->getPricematrixData($subscription['price_matrice_id']);
        $cancel_subscription = $this->mailRepo->cancelSubscriptionMail($user,$subData);
        //End Mail

        Auth::logout();
        return response()->json(['status' => true, 'message' => 'Success! Subscription Cancelled']);
    }

    public function paymentTest()
    {
            $paymentToken = "123456";
            $productId = "1";
            $productTotal = 10;
            $frequency ="mnv";
        // $cybersource = new Cybersource;
        // $response = $cybersource->createSubscription($paymentToken,$productId,$productTotal,$frequency);
        $response = Cybersource::createSubscription(
            $paymentToken,
            $productId,
            $productTotal,
            $frequency
        );
        if($response->isValid()) {
            $responseDetails = $response->getDetails();
            echo $responseDetails['paySubscriptionCreateReply']['subscriptionID'];
        } else {
            echo $response->error();
        }
    } 

    public function subscriptionData()
    {
        $cybersource_conf = \Config::get('cybersource');
        $auth_id = Auth::user()->id;
        $userSubscription = $this->profileRepo->getSubscriptionData();
        $transaction_uuid = mt_rand(1000000000000,9999999999999);
        $user_ip = $_SERVER['REMOTE_ADDR'];
        if($userSubscription->priceMatrice['payment_type'] == "Annual"){
            $currentDate = date('Y-m-d H:i:s');
            $temp = $userSubscription['created_at']->diff($currentDate);
            $usedDays = $temp->format('%r%a');
            $usedMonths = round($usedDays/30);
            $balanceMonth = 12 - $usedMonths;
            $tempAmount = $userSubscription['priceMatrice']['price'] / 12;
            $creditAmount = round($balanceMonth * $tempAmount);
            $newSubscriptionData = $this->profileRepo->newSubscriptionData($userSubscription);
            $amount = $newSubscriptionData['price'] - $creditAmount;
            $userData = $this->profileRepo->getUserData($auth_id);
            if($newSubscriptionData['subscription_id'] == 2) {
                $transaction_type = "Cambiar a suscripción anual estándar";
            }  else {
                $transaction_type = "Actualice a la suscripción anual premium";
            }
            
            if($amount > 0){
                $invoiceData = [
                    'user_id'   =>  $auth_id,
                    'subscription_id'   =>  $newSubscriptionData['subscription_id'],
                    'price_id'   =>  $newSubscriptionData['id'],
                    'price' =>  $amount,
                    'transaction_uuid' => $transaction_uuid,
                    'transaction_type' => $transaction_type,
                ];
                $invoice = $this->profileRepo->createInvoice($invoiceData);
                //Send Mail
                // $mailData = [
                //     'user_email' => $userData['email'],
                //     'user_name' => $userData['first_name'],
                //     'last_subscription' => $userSubscription['subscriptionType']['subscription_name'],
                //     'new_subscription' => $transaction_type,
                // ];
                // $change_subscription = $this->mailRepo->subscriptionChangeMail($mailData);
                //End Mail
                $data = [
                    "profile_id" => $cybersource_conf['profile_id'],
                    "access_key" => $cybersource_conf['access_key'],
                    "secret_key" => $cybersource_conf['secret_key'],
                    "transaction_uuid" => $transaction_uuid,
                    "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
                    "signed_field_names" => "profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_cancel_page,override_custom_receipt_page",
                    "unsigned_field_names" => "device_fingerprint_id,signature,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,customer_ip_address,line_item_count,item_0_code,item_0_sku,item_0_name,item_0_quantity,item_0_unit_price,item_1_code,item_1_sku,item_1_name,item_1_quantity,item_1_unit_price,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4",
                    "transaction_type" => "sale",
                    "reference_number" => "B1611055676089",
                    "auth_trans_ref_no" => "B1611055676089",
                    "amount" => $amount,
                    "currency" => "GTQ",
                    "locale" => "es-us",
                    "merchant_descriptor" => $userData['first_name'],
                    "bill_to_forename" => $userData['first_name'],
                    "bill_to_surname" => $userData['surname'],
                    "bill_to_email" => $userData['email'],
                    "bill_to_phone" => "",
                    "bill_to_address_line1" => "",
                    "bill_to_address_line2" => "",
                    "bill_to_address_city" => "Guatemala",
                    "bill_to_address_state" => "Guatemala",
                    "bill_to_address_country" => "GT",
                    "bill_to_address_postal_code" => "",
                    "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
                    // "override_custom_receipt_page" => "http://herramientas.localhost/cybersource/payment/response",
                    "override_custom_receipt_page" => url('/')."/cybersource/payment/response",
                    "customer_ip_address" => $user_ip,
                    "line_item_count" => "2",
                    "item_0_sku" => "sku001",
                    "item_0_code" => "KFLTFDIV",
                    "item_0_name" => "KFLTFDIV",
                    "item_0_quantity" => "100",
                    "item_0_unit_price" => $amount,
                    "item_1_sku" => "sku002",
                    "item_1_code" => "KFLTFD70",
                    "item_1_name" => "KFLTFD70",
                    "item_1_quantity" => "100",
                    "item_1_unit_price" => $amount,
                    "merchant_defined_data1" => "MDD#1",
                    "merchant_defined_data2" => "MDD#2",
                    "merchant_defined_data3" => "MDD#3",
                    "merchant_defined_data4" => "MDD#4",
                    "allow_payment_token_update"=>"false",
                    "auth_type"=>"AUTOCAPTURE",
                    "bill_payment"=>"true",
                ];
    
                return view('cybersource.secure.confirm', compact('data'));
            } else {
                
                $newData = $this->profileRepo->newSubscriptionData($userSubscription);
                
                $today = date('Y-m-d H:i:s');
                $days = 364;
                $expDate = date('Y-m-d', strtotime($today. ' + '.$days.' days'));
                if($newData['subscription_id'] == 3){
                    $gradeStatus = 2;
                } else {
                    $gradeStatus = 1;
                }
                $update = [
                    'subscription_id'  => $newData['subscription_id'],
                    'price_matrice_id' => $newData['id'],
                    'grade_status'     => $gradeStatus,
                    'grade_date'       => $today,
                    'created_at'       => $today,
                    'updated_at'       => $today,
                    'expire_date'      => $expDate,  
                ];
                $updatePurchaseData = $this->profileRepo->updateSubscription($update);
                if($amount != 0){
                    $amount = -1*$amount;
                    $creditKeep = $this->profileRepo->cancelSubscriptionKeepBalanceCredit($amount,$newData['subscription_id']);
                }
                // dd($newData);
                if($updatePurchaseData ){
                    $data = ["reason_code" => "100","req_transaction_uuid" => "1","transaction_id"=>""];
                } else  {
                    $data = ["reason_code" => "150"]; 
                }
                return view('front.user.payment-response', compact('data'));
            }
        } else {
            $currentDate = date('Y-m-d H:i:s');
            $temp = $userSubscription['created_at']->diff($currentDate);
            $usedDays = $temp->format('%r%a');
            $balanceDays = 30 - $usedDays;
            $tempAmount = $userSubscription['priceMatrice']['price'] / 31;
            $creditAmount = round($balanceDays * $tempAmount);
            $newSubscriptionData = $this->profileRepo->newSubscriptionData($userSubscription);
            $amount = $newSubscriptionData['price'] - $creditAmount;
            $userData = $this->profileRepo->getUserData($auth_id);
            if($newSubscriptionData['subscription_id'] == 2) {
                $transaction_type = "Cambiar a suscripción mensual estándar";
            }  else {
                $transaction_type = "Actualice a la suscripción mensual premium";
            }
            if($amount > 0){
                $invoiceData = [
                    'user_id'   =>  $auth_id,
                    'subscription_id'   =>  $newSubscriptionData['subscription_id'],
                    'price_id'   =>  $newSubscriptionData['id'],
                    'price' =>  $amount,
                    'transaction_uuid' => $transaction_uuid,
                    'transaction_type' => $transaction_type,
                ];
                $invoice = $this->profileRepo->createInvoice($invoiceData);
                // //Send Mail
                // $mailData = [
                //     'user_email' => $userData['email'],
                //     'user_name' => $userData['first_name'],
                //     'last_subscription' => $userSubscription['subscriptionType']['subscription_name'],
                //     'new_subscription' => $transaction_type,
                // ];
                // $change_subscription = $this->mailRepo->subscriptionChangeMail($mailData);
                // //End Mail
                $data = [
                    "profile_id" => $cybersource_conf['profile_id'],
                    "access_key" => $cybersource_conf['access_key'],
                    "secret_key" => $cybersource_conf['secret_key'],
                    "transaction_uuid" => $transaction_uuid,
                    "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
                    "signed_field_names" => "profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_cancel_page,override_custom_receipt_page",
                    "unsigned_field_names" => "device_fingerprint_id,signature,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,customer_ip_address,line_item_count,item_0_code,item_0_sku,item_0_name,item_0_quantity,item_0_unit_price,item_1_code,item_1_sku,item_1_name,item_1_quantity,item_1_unit_price,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4",
                    "transaction_type" => "sale",
                    "reference_number" => "B1611055676089",
                    "auth_trans_ref_no" => "B1611055676089",
                    "amount" => $amount,
                    "currency" => "GTQ",
                    "locale" => "es-us",
                    "merchant_descriptor" => $userData['first_name'],
                    "bill_to_forename" => $userData['first_name'],
                    "bill_to_surname" => $userData['surname'],
                    "bill_to_email" => $userData['email'],
                    "bill_to_phone" => "",
                    "bill_to_address_line1" => "",
                    "bill_to_address_line2" => "",
                    "bill_to_address_city" => "Guatemala",
                    "bill_to_address_state" => "Guatemala",
                    "bill_to_address_country" => "GT",
                    "bill_to_address_postal_code" => "",
                    "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
                    // "override_custom_receipt_page" => "http://herramientas.localhost/cybersource/payment/response",
                    "override_custom_receipt_page" => url('/')."/cybersource/payment/response",
                    "customer_ip_address" => $user_ip,
                    "line_item_count" => "2",
                    "item_0_sku" => "sku001",
                    "item_0_code" => "KFLTFDIV",
                    "item_0_name" => "KFLTFDIV",
                    "item_0_quantity" => "100",
                    "item_0_unit_price" => $amount,
                    "item_1_sku" => "sku002",
                    "item_1_code" => "KFLTFD70",
                    "item_1_name" => "KFLTFD70",
                    "item_1_quantity" => "100",
                    "item_1_unit_price" => $amount,
                    "merchant_defined_data1" => "MDD#1",
                    "merchant_defined_data2" => "MDD#2",
                    "merchant_defined_data3" => "MDD#3",
                    "merchant_defined_data4" => "MDD#4",
                    "allow_payment_token_update"=>"false",
                    "auth_type"=>"AUTOCAPTURE",
                    "bill_payment"=>"true",
                ];

                return view('cybersource.secure.confirm', compact('data'));
            } else {
                $newData = $this->profileRepo->newSubscriptionData($userSubscription);
                $today = date('Y-m-d H:i:s');
                $days = 30;
                $expDate = date('Y-m-d', strtotime($today. ' + '.$days.' days'));
                if($newData['subscription_id'] == 3){
                    $gradeStatus = 2;
                } else {
                    $gradeStatus = 1;
                }
                $update = [
                    'subscription_id'  => $newData['subscription_id'],
                    'price_matrice_id' => $newData['id'],
                    'grade_status'     => $gradeStatus,
                    'grade_date'       => $today,
                    'created_at'       => $today,
                    'updated_at'       => $today,
                    'expire_date'      => $expDate,  
                ];
                $updatePurchaseData = $this->profileRepo->updateSubscription($update);
                if($amount != 0){
                    $amount = -1*$amount;
                    $creditKeep = $this->profileRepo->cancelSubscriptionKeepBalanceCredit($amount,$newData['subscription_id']);
                }
                if($updatePurchaseData ){
                    $data = ["reason_code" => "100","req_transaction_uuid" => "1","transaction_id"=>""];
                } else  {
                    $data = ["reason_code" => "150"]; 
                }
                return view('front.user.payment-response', compact('data'));
            }
        }
    }

    public function paymentResponse($id,$txn)
    {
        $auth_id = Auth::user()->id;
        $invoice = $this->profileRepo->getInvoice($id);
        $update_invoice = $this->profileRepo->updateInvoice($invoice['id'],$txn);
        $updateCreditData = $this->profileRepo->updateCreditData($auth_id);
        $get_subscription = $this->profileRepo->getSubscriptionData();
        if($get_subscription){
            $update_purchase = $this->profileRepo->updatePurchase($invoice);
            //Send Mail
            $userData = $this->profileRepo->getUserData($auth_id);
            $transaction_type = $invoice['transaction_type'];
            $mailData = [
                'user_email' => $userData['email'],
                'user_name' => $userData['first_name'].' '.$userData['surname'],
                'last_subscription' => $get_subscription['subscriptionType']['subscription_name'],
                'new_subscription' => $transaction_type,
            ];
            $change_subscription = $this->mailRepo->subscriptionChangeMail($mailData);
            //End Mail
            return response()->json(['status' => true, 'message' => 'Success! Subscription Updated']);
        } else {
            $save_purchase = $this->profileRepo->savePurchase($invoice);
            //Send Mail
            $userData = $this->profileRepo->getUserData($auth_id);
            $transaction_type = $invoice['transaction_type'];
            $amount = $invoice['price'];
            $transaction_uuid = $invoice['transaction_uuid'];
            $purchase_subscription = $this->mailRepo->subscriptionPurchaseMail($userData,$transaction_type,$amount,$transaction_uuid);
            //End Mail
            return response()->json(['status' => true, 'message' => 'Success! Subscription Purchsed']);
        }
        return response()->json(['status' => false, 'message' => 'Payment Issue Founded']);
    }

}
