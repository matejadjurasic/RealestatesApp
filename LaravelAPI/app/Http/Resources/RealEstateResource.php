<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RealEstateResource extends JsonResource
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
            'username' => $this->username,
            'profile_picture_url' => $this->profile_picture_url,
            'description' => $this->description,
            'location'=>$this->location,
            'follows_count' => $this->follows_count,
            'followers_count' => $this->followers_count,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
