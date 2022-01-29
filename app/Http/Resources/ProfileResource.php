<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'user_name' => $this->user->user_name,
            'email' => $this->user->email,
            'profile_avatar' => $this->profile_avatar ? asset("/storage/{$this->profile_avatar}") : null,
            'profile_background' =>$this->profile_background 
            ? asset("/storage/{$this->profile_background}"): null ,
            'user_location' => $this->user_location,
        ];
    }
}
