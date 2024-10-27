<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Disaster;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\District;

/**
 * @group Disaster Management
 *
 * APIs for managing disasters
 */
class DisasterController extends Controller
{
    /**
     * Get a list of disasters.
     *
     * @queryParam page integer Optional. The page number. Example: 1
     * @queryParam per_page integer Optional. Items per page. Example: 10
     * @queryParam district_id integer Optional. Filter by district ID. Example: 2
     * @queryParam city_id integer Optional. Filter by city ID. Example: 3
     * @queryParam province_id integer Optional. Filter by province ID. Example: 1
     * @queryParam search string Optional. Search by name or description. Example: "earthquake"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Disasters retrieved successfully.",
     *   "data": {
     *     "items": [
     *       {
     *         "id": 1,
     *         "name": "Earthquake",
     *         "description": "A major earthquake",
     *         "latitude": -6.2088,
     *         "longitude": 106.8456,
     *         "district_id": 2,
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
        $query = Disaster::query()->with(['district.city.province']);

        if ($request->has('district_id') && $request->input('district_id')) {
            $query->where('district_id', $request->input('district_id'));
        }

        // Filter by city
        if ($request->has('city_id') && $request->input('city_id')) {
            $query->whereHas('district.city', function ($q) use ($request) {
                $q->where('id', $request->input('city_id'));
            });
        }

        // Filter by province
        if ($request->has('province_id') && $request->input('province_id')) {
            $query->whereHas('district.city.province', function ($q) use ($request) {
                $q->where('id', $request->input('province_id'));
            });
        }

        if ($request->has('search') && $request->input('search')) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }

        $perPage = $request->input('per_page', 10);
        $currentPage = $request->input('page', 1);

        $disasters = $query->paginate($perPage, ['*'], 'page', $currentPage);

        return ResponseHelper::paginated($disasters, 'Disasters retrieved successfully.');
    }

    /**
     * Show a specific disaster.
     *
     * @urlParam id integer required The ID of the disaster. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Disaster retrieved successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Earthquake",
     *     "description": "A major earthquake",
     *     "latitude": -6.2088,
     *     "longitude": 106.8456,
     *     "district_id": 2,
     *     "created_at": "2024-10-20T10:00:00Z",
     *     "updated_at": "2024-10-20T10:00:00Z"
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Disaster not found"
     * }
     */
    public function show($id)
    {
        $disaster = Disaster::find($id);

        if (!$disaster) {
            return ResponseHelper::error('Disaster not found', 404);
        }

        return ResponseHelper::success($disaster, 'Disaster retrieved successfully.');
    }

    /**
     * Store a newly created disaster.
     *
     * @bodyParam name string required The name of the disaster. Example: "Earthquake"
     * @bodyParam description string The description of the disaster. Example: "A severe earthquake"
     * @bodyParam latitude numeric The latitude of the disaster location. Example: -6.2088
     * @bodyParam longitude numeric The longitude of the disaster location. Example: 106.8456
     * @bodyParam district_id integer required The ID of the district. Example: 2
     *
     * @response 201 scenario="Success" {
     *   "status": "success",
     *   "message": "Disaster created successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Earthquake",
     *     "description": "A severe earthquake",
     *     "latitude": -6.2088,
     *     "longitude": 106.8456,
     *     "district_id": 2,
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
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'district_id' => 'required|exists:districts,id',
        ]);

        $disaster = Disaster::create($validated);

        return ResponseHelper::success($disaster, 'Disaster created successfully.', 201);
    }

    /**
     * Update a specific disaster.
     *
     * @urlParam id integer required The ID of the disaster. Example: 1
     * @bodyParam name string The name of the disaster. Example: "Updated Earthquake"
     * @bodyParam description string The description of the disaster. Example: "An updated description"
     * @bodyParam latitude numeric The latitude of the disaster location. Example: -6.2088
     * @bodyParam longitude numeric The longitude of the disaster location. Example: 106.8456
     * @bodyParam district_id integer The ID of the district. Example: 2
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Disaster updated successfully.",
     *   "data": {
     *     "id": 1,
     *     "name": "Updated Earthquake",
     *     "description": "An updated description",
     *     "latitude": -6.2088,
     *     "longitude": 106.8456,
     *     "district_id": 2,
     *     "created_at": "2024-10-20T10:00:00Z",
     *     "updated_at": "2024-10-20T10:00:00Z"
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Disaster not found"
     * }
     */
    public function update(Request $request, $id)
    {
        $disaster = Disaster::find($id);

        if (!$disaster) {
            return ResponseHelper::error('Disaster not found', 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'district_id' => 'sometimes|required|exists:districts,id',
        ]);

        $disaster->update($validated);

        return ResponseHelper::success($disaster, 'Disaster updated successfully.');
    }

    /**
     * Delete a specific disaster.
     *
     * @urlParam id integer required The ID of the disaster. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Disaster deleted successfully."
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Disaster not found"
     * }
     */
    public function destroy($id)
    {
        $disaster = Disaster::find($id);

        if (!$disaster) {
            return ResponseHelper::error('Disaster not found', 404);
        }

        $disaster->delete();

        return ResponseHelper::success(null, 'Disaster deleted successfully.');
    }
}
