<?php

namespace App\Repository;


use App\InvoiceData;
use Exception;
use DB;
use App\User;

class InvoiceDataRepository
{
    public function getInvoiceDataList($data)
    {
        try {

            //set column field database for datatable orderable & searchable
            $column = [
                0 => 'users.first_name',
                1 => 'document_invoices.created_at',
                2 => 'document_invoices.type',
                3 => 'document_invoices.amount',
                4 => 'users.email',
                5 => 'nit',
                6 => 'customer_name',
                7 => 'customer_address',
                8 => 'users.surname',
                9 => 'invoices.created_at',
               10 => 'invoices.transaction_type',
               11 => 'invoices.transaction_type',
            ];

            $offset = $data['offset'];
            $limit = $data['limit'];
            $draw = $data['draw'];
            $search = $data['search'];
            $columns = $data['columns'];
            $order_column = $data['order_column'];
            $order_direction = $data['order_direction'];

            $date = today()->format('Y-m-d');

            $range = $data['range'];

            $startDate = $endDate = null;

            if ($range) {
                $startDate = \Carbon\Carbon::parse($range['startDate'])->startOfDay()->format('Y-m-d');
                $endDate = \Carbon\Carbon::parse($range['endDate'])->endOfDay()->format('Y-m-d');
            }
            

            $main_query = InvoiceData::select(DB::raw('CONCAT(users.first_name," " ,users.surname) as full_name'),
                DB::Raw(                      
                    'CASE
                        WHEN transaction_type = "Suscripción mensual premium" THEN  invoices.created_at
                        WHEN transaction_type = "Suscripción anual premium" THEN  invoices.created_at
                        WHEN transaction_type = "Suscripción anual estándar" THEN  invoices.created_at
                        WHEN transaction_type = "Suscripción mensual estándar" THEN  invoices.created_at
                        WHEN type = "Compra de documentos,Legalización" THEN  document_invoices.created_at
                        WHEN type = "Compra de documentos" THEN  document_invoices.created_at
                        WHEN type = "Legalización" THEN  document_invoices.created_at
                        ELSE ""
                    END
                
                    as purchase_date'),
                    DB::Raw(                      
                        'CASE
                            WHEN user_type = 2 THEN  invoices.transaction_type
                            WHEN user_type = 3 THEN  document_invoices.type
                            ELSE ""
                        END  as purchase_type'),
                    DB::Raw(                      
                        'CASE

                            WHEN transaction_type = "Suscripción mensual premium" THEN "Suscripción"
                            WHEN transaction_type = "Suscripción anual premium" THEN "Suscripción"
                            WHEN transaction_type = "Suscripción anual estándar" THEN "Suscripción"
                            WHEN transaction_type = "Suscripción mensual estándar" THEN "Suscripción"
                            WHEN type = "Compra de documentos,Legalización" THEN "Documentos"
                            WHEN type = "Compra de documentos" THEN "Documentos"
                            WHEN type = "Legalización" THEN "Legalización"
                            ELSE ""
                        END
                    
                    as purchase_type'),
                    DB::Raw(                      
                        'CASE
                            WHEN transaction_type = "Suscripción mensual premium" THEN  invoices.price
                            WHEN transaction_type = "Suscripción anual premium" THEN  invoices.price
                            WHEN transaction_type = "Suscripción anual estándar" THEN  invoices.price
                            WHEN transaction_type = "Suscripción mensual estándar" THEN  invoices.price
                            WHEN type = "Compra de documentos,Legalización" THEN  document_invoices.amount
                            WHEN type = "Compra de documentos" THEN  document_invoices.amount
                            WHEN type = "Legalización" THEN  document_invoices.amount
                            ELSE ""
                        END
                    
                    as price'),
           
                'users.email','invoice_data.nit','invoice_data.customer_name','invoice_data.customer_address','users.user_type','invoice_data.invoice')
                ->leftJoin('document_invoices', 'document_invoices.transaction_uuid', 'invoice_data.document_transaction')
                ->leftJoin('invoices', 'invoices.transaction_uuid', 'invoice_data.subscription_transaction')
                ->leftJoin('users', 'users.id', 'invoice_data.user_id');

            $total_count = $main_query->count();

            $directions = ['asc' => 'asc', 'desc' => 'desc'];
            $direction = $directions[$order_direction] ?? 'asc';

            // This raw orderByRaw query is to show null last, the second orderBy query does the actual sorting
            // Make sure to be careful when injecting user input in sql.
            // In this case we filter data using an array to map data, so that values injected in the query are controlled by us
            $main_query->orderByRaw('CASE WHEN ISNULL(' . $column[$order_column] . ') THEN 1 ELSE 0 END ' . $direction);
            $main_query->orderBy($column[$order_column], $direction);



            if ($search) {
                $search_terms = array_map('trim', explode(' ', $search));
                foreach ($search_terms as $search_term) {
                    $main_query->where(function ($query) use ($column, $search_term) {
                        foreach ($column as $key => $q) {
                            $query->orWhere($q, 'like', '%' . $search_term . '%');
                        }
                    });
                }
            }
            if ($columns[2]['search']['value'] != null) {
                $main_query->whereRaw('CASE WHEN transaction_type = "Suscripción mensual premium" THEN "Suscripción" 
                WHEN transaction_type = "Suscripción anual premium" THEN "Suscripción" 
                WHEN transaction_type = "Suscripción anual estándar" THEN "Suscripción" 
                WHEN transaction_type = "Suscripción mensual estándar" THEN "Suscripción" 
                WHEN type = "Compra de documentos,Legalización" THEN "Documentos" 
                WHEN type = "Compra de documentos" THEN "Documentos" 
                WHEN type = "Legalización" THEN "Legalización" ELSE ""  END = ?',$columns[2]['search']['value']);
            }
    
            if ($columns[0]['search']['value'] != null) {
                $main_query->whereRaw('CONCAT(users.first_name," " ,users.surname) like ?',["%{$columns[0]['search']['value']}%"]);
            }
            if ($columns[3]['search']['value'] != null) {
                $main_query->whereRaw('CASE
                    WHEN transaction_type = "Suscripción mensual premium" THEN  invoices.price
                    WHEN transaction_type = "Suscripción anual premium" THEN  invoices.price
                    WHEN transaction_type = "Suscripción anual estándar" THEN  invoices.price
                    WHEN transaction_type = "Suscripción mensual estándar" THEN  invoices.price
                    WHEN type = "Compra de documentos,Legalización" THEN  document_invoices.amount
                    WHEN type = "Compra de documentos" THEN  document_invoices.amount
                    WHEN type = "Legalización" THEN  document_invoices.amount
                    ELSE "" END like ?', ["%{$columns[3]['search']['value']}%"]);
                
            }
    
            if ($columns[4]['search']['value'] != null) {
                $main_query->where('users.email', 'like',["%{$columns[4]['search']['value']}%"]);
            }
          
            if ($columns[5]['search']['value'] != null) {
                $main_query->where('nit', 'like', ["%{$columns[5]['search']['value']}%"]);
            }

            if ($columns[6]['search']['value'] != null) {
                $main_query->where('customer_name', 'like', ["%{$columns[6]['search']['value']}%"]);
            }

            if ($columns[7]['search']['value'] != null) {
                $main_query->where('customer_address', 'like', ["%{$columns[7]['search']['value']}%"]);
            }

            if ($range) {

                $main_query->whereBetween( DB::Raw(                      
                    'CASE
                        WHEN transaction_type = "Suscripción mensual premium" THEN  invoices.created_at
                        WHEN transaction_type = "Suscripción anual premium" THEN  invoices.created_at
                        WHEN transaction_type = "Suscripción anual estándar" THEN  invoices.created_at
                        WHEN transaction_type = "Suscripción mensual estándar" THEN  invoices.created_at
                        WHEN type = "Compra de documentos,Legalización" THEN  document_invoices.created_at
                        WHEN type = "Compra de documentos" THEN  document_invoices.created_at
                        WHEN type = "Legalización" THEN  document_invoices.created_at
                        ELSE ""
                    END'),[$startDate,$endDate]);
            }

            $filter_count = $main_query->count();

            if ($limit != -1) {
                $main_query->offset($offset);
                $main_query->limit($limit);
            }

            $list = $main_query->get();

            $response = ['draw' => $draw, 'recordsTotal' => $total_count, 'recordsFiltered' => $filter_count, 'data' => $list, 'range' => $range, 'date' => $date,'limit'=>$limit];

            return $response;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
}