<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DocumentFilling;
use Carbon\Carbon;

class TruncateOldItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'truncate:items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete filled document after 30 days in nosubscription';

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
          DocumentFilling::leftJoin('users','users.id','=','document_fillings.user_id')->where('users.user_type','=',1)->orWhere('users.user_type','=',3)->whereDate('document_fillings.created_at', Carbon::now()->subDays(30))->delete();
    }
    
}
