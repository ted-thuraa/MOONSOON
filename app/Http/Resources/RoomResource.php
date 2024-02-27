<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;


class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hostel_id' => $this->hostel_id,
            'hostel_name' => $this->hostel_name,
            'available' => $this->available,
            'room_type' => $this->room_type,
            'room_no' => $this->room_no,
            'description' => $this->description,
            'billing' => $this->billing,
            'thumbnailimage' => $this->thumbnailimage ? URL::to($this->thumbnailimage) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
