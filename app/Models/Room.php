<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'hostel_id',
        'hostel_name',
        'available',
        'room_type',
        'room_no',
        'description',
        'thumbnailimage',
        'billing', 
    ];

    public function hostel ()
    {
        return $this->belongsTo(Hostel::class);
    }
}
