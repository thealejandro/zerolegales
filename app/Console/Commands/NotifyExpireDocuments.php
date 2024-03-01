<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DocumentFilling;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpireDocumentMail;
use DB;

class NotifyExpireDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email for documents will expire in 3 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $documents = DocumentFilling::select(DB::raw("CONCAT_WS(' ',users.first_name,users.surname) as full_name"),DB::raw('DATE_FORMAT(document_fillings.created_at, "%d/%m/%Y") as created_date'),
        'users.email','legal_document_templates.document_name','legal_document_templates.document_image')->leftJoin('users','users.id','=','document_fillings.user_id')->leftJoin('legal_document_templates','legal_document_templates.id','=','document_fillings.document_id')->where('users.user_type','=',1)->orWhere('users.user_type','=',3)->where('document_fillings.deleted_at','=',null)->whereDate('document_fillings.created_at', Carbon::now()->subDays(27))->get();

        foreach($documents as $document) 
        {

            $data = array(
                'user_name'         => $document->full_name,
                'user_email'        => $document->email ,
                'created_at'        => $document->created_date,
                'document_name'     => $document->document_name,
                'document_image'    => $document->document_image
            );

            Mail::to($data['user_email'])->send(new ExpireDocumentMail($data));     
        }
    }
}
