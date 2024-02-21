<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
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
            'authprovider' => $this->authprovider,
            'is_email_verified' => $this->is_email_verified,
            'isGooglesheetsAuthorized' => $this->isGooglesheetsAuthorized,
            'isMailchimpAuthorized' => $this->isMailchimpAuthorized,
            
            'image' => url('/') . $this->image,
            //'image' => url('/app') . $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
