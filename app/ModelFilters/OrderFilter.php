<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
{

    public function FindPhone($phone): OrderFilter
    {
        return $this-> where('tel' , '=' , $phone)-> where('date_delivery',  '!=', null);
    }

    public function FindData($data): OrderFilter
    {
        return $this-> where('array' , 'like' , '%'.$data.'%')-> where('date_delivery','!=',null);
    }

}
