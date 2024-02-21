<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminPaymentsController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\AuthController;
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


Route::group(['middleware' => ['api']], function () {
    
    Route::get('google-login', [SocialAuthController::class, 'redirectToProvider']);
    Route::post('google-login-token', [SocialAuthController::class, 'handlecallback']);
    

});



                

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });
    //Route::get('users', [UserController::class, 'index']);
    Route::post('username', [AuthController::class, 'updateUsername']);
    Route::patch('users/{user}', [UserController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    //payments stuff
    
});


//admin side
Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index']);
    Route::get('/admin/Payments', [AdminPaymentsController::class, 'index']);
    
});
