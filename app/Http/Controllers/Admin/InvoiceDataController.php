<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\InvoiceDataRepository;
use Carbon\Carbon;

class InvoiceDataController extends Controller
{
    private $invoiceRepo;


    public function __construct(InvoiceDataRepository $invoiceRepo)
    {
        $this->invoiceRepo = $invoiceRepo;
    }
    public function index(){
      
        return view('admin.invoice_data.index');

    }
    public function datatableInvoiceData(Request $request)
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

        $invoice_datas = $this->invoiceRepo->getInvoiceDataList($aData);

        $result = array();
        foreach ($invoice_datas['data'] as $invoice_data) {
            $temp = array();
                $temp["full_name"] = $invoice_data->full_name;
                $temp["purchase_date"] =Carbon::parse($invoice_data->purchase_date)->startOfDay()->format('d/m/Y');
                $temp["purchase_type"] = $invoice_data->purchase_type;
                $temp["price"] = $invoice_data->price;
                $temp["email"] = $invoice_data->email;
                if($invoice_data->invoice == 0){
                    $temp["nit"] = $invoice_data->nit;
                }
                if($invoice_data->invoice == 1){
                    $temp["nit"] = '--';
                }

            $temp["customer_name"] = $invoice_data->customer_name;
            $temp["customer_address"] = $invoice_data->customer_address;
           
            $result[] = $temp;
        }

        $invoice_datas['data'] = $result;

        return response()->Json($invoice_datas);
    }
}
