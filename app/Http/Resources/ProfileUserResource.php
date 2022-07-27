<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileUserResource extends JsonResource
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
            'id' => $this->profile->user->id,
            'user_name' => $this->profile->user->user_name,
            'first_name' => $this->profile->first_name,
            'last_name' => $this->profile->last_name,
            'profile_avatar' => $this->profile->profile_avatar ? asset('storage/'.$this->profile->profile_avatar) : null,
            'profile_background' =>$this->profile->profile_background 
            ? asset("/storage/{$this->profile->profile_background}"): null ,
            'user_location' => $this->profile->user_location,
        ];
    }
}
