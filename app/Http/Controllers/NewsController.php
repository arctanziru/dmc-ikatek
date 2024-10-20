<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * @group News Management
 *
 * APIs for managing news
 */
class NewsController extends Controller
{
  /**
   * Get a list of news articles.
   *
   * @queryParam page integer Optional. The page number. Example: 1
   * @queryParam per_page integer Optional. Items per page. Example: 10
   * @queryParam category_id integer Optional. Filter by category ID. Example: 2
   * @queryParam search string Optional. Search by title or content. Example: "climate"
   *
   * @response 200 scenario="Success" {
   *   "status": "success",
   *   "message": "News retrieved successfully.",
   *   "data": {
   *     "items": [
   *       {
   *         "id": 1,
   *         "title": "Climate News",
   *         "description": "Short description",
   *         "content": "This is the content.",
   *         "author": "John Doe",
   *         "news_category_id": 2,
   *         "created_at": "2024-10-20T10:00:00Z",
   *         "updated_at": "2024-10-20T10:00:00Z"
   *       }
   *     ],
   *     "pagination": {
   *       "total": 50,
   *       "count": 10,
   *       "per_page": 10,
   *       "current_page": 1,
   *       "total_pages": 5
   *     }
   *   }
   * }
   */
  public function index(Request $request)
  {
    $page = $request->query('page', 1);
    $perPage = $request->query('per_page', 10);
    $search = $request->query('search');
    $categoryId = $request->query('category_id');

    $query = News::query();

    if ($search) {
      $query->where(function ($q) use ($search) {
        $q->where('title', 'like', "%$search%")
          ->orWhere('content', 'like', "%$search%");
      });
    }

    if ($categoryId) {
      $query->where('category_id', $categoryId);
    }

    $news = $query->paginate($perPage, ['*'], 'page', $page);

    if ($news->isEmpty() && $page > 1) {
      return ResponseHelper::error('Page not found.', 404);
    }

    return ResponseHelper::paginated($news, 'News retrieved successfully.');
  }

  /**
   * Show the specified news article.
   *
   * @urlParam id integer required The ID of the news article. Example: 1
   *
   * @response 200 scenario="Success" {
   *   "status": "success",
   *   "message": "News retrieved successfully.",
   *   "data": {
   *     "id": 1,
   *     "title": "Climate News",
   *     "description": "Short description",
   *     "content": "This is the content.",
   *     "author": "John Doe",
   *     "news_category_id": 2,
   *     "created_at": "2024-10-20T10:00:00Z",
   *     "updated_at": "2024-10-20T10:00:00Z"
   *   }
   * }
   * @response 404 scenario="Not Found" {
   *   "status": "error",
   *   "message": "News not found"
   * }
   */
  public function show($id)
  {
    $news = News::find($id);

    if (!$news) {
      return ResponseHelper::error('News not found', 404);
    }

    return ResponseHelper::success($news, 'News retrieved successfully.');
  }

  /**
   * Store a newly created news article in storage.
   *
   * @bodyParam title string required The title of the news article. Example: "New Climate Policy"
   * @bodyParam image string The URL of the image. Example: "http://example.com/image.jpg"
   * @bodyParam description string A short description of the news article. Example: "This is a short description."
   * @bodyParam content string required The content of the news article. Example: "This is the content of the news article."
   * @bodyParam author string The author of the news article. Example: "Jane Doe"
   * @bodyParam category_id integer required The ID of the category. Example: 2
   *
   * @response 201 scenario="Success" {
   *   "status": "success",
   *   "message": "News created successfully.",
   *   "data": {
   *     "id": 1,
   *     "title": "New Climate Policy",
   *     "image": "http://example.com/image.jpg",
   *     "description": "This is a short description.",
   *     "content": "This is the content of the news article.",
   *     "author": "Jane Doe",
   *     "category_id": 2,
   *     "created_at": "2024-10-20T10:00:00Z",
   *     "updated_at": "2024-10-20T10:00:00Z"
   *   }
   * }
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'image' => 'nullable|string',
      'description' => 'nullable|string',
      'content' => 'required|string',
      'author' => 'nullable|string|max:255',
      'category_id' => 'required|integer|exists:categories,id',
    ]);

    $news = News::create($validated);

    return ResponseHelper::success($news, 'News created successfully.', 201);
  }

  /**
   * Update the specified news article in storage.
   *
   * @urlParam id integer required The ID of the news article. Example: 1
   * @bodyParam title string The title of the news article. Example: "Updated Climate Policy"
   * @bodyParam image string The URL of the image. Example: "http://example.com/image.jpg"
   * @bodyParam description string A short description of the news article. Example: "This is an updated short description."
   * @bodyParam content string The content of the news article. Example: "This is the updated content of the news article."
   * @bodyParam author string The author of the news article. Example: "Jane Doe"
   * @bodyParam category_id integer The ID of the category. Example: 2
   *
   * @response 200 scenario="Success" {
   *   "status": "success",
   *   "message": "News updated successfully.",
   *   "data": {
   *     "id": 1,
   *     "title": "Updated Climate Policy",
   *     "image": "http://example.com/image.jpg",
   *     "description": "This is an updated short description.",
   *     "content": "This is the updated content of the news article.",
   *     "author": "Jane Doe",
   *     "category_id": 2,
   *     "created_at": "2024-10-20T10:00:00Z",
   *     "updated_at": "2024-10-20T10:00:00Z"
   *   }
   * }
   * @response 404 scenario="Not Found" {
   *   "status": "error",
   *   "message": "News not found"
   * }
   */
  public function update(Request $request, $id)
  {
    $news = News::find($id);

    if (!$news) {
      return ResponseHelper::error('News not found', 404);
    }

    $validated = $request->validate([
      'title' => 'sometimes|required|string|max:255',
      'image' => 'nullable|string',
      'description' => 'nullable|string',
      'content' => 'sometimes|required|string',
      'author' => 'nullable|string|max:255',
      'category_id' => 'sometimes|required|integer|exists:categories,id',
    ]);

    $news->update($validated);

    return ResponseHelper::success($news, 'News updated successfully.');
  }

  /**
   * Remove the specified news article from storage.
   *
   * @urlParam id integer required The ID of the news article. Example: 1
   *
   * @response 200 scenario="Success" {
   *   "status": "success",
   *   "message": "News deleted successfully."
   * }
   * @response 404 scenario="Not Found" {
   *   "status": "error",
   *   "message": "News not found"
   * }
   */
  public function destroy($id)
  {
    $news = News::find($id);

    if (!$news) {
      return ResponseHelper::error('News not found', 404);
    }

    $news->delete();

    return ResponseHelper::success(null, 'News deleted successfully.');
  }
}
