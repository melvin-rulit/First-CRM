<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed title
 */

class PromouterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nameus' => $this->nameus,
            'kurer' => $this->kurer ? $this->kurer : " Не задан",
            'kurer_id' => $this->kurer_id ? $this->kurer_id : "----",
            'kvadrat_id' => $this->kvadrat_id ? $this->kvadrat_id : "----",
            'adress' => $this->adress,
            'tel' => $this->tel,
            'status_kurer' => $this->status_kurer,
            'racion' => $this->racion,
            'deliv' => $this->deliv,
            'total' => $this->total,
            'town' => $this->town,
            'pay' => $this->pay,
        ];
    }
}
