<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class KvadratResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_kurer' => $this->id_kurer,
            'sum_zakaz' => $this->sum_zakaz,
            'name' => $this->name,
            'kurer' => $this->kurer ,

        ];

    }
}
