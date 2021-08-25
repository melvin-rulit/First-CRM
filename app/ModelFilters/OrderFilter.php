<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
{

    public function PeriodDate($date): OrderFilter
    {
        return $this-> whereDate('date_delivery' , '=' , $date);


    }

}
