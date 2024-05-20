<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthRequest $request){

        $user = (new User())->getUserByEmail($request->all());
        
        if($user && Hash::check($request->input('password'), $user->password)){
            $user_data['token'] = $user->createToken($user->email)->plainTextToken;
            $user_data['name'] = $user->name;
            $user_data['email'] = $user->name;
            $user_data['photo'] = $user->photo;
            $user_data['role_id'] = $user->role_id;

            return response()->json($user_data);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect']
        ]);
        
    }

    public function logout(){

        auth()->user()->tokens()->delete();
        return response()->json(['msg'=>'You have successfully logged out.']);
    }
}
