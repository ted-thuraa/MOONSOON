<?php

use App\Http\Controllers\Api\AdminDashController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminPaymentsController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HostelController;
use App\Http\Controllers\Api\RoomApplicationController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\SocialAuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Resources\UserResource;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::post('/register', [AuthController::class, 'store']);
   
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/verify-email-token', [AuthController::class, 'verifyemail']);
                
});






                

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });
    //Route::get('users', [UserController::class, 'index']);
    Route::post('username', [AuthController::class, 'updateUsername']);
    Route::patch('users/{user}', [UserController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/showHostel', [HostelController::class, 'index']);
    Route::get('/getCurrentHostel/{id}', [HostelController::class, 'getHostel']);
    Route::post('/createreservation', [RoomApplicationController::class, 'store']);
    //payments stuff
    
});


//admin side
Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    Route::get('/admin/analytics', [AdminDashController::class, 'index']);

    Route::get('/admin/users', [AdminUserController::class, 'index']);
    Route::get('/admin/getHostel', [HostelController::class, 'index']);
    Route::get('/admin/getCurrentHostel/{id}', [HostelController::class, 'getHostel']);
    Route::post('/admin/newHostel', [HostelController::class, 'store']);
    Route::delete('/admin/Hostel/{id}', [HostelController::class, 'destroy']);
    
    Route::get('/admin/getRoom/{id}', [RoomController::class, 'index']);
    Route::post('/admin/newroom', [RoomController::class, 'store']);
    Route::delete('/admin/room/{id}', [RoomController::class, 'destroy']);

    Route::get('/admin/getReservations', [RoomApplicationController::class, 'index']);
    Route::post('/admin/assignroom', [RoomApplicationController::class, 'assign']);

});

Route::post('/callback_hook/{order_id}', [MpesaController::class, 'index']);

