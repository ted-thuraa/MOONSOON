<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;


class HostelResource extends JsonResource
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
            'hostel_name' => $this->hostel_name,
            'location' => $this->location,
            'available' => $this->available,
            'description' => $this->description,
            'total_rooms' => $this->total_rooms,
            'rooms' => RoomResource::collection($this->rooms),
            'thumbnailimage' => $this->thumbnailimage ? URL::to($this->thumbnailimage) : null,
            'billing' => $this->billing,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
