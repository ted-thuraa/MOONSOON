<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ApplicationResource extends JsonResource
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
            'name' => $this->name,
            'hostel' => $this->hostel,
            'room' => $this->room,
            'active' => $this->active,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
