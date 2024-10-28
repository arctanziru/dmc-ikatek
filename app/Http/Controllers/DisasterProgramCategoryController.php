<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\DisasterProgramCategory;
use Illuminate\Http\Request;

/**
 * @group Disaster Program Category Management
 *
 * APIs for managing disaster program categories
 */
class DisasterProgramCategoryController extends Controller
{
    /**
     * Get a list of disaster program categories.
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Categories retrieved successfully.",
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Disaster Risk Reduction",
     *       "description": "Programs aimed at reducing disaster risk."
     *     },
     *     ...
     *   ]
     * }
     */
    public function index()
    {
        $categories = DisasterProgramCategory::all();
        return ResponseHelper::success($categories, 'Categories retrieved successfully');
    }

    /**
     * Store a new disaster program category.
     *
     * @bodyParam name string required The name of the category. Example: "Health and Safety"
     * @bodyParam description string The description of the category. Example: "Programs focused on health and safety."
     *
     * @response 201 scenario="Success" {
     *   "status": "success",
     *   "message": "Category created successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Health and Safety",
     *     "description": "Programs focused on health and safety."
     *   }
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:disaster_program_categories|max:255',
            'description' => 'nullable|string',
        ]);

        $category = DisasterProgramCategory::create($validated);
        return ResponseHelper::success($category, 'Category created successfully', 201);
    }

    /**
     * Show a specific disaster program category.
     *
     * @urlParam id integer required The ID of the category. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Category retrieved successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Disaster Risk Reduction",
     *     "description": "Programs aimed at reducing disaster risk."
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Category not found"
     * }
     */
    public function show($id)
    {
        $category = DisasterProgramCategory::find($id);

        if (!$category) {
            return ResponseHelper::error('Category not found', 404);
        }

        return ResponseHelper::success($category, 'Category retrieved successfully');
    }

    /**
     * Update a specific disaster program category.
     *
     * @urlParam id integer required The ID of the category. Example: 1
     * @bodyParam name string The name of the category. Example: "Updated Category"
     * @bodyParam description string The description of the category. Example: "Updated description."
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Category updated successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Updated Category",
     *     "description": "Updated description."
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Category not found"
     * }
     */
    public function update(Request $request, $id)
    {
        $category = DisasterProgramCategory::find($id);

        if (!$category) {
            return ResponseHelper::error('Category not found', 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|unique:disaster_program_categories,name,' . $id . '|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);
        return ResponseHelper::success($category, 'Category updated successfully');
    }

    /**
     * Delete a specific disaster program category.
     *
     * @urlParam id integer required The ID of the category. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Category deleted successfully."
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Category not found"
     * }
     */
    public function destroy($id)
    {
        $category = DisasterProgramCategory::find($id);

        if (!$category) {
            return ResponseHelper::error('Category not found', 404);
        }

        $category->delete();
        return ResponseHelper::success(null, 'Category deleted successfully');
    }
}
