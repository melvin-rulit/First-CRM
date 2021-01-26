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
            'id'            => $this->id,
            'name'          => $this->name,
            'surname'       => $this->surname,
            'email'         => $this->email,
            // 'branches'      => $this->branches,
            'roles'         => $this->roles,
            // 'online'        => Cache::has('user-is-online-' . $this->id),
        ];
    }
}
