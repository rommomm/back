<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PharIo\Manifest\Url;

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
            'profile_photo' => $this->profile_photo ? asset($this->profile_photo) : null,
            'profile_background' =>$this->profile_background 
            ? asset($this->profile_background): null ,
            'user_location' => $this->user_location,
        ];
    }
}
