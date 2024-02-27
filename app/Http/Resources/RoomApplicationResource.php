<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class RoomApplicationResource extends JsonResource
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
            'user_id' => $this->user_id,
            'hostel' => $this->hostel,
            'roomtype' => $this->roomtype,
            'allocated' => $this->allocated,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
