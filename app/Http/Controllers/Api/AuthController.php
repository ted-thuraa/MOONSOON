<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\SignupEmailVerifcation;
use App\Models\Page;
use App\Models\Pageanalytics;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * login.
     */
    public function login(LoginRequest $request)
    {
        try {
            /* @var \App\Models\User $user */
            $credentials = $request->validated();

    
            $remember = $credentials['remember'] ?? false;
            unset($credentials['remember']);
            if (!Auth::attempt($credentials, $remember)) {
                return response([
                    'error' => 'the provided credentials are incorrect'
                ], 422);
            }
            $user = Auth::user();
            $token = $user->createToken('main')->plainTextToken;
            return response([
                'user' => $user,
                'token' => $token
            ]);
           

        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage()
            ], 422);
            
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        try {
            $mailCode = sha1(time());
            $data = [
                'name' => $request->name,
                'emailverification_code' => $mailCode,
                
            ];
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                //'image' => 'creatorpageassets/user-placeholder.png',
                'password' => Hash::make($request->password),
                'emailverification_code' => $mailCode,
            ]);
    
            if ($user != null) {
               
                $token = $user->createToken('main')->plainTextToken;
                return response([
                    'user' => $user,
                    'token' => $token
                ], 200);
                //return response(['message' =>'Verification code sent', 'email' => $user->email], 200);
            } else {
                return response()->json(['user not created'], 400);
            }
    
            
           
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

       
    }
    

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(User $user)
    {
        /* @var User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response([
            'success' => true
        ]);
    }
}
