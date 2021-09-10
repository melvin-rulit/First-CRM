<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
{

    public function PeriodDate($date): OrderFilter
    {
        return $this-> where('tel' , '=' , $date) ->where('date_delivery',  '!=', null);
    }

}
