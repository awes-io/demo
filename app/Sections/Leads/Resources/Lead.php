<?php

namespace App\Sections\Leads\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Lead extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "is_premium" => $this->is_premium,
            "sales_count" => $this->sales_count,
            "created" => $this->created_at->diffForHumans()
        ];
    }
}