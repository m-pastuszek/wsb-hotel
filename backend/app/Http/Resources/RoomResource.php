<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'room_number' => $this->room_number,
            'floor' => $this->floor,
            'description' => $this->description,
            'price_per_night' => $this->price_per_night,
            'room_type' => new RoomTypeResource($this->roomType),
            'bed_type' => new RoomBedTypeResource($this->bedType),
            'status' => new RoomStatusResource($this->status),
            'photos' =>  [
                'hero' => $this->main_photo,
                'gallery' => PhotoResource::collection($this->attachment()->get())
            ],
            'amenities' =>  new RoomStatusResource($this->amenities),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
