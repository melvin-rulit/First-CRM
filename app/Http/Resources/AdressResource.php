<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed title
 */

class AdressResource extends JsonResource
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
            'title' => $this->title,
            'kvadrat_id' => $this->kvadrat_id,
            'created_at' => Carbon::parse($this->created_at)->format('d.m.Y'),
            'updated_at' => Carbon::parse($this->created_at)->format('H.m'),
        ];
    }
}
