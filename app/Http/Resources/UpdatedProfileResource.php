<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UpdatedProfileResource extends JsonResource
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
            'profile_photo' => $this->profile_photo,
            'profile_background' => $this->profile_background,
            'user_location' => $this->user_location,
        ];
    }
}
