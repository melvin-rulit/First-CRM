<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed roles
 * @property mixed email
 * @property mixed surname
 * @property mixed name
 * @property mixed id
 */
class UserAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'          => $this->name,
            'surname'       => $this->surname,
            'phone'         => $this->phone,
            'car'         => $this->car,
            'email'         => $this->email,
            'secret_id'      => $this->secret_id,
            'coment'         => $this->coment,
        ];
    }
}
