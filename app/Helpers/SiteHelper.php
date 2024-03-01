<?php

namespace App\Helper;

use Auth;
use App\Models\AdminUser;

use Carbon\Carbon;

class SiteHelper
{
       

    public function getFormattedDate($date)
    {
       // return Carbon::parse($date)->format('d-m-Y');
        return date('Y-m-d H:i:s' , strtotime($date));
    }

    public function getReformattedDate($date)
    {
       // return Carbon::parse($date)->format('d-m-Y');
        return date('d F, Y' , strtotime($date));
    }
}
