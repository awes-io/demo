<?php

namespace App\Sections\Sales\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sale extends JsonResource
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
            "total" => str_replace('.', ' ', $this->total / 1000),
            "lead_name" => $this->lead->name,
            "lead_phone" => $this->lead->phone,
            "created" => $this->created_at->diffForHumans()
        ];
    }
}