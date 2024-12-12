<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserAuthController extends Controller
{
    
    public function register(Request $request)
    {
        try {
           
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
    
        // Continue if validation passes
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'fcm_token' => $request->fcm_token
        ]);
    
        // Generate token for the user
        $token = $user->createToken('user_token')->plainTextToken;
    
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Login user
    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            $token = $user->createToken('user_token')->plainTextToken;
            $token = array(
                'fcm_token' => $request->fcm_token
            );

            $user->update($token);
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ],422);
    }

    // Logout user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout successful']);
    }

    // Get authenticated user details
    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }
}
