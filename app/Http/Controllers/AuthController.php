<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Handle user login and return an API token.
     *
     * This method validates the user input, checks if the user exists
     * and if the provided password matches. If the credentials are correct,
     * it generates and returns a plain text API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException If credentials are incorrect.
     */
    public function login(Request $request)
    {
        // Validate the incoming request for email and password.
        $request->validate([
            'email' => 'required|email', // Email field is required and must be a valid email format.
            'password' => 'required',    // Password field is required.
        ]);

        // Retrieve the user by email.
        $user = User::where('email', $request->email)->first();

        // Check if user exists and the provided password matches the stored hash.
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Throw validation exception if credentials are incorrect.
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Generate a plain text token for the user.
        $token = $user->createToken('api-token')->plainTextToken;

        // Return the token in JSON format.
        return response()->json(['token' => $token]);
    }
}
