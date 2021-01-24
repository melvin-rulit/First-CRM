<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed phone
 * @property mixed email
 * @property mixed roles
 * @property mixed surname
 * @property mixed lastname
 * @property mixed adress
 * @property mixed birthday
 */
class GetUserResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'surname'       => $this->surname,
            'lastname'      => $this->lastname,
            'adress'        => $this->adress,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'birthday'      => $this->birthday,
            'role'          => $this->roles->map->only('id', 'title'),

        ];
    }
}
