<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class AuthorPostResource extends JsonResource
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
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'comments_count' => $this->when(
                isset($this->comments_count),
                $this->comments_count
            ),
            'mentioned' => UserResource::collection($this->mentioned),
        ];
    }
}
