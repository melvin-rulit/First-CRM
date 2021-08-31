<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed access
 */
class AccessAllResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nameus' => $this->nameus,
            'kurer' => $this->kurer,
            'orderid' => $this->orderid,
            'adress' => $this->adress,
            'tel' => $this->tel,
            'racion' => $this->racion,
            'deliv' => $this->deliv,
            'pay' => $this->pay,
            'datetimes' =>  Carbon::createFromDate($this->datetimes)->format('d.m.Y'),
            'date_delivery' =>  $this->date_delivery ? Carbon::createFromDate($this->date_delivery)->format('d.m.Y') : '',
            'end_Date' =>   Carbon::createFromDate($this->end_Date)->format('d.m.Y') ,
        ];
    }
}
