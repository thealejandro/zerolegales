<?php

namespace App\Repository;
use App\DocumentFilling;
use App\DocumentStatus;
use App\SubscriptionType;
use App\Model\PurchasedSubscription;
use App\PriceMatrix;
use App\DocumentInvoice;
use App\User;
use App\LegalDocumentTemplate;
use DB;

class ReportRepository
{
    public function getDocumentStatus()
    {
        try{
            $statuses = DocumentStatus::all();
            return $statuses;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getReport3List($data)
    {
        try {

            //set column field database for datatable orderable & searchable
            $column = [
                // 0 => 'id',
                0 => 'document_name',
                1 => 'document_status',
                2 => 'subscription_name',
                3 => 'user1.first_name',
                4 => 'document_completed_date',
                5 => 'legalization_details.legalisation_status',
                6 => 'user1.surname',
                7 => 'user2.first_name',
                8 => 'user2.surname',
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


            $main_query = DocumentFilling::select(
                'legal_document_templates.document_name as DocumentName',
                'document_statuses.document_status as DocumentStatus',
                'subscription_types.subscription_name as SubscriptionName',
                'document_fillings.document_completed_date as  DocumentCompletedDate',
                'legalization_details.legalisation_status',
                'user1.first_name as FirstName1','user1.surname as SurName1','user2.first_name as FirstName2','user2.surname as SurName2',
                DB::Raw(
                    
                        'CASE
                            WHEN legalisation_status = 1 THEN "Yes"
                            WHEN legalisation_status = 2 THEN "Yes"
                            WHEN legalisation_status = 3 THEN "Yes"
                            ELSE "Not"
                        END
                    
                        as LegalisationStatus',
                ))
                ->leftJoin('legal_document_templates', 'document_fillings.document_id', 'legal_document_templates.id')
                ->leftJoin('document_statuses', 'document_fillings.status_id', 'document_statuses.id')
                ->leftJoin('legalization_details','document_fillings.legalization_id','legalization_details.id')
                ->leftJoin('users as user1','document_fillings.created_by','user1.id')
                ->leftJoin('users as user2','document_fillings.updated_by','user2.id')
                ->leftJoin('subscription_types', 'document_fillings.subscription_id', 'subscription_types.id');

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

            if ($columns[1]['search']['value'] != null) {
                $main_query->where('status_id', $columns[1]['search']['value']);
            }

            if ($range) {
                $main_query->whereBetween('document_completed_date', [$startDate, $endDate]);
            }

            $filter_count = $main_query->count();

            if ($limit != -1) {
                $main_query->offset($offset);
                $main_query->limit($limit);
            }

            // $main_query->withCount([
            //     'firstVisits',
            //     'supervisionVisits'
            // ]);
            $list = $main_query->get();
 
            $response = ['draw' => $draw, 'recordsTotal' => $total_count, 'recordsFiltered' => $filter_count, 'data' => $list, 'range' => $range, 'date' => $date,'limit'=>$limit];

            return $response;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }

    public function getsubscriptions()
    {
        try{
            $subscriptions = SubscriptionType::get();
            return $subscriptions;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getTotalUser($price_id)
    {
        try{
            $totalUser = PurchasedSubscription::where('price_matrice_id',$price_id)->where('is_active',1)->count();
            return $totalUser;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }
    public function getTotalDocUser($doc_id)
    {
        try{
            $totalUser = DocumentInvoice::where('document_id',$doc_id)->where('is_pay',1)->count();
            return $totalUser;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }

    public function getDocumentGenerated($sub_id)
    {
        try{
            $result = LegalDocumentTemplate::
            leftJoin('document_fillings','document_fillings.document_id','legal_document_templates.id')
            ->where('subscription_category',$sub_id)
            ->where('document_fillings.subscription_id',$sub_id)
            ->where('is_active',1)
            ->count();
            // dd($result);
            return $result;
        } catch (Exception $e) {
            logger()->error($e);
            return false;
        }
    }


    public function getReport1List($data)
    {
        try {
            // dd('mnv1');
            //set column field database for datatable orderable & searchable
            $column = [
                // 0 => 'id',
                0 => 'first_name',
                1 => 'email',
                2 => 'users.created_at',
                3 => 'subscription_id',
                4 => 'expire_date'
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


          

            
            $main_query = User::leftjoin('purchased_subscriptions','purchased_subscriptions.user_id','users.id')
            ->where('users.is_active',1)->select('users.first_name as FirstName','users.surname as SecondName','users.email as Email','users.created_at as DateOfJoin','purchased_subscriptions.subscription_id as Subscription','purchased_subscriptions.expire_date as DateOfExpire');
            

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

            if ($columns[1]['search']['value'] != null) {
                $main_query->where('subscription_id', $columns[1]['search']['value']);
            }

            if ($range) {
                $main_query->whereBetween('users.created_at', [$startDate, $endDate]);
            }

            $filter_count = $main_query->count();

            if ($limit != -1) {
                $main_query->offset($offset);
                $main_query->limit($limit);
            }

            // $main_query->withCount([
            //     'firstVisits',
            //     'supervisionVisits'
            // ]);
            $list = $main_query->get();
 
            $response = ['draw' => $draw, 'recordsTotal' => $total_count, 'recordsFiltered' => $filter_count, 'data' => $list, 'range' => $range, 'date' => $date];

            return $response;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }


    public function getReport2List($data)
    {
        try {
            // dd('mnv1');
            //set column field database for datatable orderable & searchable
            $column = [
                // 0 => 'id',
                0 => 'id',
                // 1 => 'payment_type',
                // 2 => 'users.created_at',
                // 3 => 'subscription_id',
                // 4 => 'expire_date'
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


          

            
            $main_query = PriceMatrix::
            with('subscription')->with('document')->with('purchase');
            // ->leftjoin('purchased_subscriptions','purchased_subscriptions.price_matrice_id','price_matrices.id')
            // ->leftjoin('subscription_types','subscription_types.id','price_matrices.subscription_id')
            // ->where('price_matrices.subscription_id','!=',1);
            // ->select('price_matrices.subscription_id','price_matrices.payment_type','subscription_types.id as type_id','purchased_subscriptions.id as purchase_id','price_matrices.id as price_id');
            

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

            if ($columns[1]['search']['value'] != null) {
                $main_query->where('subscription_id', $columns[1]['search']['value']);
            }

            if ($range) {
                $main_query->whereBetween('created_at', [$startDate, $endDate]);
            }

            $filter_count = $main_query->count();

            if ($limit != -1) {
                $main_query->offset($offset);
                $main_query->limit($limit);
            }

            // $main_query->withCount([
            //     'firstVisits',
            //     'supervisionVisits'
            // ]);
            $list = $main_query->get();
 
            $response = ['draw' => $draw, 'recordsTotal' => $total_count, 'recordsFiltered' => $filter_count, 'data' => $list, 'range' => $range, 'date' => $date];

            return $response;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }





    public function getReport4List($data)
    {
        try {
            $column = [
                0 => 'category_name',
                1 => 'document_name',
                2 => 'updated_at',
                3 => 'document_completed_date',
                4 => 'subscription_name',
                5 => 'total_price',
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
            
            $main_query = LegalDocumentTemplate::leftjoin('categories','legal_document_templates.category_id','categories.id')
            ->leftjoin('document_fillings','document_fillings.document_id','legal_document_templates.id')
            ->leftjoin('legalization_details','legalization_details.document_template_id','document_fillings.document_template_id')
            ->leftjoin('purchased_subscriptions','purchased_subscriptions.user_id','legalization_details.user_id')
            //->leftjoin('subscription_types','subscription_types.id','purchased_subscriptions.subscription_id')
            ->select('categories.category_name as Type','legal_document_templates.document_name as Name','document_fillings.updated_at as CompletedDate','document_fillings.document_completed_date as SentDate','purchased_subscriptions.subscription_id as Subscription','legalization_details.total_price as Amount','legalization_details.legalisation_status as Status');

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

            if ($columns[1]['search']['value'] != null) {
                $main_query->where('status_id', $columns[1]['search']['value']);
            }

            if ($range) {
                $main_query->whereBetween('document_completed_date', [$startDate, $endDate]);
            }

            $filter_count = $main_query->count();

            if ($limit != -1) {
                $main_query->offset($offset);
                $main_query->limit($limit);
            }

            // $main_query->withCount([
            //     'firstVisits',
            //     'supervisionVisits'
            // ]);
            $list = $main_query->get();
 
            $response = ['draw' => $draw, 'recordsTotal' => $total_count, 'recordsFiltered' => $filter_count, 'data' => $list, 'range' => $range, 'date' => $date];

            return $response;
        } catch (Exception $e) {

            logger()->error($e);
            return false;
        }
    }
}
