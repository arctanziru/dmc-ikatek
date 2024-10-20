<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

/**
 * @group News Categories
 * 
 * APIs for managing news categories
 */
class NewsCategoryController extends Controller
{
    /**
     * Get a list of news categories.
     *
     * @queryParam search string Search term. Example: technology
     * @queryParam page integer Page number. Example: 1
     * @queryParam per_page integer Items per page. Example: 10
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Technology",
     *       "created_at": "2023-01-01T00:00:00.000000Z",
     *       "updated_at": "2023-01-01T00:00:00.000000Z"
     *     }
     *   ],
     *   "links": {
     *     "first": "http://example.com/news-categories?page=1",
     *     "last": "http://example.com/news-categories?page=1",
     *     "prev": null,
     *     "next": null
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "path": "http://example.com/news-categories",
     *     "per_page": 10,
     *     "to": 1,
     *     "total": 1
     *   }
     * }
     */
    public function index(Request $request)
    {
        $search = $request->query("search");
        $page = $request->query("page", 1);
        $perPage = $request->query("per_page", 10);

        $query = NewsCategory::query();

        if ($search) {
            $query->where("title", "like", "%" . $search . "%");
        }

        $newsCategory = $query->paginate($perPage, ['*'], 'page', $page);

        return ResponseHelper::paginated($newsCategory, 'News Categories retrieved successfully.');
    }

    /**
     * Get all news categories.
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "News Categories retrieved successfully.",
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Technology",
     *       "created_at": "2023-01-01T00:00:00.000000Z",
     *       "updated_at": "2023-01-01T00:00:00.000000Z"
     *     }
     *   ]
     * }
     */
    public function all(Request $request)
    {
        $newsCategory = NewsCategory::all();
        return ResponseHelper::success($newsCategory, 'News Categories retrieved successfully.');
    }

    /**
     * Create a new news category.
     *
     * @bodyParam name string required The name of the news category. Example: Technology
     *
     * @response 201 {
     *   "status": "success",
     *   "message": "News Category created successfully."
     * }
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);
        NewsCategory::create($request->all());
        return ResponseHelper::success('News Category created successfully.', 201);
    }

    /**
     * Get a specific news category.
     *
     * @urlParam id integer required The ID of the news category. Example: 1
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "News Category retrieved successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Technology",
     *     "created_at": "2023-01-01T00:00:00.000000Z",
     *     "updated_at": "2023-01-01T00:00:00.000000Z"
     *   }
     * }
     * @response 404 {
     *   "status": "error",
     *   "message": "News Category not found."
     * }
     */
    public function show($id)
    {
        $newsCategory = NewsCategory::find($id);
        if (!$newsCategory) {
            return ResponseHelper::error('News Category not found.', 404);
        }
        return ResponseHelper::success($newsCategory, 'News Category retrieved successfully.');
    }

    /**
     * Update a specific news category.
     *
     * @urlParam id integer required The ID of the news category. Example: 1
     * @bodyParam name string required The name of the news category. Example: Technology
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "News Category updated successfully."
     * }
     * @response 404 {
     *   "status": "error",
     *   "message": "News Category not found."
     * }
     */
    public function update(Request $request, $id)
    {
        $newsCategory = NewsCategory::find($id);
        if (!$newsCategory) {
            return ResponseHelper::error('News Category not found.', 404);
        }
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);
        $newsCategory->update($request->all());
        return ResponseHelper::success('News Category updated successfully.');
    }

    /**
     * Remove the specified news category from storage.
     *
     * @urlParam id integer required The ID of the news category. Example: 1
     *
     * @response 200 {
     *   "status": "success",
     *   "message": "News Category deleted successfully."
     * }
     * @response 404 {
     *   "status": "error",
     *   "message": "News Category not found."
     * }
     */
    public function destroy($id)
    {
        $newsCategory = NewsCategory::find($id);
        if (!$newsCategory) {
            return ResponseHelper::error('News Category not found.', 404);
        }
        $newsCategory->delete();
        return ResponseHelper::success('News Category deleted successfully.');
    }
}
