<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
            'amount' => $this->amount,
            'additional_information' => $this->additional_information,
            'customer' => new CustomerResource($this->customer),
            'room' => new RoomResource($this->room),
            'booking-status' => new BookingStatusResource($this->status),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
