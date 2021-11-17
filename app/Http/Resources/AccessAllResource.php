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
            'orderid' => $this->orderid,
            'kvadrat_id' => $this->kvadrat_id ? $this->kvadrat_id : "+",
            'info' => $this->kvadrat_info ? $this->kvadrat_info->info : "",
            'nameus' => $this->nameus,
            "kurer" => $this->user ? $this->user->surname : 'Не задан',
            'adress' => $this->adress,
            'tel' => $this->tel,
            'deliv' => $this->deliv,
            'racion' => $this->racion,
            'total' => $this->total,
            'pay' => $this->pay,
            'datetimes' => Carbon::createFromDate($this->datetimes)->format('d.m.Y'),
            'date_delivery' => '✍️ редак-ть',
            'end_Date' => Carbon::createFromDate($this->end_Date)->format('d.m.Y'),

            'status' => $this->status,
            'start_edit' => $this->start_edit,
            'type_zakaz' => $this->type_zakaz,
            'array' => json_decode($this->array, true, 100, 0),
            'end_array' => json_decode($this->end_array, true, 100, 0),
        ];
    }
}
