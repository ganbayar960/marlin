<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'last_logged_at' => $this->last_logged_at,
            'authorized_at' => $this->authorized_at,
            'type' => $this->type->name,
            'created_at' => $this->created_at->toFormattedDateString()
        ];
    }
}
