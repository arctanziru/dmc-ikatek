<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group  Authentication
 *
 * APIs for managing authentication
 */
class AuthController extends Controller
{
    /**
     * Login User
     *
     * Authenticate the user and return an access token.
     *
     * @bodyParam email string required The user's email. Example: john@example.com
     * @bodyParam password string required The user's password. Example: password123
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "Login success",
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "john@example.com",
     *       "username": "johndoe",
     *       "role": "user"
     *     },
     *     "token": "your_generated_token_here"
     *   }
     * }
     * @response 401 {
     *   "status": "error",
     *   "message": "Invalid credentials"
     * }
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        if (!Auth::attempt($credentials)) {
            return ResponseHelper::error('Invalid credentials', 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token,
        ];

        return ResponseHelper::success($data, 'Login success');
    }

    /**
     * Logout User
     *
     * Revoke the user's access token and log them out.
     *
     * @authenticated
     * @header Authorization Bearer your_generated_token_here
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "Logout success",
     *   "data": []
     * }
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return ResponseHelper::success([], 'Logout successful');
    }

    /**
     * Get Authenticated User
     *
     * Retrieve the authenticated user's details.
     *
     * @authenticated
     * @header Authorization Bearer your_generated_token_here
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "User retrieved successfully",
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "john@example.com",
     *       "username": "johndoe",
     *       "role": "user"
     *     },
     *     "token": "your_generated_token_here"
     *   }
     * }
     */
    public function me(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        $data = [
            'user' => $user,
            'token' => $token,
        ];

        return ResponseHelper::success($data, 'User retrieved successfully');
    }
}
