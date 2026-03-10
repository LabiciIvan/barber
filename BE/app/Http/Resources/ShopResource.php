<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"            => $this->id,
            "name"          => $this->name,
            "slug"          => $this->slug,
            "subdomain"     => $this->subdomain,
            "latitude"      => $this->latitude,
            "longitude"     => $this->longitude,
            "city"          => $this->city,
            "barbers"       => UserResource::collection($this->whenLoaded('barbers'))
        ];
    }
}
