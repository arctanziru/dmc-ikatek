<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group User management
 *
 * APIs for managing users
 */
class UserController extends Controller
{
  /**
   * Display a listing of users.
   *
   * @queryParam page int The page number. Defaults to 1. Example: 1
   * @queryParam per_page int The number of items per page. Defaults to 10. Example: 10
   * @queryParam search string Search term to filter users by name or email. Example: john
   *
   * @response 200 {
   *   "status": "success",
   *   "message": "Users retrieved successfully.",
   *   "data": {
   *     "items": [
   *       {
   *         "id": 1,
   *         "name": "John Doe",
   *         "email": "john@example.com",
   *         "created_at": "2023-01-01T00:00:00.000000Z",
   *         "updated_at": "2023-01-01T00:00:00.000000Z"
   *       }
   *     ],
   *     "pagination": {
   *       "first": "http://example.com?page=1",
   *       "last": "http://example.com?page=10",
   *       "prev": null,
   *       "next": "http://example.com?page=2",
   *       "current_page": 1,
   *       "from": 1,
   *       "last_page": 10,
   *       "path": "http://example.com",
   *       "per_page": 10,
   *       "to": 10,
   *       "total": 100
   *     }
   *   }
   * }
   * @response 400 {
   *   "status": "error",
   *   "message": "Bad request."
   * }
   * @response 500 {
   *   "status": "error",
   *   "message": "Internal server error."
   * }
   */
  public function index(Request $request)
  {
    $page = $request->query('page', 1);
    $perPage = $request->query('per_page', 10);
    $search = $request->query('search', '');

    $query = User::query();

    if ($search) {
      $query->where(function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%');
      });
    }

    $users = $query->paginate($perPage, ['*'], 'page', $page);

    return ResponseHelper::paginated($users, 'Users retrieved successfully.');
  }

  /**
   * Store a newly created user in storage.
   *
   * @bodyParam name string required The name of the user. Example: John Doe
   * @bodyParam username string required The username of the user. Example: johndoe
   * @bodyParam email string required The email of the user. Example: john@example.com
   * @bodyParam password string required The password of the user. Minimum 6 characters. Example: secret
   * @bodyParam role string The role of the user. Must be one of 'user', 'admin', 'reporter'. Example: user
   *
   * @response 201 {
   *   "status": "success",
   *   "message": "User created successfully.",
   *   "data": {
   *     "id": 1,
   *     "name": "John Doe",
   *     "username": "johndoe",
   *     "email": "john@example.com",
   *     "role": "user",
   *     "created_at": "2023-01-01T00:00:00.000000Z",
   *     "updated_at": "2023-01-01T00:00:00.000000Z"
   *   }
   * }
   * @response 400 {
   *   "status": "error",
   *   "message": "Validation error."
   * }
   * @response 500 {
   *   "status": "error",
   *   "message": "Internal server error."
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required',
      'username' => 'required|unique:users,username',
      'email' => 'required|unique:users,email',
      'password' => 'required|min:6',
      'role' => 'in:user,admin,reporter',
    ]);

    $user = User::create($validated);
    return response()->json($user, 201);
  }

  /**
   * Display the specified user.
   *
   * @urlParam id int required The ID of the user. Example: 1
   *
   * @response 200 {
   *   "status": "success",
   *   "message": "User retrieved successfully.",
   *   "data": {
   *     "id": 1,
   *     "name": "John Doe",
   *     "username": "johndoe",
   *     "email": "john@example.com",
   *     "role": "user",
   *     "created_at": "2023-01-01T00:00:00.000000Z",
   *     "updated_at": "2023-01-01T00:00:00.000000Z"
   *   }
   * }
   * @response 404 {
   *   "status": "error",
   *   "message": "User not found."
   * }
   * @response 500 {
   *   "status": "error",
   *   "message": "Internal server error."
   * }
   */
  public function show($id)
  {
    return User::findOrFail($id);
  }

  /**
   * Update the specified user in storage.
   *
   * @urlParam id int required The ID of the user. Example: 1
   * @bodyParam name string The name of the user. Example: John Doe
   * @bodyParam username string The username of the user. Example: johndoe
   * @bodyParam email string The email of the user. Example: john@example.com
   * @bodyParam password string The password of the user. Minimum 6 characters. Example: secret
   * @bodyParam role string The role of the user. Must be one of 'user', 'admin', 'reporter'. Example: user
   *
   * @response 200 {
   *   "status": "success",
   *   "message": "User updated successfully.",
   *   "data": {
   *     "id": 1,
   *     "name": "John Doe",
   *     "username": "johndoe",
   *     "email": "john@example.com",
   *     "role": "user",
   *     "created_at": "2023-01-01T00:00:00.000000Z",
   *     "updated_at": "2023-01-01T00:00:00.000000Z"
   *   }
   * }
   * @response 400 {
   *   "status": "error",
   *   "message": "Validation error."
   * }
   * @response 404 {
   *   "status": "error",
   *   "message": "User not found."
   * }
   * @response 500 {
   *   "status": "error",
   *   "message": "Internal server error."
   */
  public function update(Request $request, $id)
  {
    $user = User::findOrFail($id);

    $validated = $request->validate([
      'name' => 'sometimes|required',
      'username' => 'sometimes|required|unique:users,username,' . $id,
      'email' => 'sometimes|required|unique:users,email,' . $id,
      'password' => 'sometimes|min:6',
      'role' => 'in:user,admin,reporter',
    ]);

    $user->update($validated);
    return response()->json($user);
  }

  /**
   * Remove the specified user from storage.
   *
   * @urlParam id int required The ID of the user. Example: 1
   *
   * @response 204 {
   *   "status": "success",
   *   "message": "User deleted successfully."
   * }
   * @response 404 {
   *   "status": "error",
   *   "message": "User not found."
   * }
   * @response 500 {
   *   "status": "error",
   *   "message": "Internal server error."
   */
  public function destroy($id)
  {
    $user = User::findOrFail($id);
    $user->delete();
    return response()->json(null, 204);
  }
}
