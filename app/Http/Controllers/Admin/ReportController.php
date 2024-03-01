<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\ReportRepository;
use Carbon\Carbon;

class ReportController extends Controller
{
    private $reportRepo;


    public function __construct(ReportRepository $reportRepo)
    {
        $this->reportRepo = $reportRepo;
    }
    public function report3(){
        $statuses = $this->reportRepo->getDocumentStatus();
        return view('admin.reports.report3')->with(['statuses'=> $statuses]);

    }

    public function datatableReport3(Request $request)
    {
        $offset = $request->get('start');
        $length = $request->get('length');
        $draw = $request->get('draw');
        $search = $request->search['value'];

        $columns = $request->get('columns');

        $range = $request->get('range');

        $order_column = $request->input('order.0.column') ?? 1;
        $order_direction = $request->input('order.0.dir') ?? 'asc';


        $aData = [
            'offset' => $offset, 'limit' => $length, 'draw' => $draw, 'search' => $search, 'order_column' => $order_column, 'order_direction' => $order_direction, 'columns' => $columns,
            'range' => $range
        ];

        $reports = $this->reportRepo->getReport3List($aData);

        $result = array();
        foreach ($reports['data'] as $document) {
            $temp = array();

            $temp["DocumentName"] = $document->DocumentName;
            $temp["DocumentStatus"] = $document->DocumentStatus;
            $temp["SubscriptionName"] = $document->SubscriptionName;
            if($document->DocumentCompletedDate == null){
                $temp["Name"] = $document->FirstName1.' '.$document->SurName1;
            }
            else{
                $temp["Name"] = $document->FirstName2.' '.$document->SurName2;
            }
            if($document->DocumentCompletedDate == null){

                $temp["DocumentCompletedDate"] =$document->DocumentCompletedDate;
            }
            else{
                $temp["DocumentCompletedDate"] = Carbon::parse($document->DocumentCompletedDate)->startOfDay()->format('d/m/Y');
            }
            $temp["LegalisationStatus"] = $document->LegalisationStatus;
            $result[] = $temp;
        }

        $reports['data'] = $result;

        return response()->Json($reports);
    }

    public function report1(){
        $subscriptions = $this->reportRepo->getsubscriptions();
        foreach($subscriptions as $subscription){
            if($subscription->id == 1){
                $subscription['subscription_name'] = 'Compra única';
            }
            else if($subscription->id == 2){
                $subscription['subscription_name'] = 'Suscripción estándar';
            } else  if($subscription->id == 3){
                $subscription['subscription_name'] = 'Suscripción Premium';
            } else {
                $subscription['subscription_name'] = '';
            }
        }
        return view('admin.reports.report1')->with(['subscriptions'=> $subscriptions]);
    }

    public function datatableReport1(Request $request)
    {
        
        $offset = $request->get('start');
        $length = $request->get('length');
        $draw = $request->get('draw');
        $search = $request->search['value'];

        $columns = $request->get('columns');

        $range = $request->get('range');

        $order_column = $request->input('order.0.column') ?? 1;
        $order_direction = $request->input('order.0.dir') ?? 'asc';


        $aData = [
            'offset' => $offset, 'limit' => $length, 'draw' => $draw, 'search' => $search, 'order_column' => $order_column, 'order_direction' => $order_direction, 'columns' => $columns,
            'range' => $range
        ];

        $reports = $this->reportRepo->getReport1List($aData);

        $result = array();
        foreach ($reports['data'] as $document) {
            $temp = array();

            $temp["Name"] = $document->FirstName.' '.$document->SecondName;
            $temp["Email"] = $document->Email;
            $temp["DateOfJoin"] = Carbon::parse($document->DateOfJoin)->startOfDay()->format('d/m/Y');
            if($document->DateOfExpire){
                $temp["DateOfExpire"] = Carbon::parse($document->DateOfExpire)->startOfDay()->format('d/m/Y');
            } else {
                $temp["DateOfExpire"] = "";
            }
            if($document->Subscription == 1){
                $temp["Subscription"] = 'Compra única';
            }
            else if($document->Subscription == 2){
                $temp["Subscription"] = 'Suscripción estándar';
            } else  if($document->Subscription == 3){
                $temp["Subscription"] = 'Suscripción Premium';
            } else {
                $temp["Subscription"] = '';
            }
            
            $result[] = $temp;
        }

        $reports['data'] = $result;

        return response()->Json($reports);
    }


    public function report2(){
        // $subscriptions = $this->reportRepo->getsubscriptions();
        // foreach($subscriptions as $subscription){
        //     if($subscription->id == 1){
        //         $subscription['subscription_name'] = 'Compra única';
        //     }
        //     else if($subscription->id == 2){
        //         $subscription['subscription_name'] = 'Suscripción estándar';
        //     } else  if($subscription->id == 3){
        //         $subscription['subscription_name'] = 'Suscripción Premium';
        //     } else {
        //         $subscription['subscription_name'] = '';
        //     }
        // }
        return view('admin.reports.report2');
    }

    public function datatableReport2(Request $request)
    {
        
        $offset = $request->get('start');
        $length = $request->get('length');
        $draw = $request->get('draw');
        $search = $request->search['value'];

        $columns = $request->get('columns');

        $range = $request->get('range');

        $order_column = $request->input('order.0.column') ?? 1;
        $order_direction = $request->input('order.0.dir') ?? 'asc';


        $aData = [
            'offset' => $offset, 'limit' => $length, 'draw' => $draw, 'search' => $search, 'order_column' => $order_column, 'order_direction' => $order_direction, 'columns' => $columns,
            'range' => $range
        ];

        $reports = $this->reportRepo->getReport2List($aData);
// dd($reports);
        $result = array();
        foreach ($reports['data'] as $document) {
            $temp = array();

            if($document->subscription_id == 2 && $document->payment_type == "Monthly")
            {
                $temp["Name"] = 'Suscripción estándar mensual';
                $totalUser = $this->reportRepo->getTotalUser($document->id);
                $temp["users"] = $totalUser;
                $temp["price"] = $totalUser * $document->price;
                $temp["price"] = 'Q '.$temp["price"];
                $documentGenerated = $this->reportRepo->getDocumentGenerated($document->subscription_id);
                $temp["document"] = $documentGenerated;
            }
            else if($document->subscription_id == 2 && $document->payment_type == "Annual")
            {
                $temp["Name"] = 'Suscripción estándar anual';
                $totalUser = $this->reportRepo->getTotalUser($document->id);
                $temp["users"] = $totalUser;
                $temp["price"] = $totalUser * $document->price;
                $temp["price"] = 'Q '.$temp["price"];
                $documentGenerated = $this->reportRepo->getDocumentGenerated($document->subscription_id);
                $temp["document"] = $documentGenerated;
            }else if($document->subscription_id == 3 && $document->payment_type == "Monthly")
            {
                $temp["Name"] = 'Suscripción Premium Mensual';
                $totalUser = $this->reportRepo->getTotalUser($document->id);
                $temp["users"] = $totalUser;
                $temp["price"] = $totalUser * $document->price;
                $temp["price"] = 'Q '.$temp["price"];
                $documentGenerated = $this->reportRepo->getDocumentGenerated($document->subscription_id);
                $temp["document"] = $documentGenerated;
            }else if($document->subscription_id == 3 && $document->payment_type == "Annual")
            {
                $temp["Name"] = 'Suscripción Premium Anual';
                $totalUser = $this->reportRepo->getTotalUser($document->id);
                $temp["users"] = $totalUser;
                $temp["price"] = $totalUser * $document->price;
                $temp["price"] = 'Q '.$temp["price"];
                $documentGenerated = $this->reportRepo->getDocumentGenerated($document->subscription_id);
                $temp["document"] = $documentGenerated;
            }
            else
            {
                $temp["Name"] = $document['document']['document_name'];
                $totalUser = $this->reportRepo->getTotalDocUser($document->document_id);
                $temp["users"] = $totalUser;
                $temp["price"] = $totalUser * $document->price;
                $temp["price"] = 'Q '.$temp["price"];
                $temp["document"] = 0;
            }

            // $temp["users"] = $document->subscription_id;
            // $temp["price"] = $document->subscription_id;
            // $temp["document"] = $document->subscription_id;
            $result[] = $temp;
        }

        $reports['data'] = $result;

        return response()->Json($reports);
    }




    public function report4(){
        $statuses = $this->reportRepo->getDocumentStatus();
        return view('admin.reports.report4')->with(['statuses'=> $statuses]);
    }

    public function datatableReport4(Request $request)
    {
        $offset = $request->get('start');
        $length = $request->get('length');
        $draw = $request->get('draw');
        $search = $request->search['value'];
        $columns = $request->get('columns');
        $range = $request->get('range');
        $order_column = $request->input('order.0.column') ?? 1;
        $order_direction = $request->input('order.0.dir') ?? 'asc';
        $aData = [
            'offset' => $offset, 'limit' => $length, 'draw' => $draw, 'search' => $search, 'order_column' => $order_column, 'order_direction' => $order_direction, 'columns' => $columns,
            'range' => $range
        ];

        $reports = $this->reportRepo->getReport4List($aData);

        $result = array();
        $total = 0;
        foreach ($reports['data'] as $document) {
            $temp = array();

            $temp["Type"] = $document->Type;
            $temp["Name"] = $document->Name;
            $temp["SentDate"] = Carbon::parse($document->SentDate)->startOfDay()->format('d/m/Y');
            if($document->Status == 3){
                $temp["CompletedDate"] = Carbon::parse($document->CompletedDate)->startOfDay()->format('d/m/Y');
            } else {
                $temp["CompletedDate"] = "";
            }
            if($document->Subscription == 1){
                $temp["Subscription"] = 'Compra única';
            }
            else if($document->Subscription == 2){
                $temp["Subscription"] = 'Suscripción estándar';
            } else  if($document->Subscription == 3){
                $temp["Subscription"] = 'Suscripción Premium';
            } else {
                $temp["Subscription"] = '';
            }
            $temp["Amount"] = $document->Amount;
            $total = $total + $temp["Amount"];
            $temp["total"] =$total;
            $result[] = $temp;
        }
        // $result['total'] = $total;
        $reports['data'] = $result;

        return response()->Json($reports);
    }

}
