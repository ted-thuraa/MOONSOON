<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
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
            'uuid' => $this->uuid,
            'theme_id' => $this->theme_id,
            'isAdmin' => $this->isAdmin,
            'username' => $this->username,
            'fullname' => $this->fullname,
            'currentplan' => $this->currentplan,
            'creator_category' => $this->creator_category,
            'email' => $this->email,
            'bio' => $this->bio,
            'bioimage' => $this->image,
            'creator_category' => $this->creator_category,
            'location' => $this->location,
            'page_font' => $this->page_font,
            'page_layout' => $this->page_layout,
            'theme_id' => $this->theme_id,
            'isGooglesheetsAuthorized' => $this->isGooglesheetsAuthorized,
            'isMailchimpAuthorized' => $this->isMailchimpAuthorized,
            'is_email_verified' => $this->is_email_verified,
            'ishidelogo' => $this->ishidelogo,
            //'image' => url('/') . $this->image,
            //'image' => url('/app') . $this->image,
            'image' => $this->image ? Storage::disk('do')->url($this->image) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
