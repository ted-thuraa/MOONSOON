<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\RoomApplication;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::count();
        $hostels = Hostel::count();
        $reservations = RoomApplication::count();

        $data = [
            'users' => $users,
            'hostels' => $hostels,
            'reservations' => $reservations,
           
        ];
        return response()->json($data, 200);
    }
}
