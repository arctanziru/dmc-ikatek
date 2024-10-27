<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\DisasterProgram;
use App\Models\DisasterProgramCategory;
use App\Models\Disaster;
use Illuminate\Http\Request;

/**
 * @group Disaster Program Management
 *
 * APIs for managing disaster programs
 */
class DisasterProgramController extends Controller
{
    /**
     * Get a list of disaster programs.
     *
     * @queryParam page integer Optional. The page number. Example: 1
     * @queryParam per_page integer Optional. Items per page. Example: 10
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Programs retrieved successfully.",
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Emergency Training",
     *       "description": "Training program for emergency response.",
     *       "category_id": 2,
     *       "disaster_id": 3,
     *       "created_at": "2024-10-20T10:00:00Z",
     *       "updated_at": "2024-10-20T10:00:00Z"
     *     },
     *     ...
     *   ]
     * }
     */
    public function index(Request $request)
    {
        $programs = DisasterProgram::with(['category', 'disaster'])->paginate($request->input('per_page', 10));
        return ResponseHelper::paginated($programs, 'Programs retrieved successfully');
    }

    /**
     * Store a new disaster program.
     *
     * @bodyParam name string required The name of the program. Example: "Health and Safety Training"
     * @bodyParam description string The description of the program. Example: "Safety training for first responders."
     * @bodyParam category_id integer required The ID of the program category. Example: 1
     * @bodyParam disaster_id integer required The ID of the disaster. Example: 3
     *
     * @response 201 scenario="Success" {
     *   "status": "success",
     *   "message": "Program created successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Health and Safety Training",
     *     "description": "Safety training for first responders.",
     *     "category_id": 1,
     *     "disaster_id": 3,
     *     "created_at": "2024-10-20T10:00:00Z",
     *     "updated_at": "2024-10-20T10:00:00Z"
     *   }
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:disaster_program_categories,id',
            'disaster_id' => 'required|exists:disasters,id',
        ]);

        $program = DisasterProgram::create($validated);
        return ResponseHelper::success($program, 'Program created successfully', 201);
    }

    /**
     * Show a specific disaster program.
     *
     * @urlParam id integer required The ID of the program. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Program retrieved successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Health and Safety Training",
     *     "description": "Safety training for first responders.",
     *     "category_id": 1,
     *     "disaster_id": 3,
     *     "created_at": "2024-10-20T10:00:00Z",
     *     "updated_at": "2024-10-20T10:00:00Z"
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Program not found"
     * }
     */
    public function show($id)
    {
        $program = DisasterProgram::with(['category', 'disaster'])->find($id);

        if (!$program) {
            return ResponseHelper::error('Program not found', 404);
        }

        return ResponseHelper::success($program, 'Program retrieved successfully');
    }

    /**
     * Update a specific disaster program.
     *
     * @urlParam id integer required The ID of the program. Example: 1
     * @bodyParam name string The name of the program. Example: "Updated Program Name"
     * @bodyParam description string The description of the program. Example: "Updated program description."
     * @bodyParam category_id integer The ID of the program category. Example: 1
     * @bodyParam disaster_id integer The ID of the disaster. Example: 3
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Program updated successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Updated Program Name",
     *     "description": "Updated program description.",
     *     "category_id": 1,
     *     "disaster_id": 3,
     *     "created_at": "2024-10-20T10:00:00Z",
     *     "updated_at": "2024-10-20T10:00:00Z"
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Program not found"
     * }
     */
    public function update(Request $request, $id)
    {
        $program = DisasterProgram::find($id);

        if (!$program) {
            return ResponseHelper::error('Program not found', 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:disaster_program_categories,id',
            'disaster_id' => 'sometimes|required|exists:disasters,id',
        ]);

        $program->update($validated);
        return ResponseHelper::success($program, 'Program updated successfully');
    }

    /**
     * Delete a specific disaster program.
     *
     * @urlParam id integer required The ID of the program. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Program deleted successfully."
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Program not found"
     * }
     */
    public function destroy($id)
    {
        $program = DisasterProgram::find($id);

        if (!$program) {
            return ResponseHelper::error('Program not found', 404);
        }

        $program->delete();
        return ResponseHelper::success(null, 'Program deleted successfully');
    }
}
