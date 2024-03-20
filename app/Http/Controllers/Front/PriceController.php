<?php

namespace App\Http\Controllers\Front;

use Cybersource\ApiClient;
use Illuminate\Http\Request;
use Cybersource\ApiException;
use Cybersource\Configuration;
use Cybersource\Api\PaymentsApi;
use App\Repository\MailRepository;
use App\Repository\PriceRepository;
use App\Http\Controllers\Controller;
use Cybersource\Model\KeyParameters;
use Illuminate\Support\Facades\Auth;
use Cybersource\Api\KeyGenerationApi;
use Cybersource\Model\CreatePaymentRequest;
use Cybersource\Model\Ptsv2paymentsAmountDetails;
use Cybersource\Model\Ptsv2paymentsOrderInformation;
use Cybersource\Model\Ptsv2paymentsPaymentInformation;
use Cybersource\Model\Ptsv2paymentsProcessingInformation;
use CyberSource\Authentication\Core\MerchantConfiguration;
use Cybersource\Model\Ptsv2paymentsPaymentInformationCard;
use Cybersource\Model\Ptsv2paymentsClientReferenceInformation;

class PriceController extends Controller
{
    private $priceRepo;


    public function __construct(PriceRepository $priceRepo, MailRepository $mailRepo)
    {
        $this->priceRepo = $priceRepo;
        $this->mailRepo = $mailRepo;
        $this->user =  \Auth::guard('web');
    }
    public function index()
    {
        $user = \Auth::guard('web');
        // dd($user->user());
        if ($user->user() != null) {
            $auth_id = Auth::user()->id;
            $purchased = $this->priceRepo->getPurchasedSubscription($auth_id);
        } else {
            $purchased = '';
        }
        $price_standard = $this->priceRepo->getStandardSubscription();
        $price_premium = $this->priceRepo->getPremiumSubscription();
        $subscriptions = $this->priceRepo->getubscription();
        return view('front.prices.subscription_plans')->with(['price_standard' => $price_standard, 'price_premium' => $price_premium, 'purchased' => $purchased, 'subscriptions' => $subscriptions]);
    }
    public function indexList(Request $request)
    {
        $data = $request->all();
        $standard = $this->priceRepo->listStandardSubscription($data);
        $price_standard = number_format($standard, 2);
        $premium = $this->priceRepo->listPremiumSubscription($data);
        $price_premium = number_format($premium, 2);
        if ($price_standard && $price_premium) {
            $json_data = array('price_standard' => $price_standard, 'price_premium' => $price_premium, 'payment_type' => $data['payment_type']);
        }
        return response()->json($json_data);
    }

    public function purchase($price)
    {
        $cybersource_conf = \Config::get('cybersource');
        $auth_id = Auth::user()->id;
        $price = $this->priceRepo->getSubscriptionData($price);
        $userData = $this->priceRepo->getUserData($auth_id);
        $creditData = $this->priceRepo->getCreditData($auth_id);
        if($creditData){
            $amount = $price['price']-$creditData['credit_amount'];
        } else {
            $amount = $price['price'];
        }
      //$amount = 1;

        if($amount>0){
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $transaction_uuid = mt_rand(1000000000000,9999999999999);
            if($price['subscription_id'] == 2 && $price['payment_type'] == "Monthly") {
                $transaction_type = "Suscripción mensual estándar";
            } elseif($price['subscription_id'] == 2 && $price['payment_type'] == "Annual") {
                $transaction_type = "Suscripción anual estándar";
            } elseif($price['subscription_id'] == 3 && $price['payment_type'] == "Monthly") {
                $transaction_type = "Suscripción mensual premium";
            } elseif($price['subscription_id'] == 3 && $price['payment_type'] == "Annual") {
                $transaction_type = "Suscripción anual premium";
            } else {
                $transaction_type = "";
            }

            // //Send Mail
            // $purchase_subscription = $this->mailRepo->subscriptionPurchaseMail($userData,$transaction_type,$amount,$transaction_uuid);
            // //End Mail

            $invoiceData = [
                'user_id'   =>  $auth_id,
                'subscription_id'   =>  $price['subscription_id'],
                'price_id'   =>  $price['id'],
                'price' =>  $amount,
                'transaction_uuid' => $transaction_uuid,
                'transaction_type' => $transaction_type,
            ];
            $invoice = $this->priceRepo->createInvoice($invoiceData);
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
               "bill_to_address_line1" => "Guatemala",
                "bill_to_address_line2" => "",
                "bill_to_address_city" => "Guatemala",
                "bill_to_address_state" => "Guatemala",
                "bill_to_address_country" => "GT",
                "bill_to_address_postal_code" => "",
                "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
                "override_custom_receipt_page" => url('/')."/cybersource/payment/response",
                // "override_custom_receipt_page" => "http://herramientas.localhost/cybersource/payment/response",
                "customer_ip_address" => $user_ip,
                "line_item_count" => "2",
                "item_0_sku" => "sku001",
                "item_0_code" => "KFLTFDIV",
                "item_0_name" => "KFLTFDIV",
                "item_0_quantity" => "1",
                "item_0_unit_price" => $amount,
                "item_1_sku" => "sku002",
                "item_1_code" => "KFLTFD70",
                "item_1_name" => "KFLTFD70",
                "item_1_quantity" => "1",
                "item_1_unit_price" => $amount,
                "merchant_defined_data1" => "MDD#1",
                "merchant_defined_data2" => "MDD#2",
                "merchant_defined_data3" => "MDD#3",
                "merchant_defined_data4" => "MDD#4",
                "allow_payment_token_update"=>"false",
                "auth_type"=>"AUTOCAPTURE",
                "bill_payment"=>"true",



            ];
            if($price['payment_type'] == "Monthly")
            {
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
                   "bill_to_address_line1" => "Guatemala",
                    "bill_to_address_line2" => "",
                    "bill_to_address_city" => "Guatemala",
                    "bill_to_address_state" => "Guatemala",
                    "bill_to_address_country" => "GT",
                    "bill_to_address_postal_code" => "",
                    "override_custom_cancel_page" => url('/')."/cybersource/payment/response/cancel",
                    "override_custom_receipt_page" => url('/')."/cybersource/payment/response",
                    // "override_custom_receipt_page" => "http://herramientas.localhost/cybersource/payment/response",
                    "customer_ip_address" => $user_ip,
                    "line_item_count" => "2",
                    "item_0_sku" => "sku001",
                    "item_0_code" => "KFLTFDIV",
                    "item_0_name" => "KFLTFDIV",
                    "item_0_quantity" => "1",
                    "item_0_unit_price" => $amount,
                    "item_1_sku" => "sku002",
                    "item_1_code" => "KFLTFD70",
                    "item_1_name" => "KFLTFD70",
                    "item_1_quantity" => "1",
                    "item_1_unit_price" => $amount,
                    "merchant_defined_data1" => "MDD#1",
                    "merchant_defined_data2" => "MDD#2",
                    "merchant_defined_data3" => "MDD#3",
                    "merchant_defined_data4" => "MDD#4",
                    "allow_payment_token_update"=>"false",
                    "auth_type"=>"AUTOCAPTURE",
                    "bill_payment"=>"true",
                ];
            }
            /*
                "recurring_frequency"=>"monthly",
                "recurring_amount"=>$amount,
                "recurring_number_of_installments" => 60,
                "recurring_start_date"=>gmdate("Y-m-d\TH:i:s\Z"),
                "recurring_automatic_renew" => true,
            */
            return view('cybersource.secure.confirm', compact('data'));
        }else{
            $today = date('Y-m-d H:i:s');
            if($price['payment_type'] == "Monthly"){
                $days = 30;
            } else {
                $days = 364;
            }

            $expDate = date('Y-m-d', strtotime($today. ' + '.$days.' days'));

            $update = [
                'subscription_id'  => $price['subscription_id'],
                'price_matrice_id' => $price['id'],
                'grade_status'       => NULL,
                'is_active'       => 1,
                'grade_date'       => $today,
                'created_at'       => $today,
                'updated_at'       => $today,
                'expire_date'      => $expDate,
            ];
            $updatePurchaseData = $this->priceRepo->updateSubscription($update);
            //Send Mail
            if($price['subscription_id'] == 2 && $price['payment_type'] == "Monthly") {
                $transaction_type = "Suscripción mensual estándar";
            } elseif($price['subscription_id'] == 2 && $price['payment_type'] == "Annual") {
                $transaction_type = "Suscripción anual estándar";
            } elseif($price['subscription_id'] == 3 && $price['payment_type'] == "Monthly") {
                $transaction_type = "Suscripción mensual premium";
            } elseif($price['subscription_id'] == 3 && $price['payment_type'] == "Annual") {
                $transaction_type = "Suscripción anual premium";
            } else {
                $transaction_type = "";
            }
            //  $purchase_subscription = $this->mailRepo->subscriptionPurchaseMail($userData,$transaction_type,$amount);
            //End Mail
            if($updatePurchaseData){
                $data = ["reason_code" => "100","req_transaction_uuid" => "1","transaction_id"=>""];
            } else  {
                $data = ["reason_code" => "150"];
            }
            return view('front.user.payment-response', compact('data'));
        }

    }
}
