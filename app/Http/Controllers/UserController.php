<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Retrieve all users from the database.
        $users = User::all();

        // Return the users in JSON format.
        return response()->json($users);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id  The ID of the user to retrieve.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Find the user by their ID.
        $user = User::find($id);

        // If the user is not found, return a 404 error message.
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Return the user in JSON format.
        return response()->json($user);
    }

    /**
     * Store a newly created user in the database.
     *
     * @param  \App\Http\Requests\UserRequest  $request  The validated request data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        // Create a new user using the validated data from the request.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before storing it.
        ]);

        // Return the created user with a 201 status code (Created).
        return response()->json($user, 201);
    }

    /**
     * Update the specified user in the database.
     *
     * @param  \App\Http\Requests\UserRequest  $request  The validated request data.
     * @param  int  $id  The ID of the user to update.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        // Find the user by their ID.
        $user = User::find($id);

        // If the user is not found, return a 404 error message.
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's details if provided in the request.
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password); // Hash the new password.
        }

        // Save the updated user.
        $user->save();

        // Return the updated user in JSON format.
        return response()->json($user);
    }

    /**
     * Remove the specified user from the database.
     *
     * @param  int  $id  The ID of the user to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the user by their ID.
        $user = User::find($id);

        // If the user is not found, return a 404 error message.
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the user from the database.
        $user->delete();

        // Return a success message indicating the user was deleted.
        return response()->json(['message' => 'User deleted successfully']);
    }
}
