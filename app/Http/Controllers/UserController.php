<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        return $user;
    }
       public function login(UserRequest $request)
    {
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        $response = [
            'user'  =>  $user,
            'token' =>  $user->createToken($request->email)->plainTextToken
        ];
     
        return $response;
    }
}
