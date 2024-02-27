<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'hostel_name',
        'location',
        'available',
        'description',
        'total_rooms',
        'thumbnailimage',
        'billing',
        
    ];

    //create relation with rooms
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
