<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class AccessFilter extends ModelFilter
{

    public function PeriodDate($date): AccessFilter
    {
        return $this-> whereDate('date_delivery' , '=' , $date);


    }

}
