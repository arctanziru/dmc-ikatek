<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Donation;
use Illuminate\Http\Request;

/**
 * @group Donation Management
 *
 * APIs for managing donations
 */
class DonationController extends Controller
{
    /**
     * Get a list of donations for a specific disaster program.
     *
     * Retrieve all donations related to a particular disaster program, with optional filtering by `status` and `donation_date`.
     *
     * @queryParam disaster_program_id integer required The ID of the disaster program. Example: 1
     * @queryParam status string Optional. The status of donations to retrieve. One of "pending", "verified", or "rejected". Example: "verified"
     * @queryParam donation_date date Optional. The specific donation date to filter. Format: Y-m-d. Example: "2024-10-20"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Donations retrieved successfully.",
     *   "data": [
     *     {
     *       "id": 1,
     *       "donor_name": "Jane Doe",
     *       "donor_organization": "Helping Hands",
     *       "donor_email": "jane@example.com",
     *       "amount": 100.00,
     *       "message": "Hope this helps!",
     *       "transfer_evidence": "/storage/evidence/evidence.jpg",
     *       "status": "verified",
     *       "donation_date": "2024-10-20",
     *       "disaster_program_id": 1,
     *       "created_at": "2024-10-20T10:00:00Z"
     *     },
     *     ...
     *   ]
     * }
     */
    public function index(Request $request)
    {
        $request->validate([
            'disaster_program_id' => 'required|exists:disaster_programs,id',
        ]);

        $query = Donation::where('disaster_program_id', $request->input('disaster_program_id'));

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('donation_date')) {
            $query->whereDate('donation_date', $request->input('donation_date'));
        }

        $donations = $query->get();
        return ResponseHelper::success($donations, 'Donations retrieved successfully');
    }

    /**
     * Store a new donation.
     *
     * Create a new donation entry for a specific disaster program, with optional details such as `donor_organization`, `donor_email`, `message`, and `transfer_evidence`.
     *
     * @bodyParam donor_name string required The name of the donor. Example: "Jane Doe"
     * @bodyParam donor_organization string The organization name if applicable. Example: "Helping Hands"
     * @bodyParam donor_email string The email of the donor. Example: "jane@example.com"
     * @bodyParam amount number required The amount of the donation. Example: 100.00
     * @bodyParam message string The message from the donor. Example: "Hope this helps!"
     * @bodyParam transfer_evidence file The transfer evidence (JPEG, PNG, JPG, PDF).
     * @bodyParam status string The donation status. One of "pending", "verified", or "rejected". Example: "pending"
     * @bodyParam donation_date date The date of the donation. Example: "2024-10-20"
     * @bodyParam disaster_program_id integer required The ID of the disaster program. Example: 1
     *
     * @response 201 scenario="Success" {
     *   "status": "success",
     *   "message": "Donation created successfully.",
     *   "data": {
     *     "id": 1,
     *     "donor_name": "Jane Doe",
     *     "donor_organization": "Helping Hands",
     *     "donor_email": "jane@example.com",
     *     "amount": 100.00,
     *     "message": "Hope this helps!",
     *     "transfer_evidence": "http://example.com/image.jpg",
     *     "status": "pending",
     *     "donation_date": "2024-10-20",
     *     "disaster_program_id": 1,
     *     "created_at": "2024-10-20T10:00:00Z"
     *   }
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_organization' => 'nullable|string|max:255',
            'donor_email' => 'nullable|email|max:255',
            'amount' => 'required|numeric|min:0',
            'message' => 'nullable|string',
            'transfer_evidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'status' => 'nullable|in:pending,verified,rejected',
            'donation_date' => 'nullable|date',
            'disaster_program_id' => 'required|exists:disaster_programs,id',
        ]);

        if ($request->hasFile('transfer_evidence')) {
            $path = $request->file('transfer_evidence')->store('evidence', 'public');
            $validated['transfer_evidence'] = '/storage/' . $path;
        }

        $donation = Donation::create($validated);
        return ResponseHelper::success($donation, 'Donation created successfully', 201);
    }

    /**
     * Show a specific donation.
     *
     * Retrieve details of a specific donation by its ID.
     *
     * @urlParam id integer required The ID of the donation. Example: 1
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "message": "Donation retrieved successfully.",
     *   "data": {
     *     "id": 1,
     *     "donor_name": "Jane Doe",
     *     "donor_organization": "Helping Hands",
     *     "donor_email": "jane@example.com",
     *     "amount": 100.00,
     *     "message": "Hope this helps!",
     *     "transfer_evidence": "/storage/evidence/evidence.jpg",
     *     "status": "verified",
     *     "donation_date": "2024-10-20",
     *     "disaster_program_id": 1,
     *     "created_at": "2024-10-20T10:00:00Z"
     *   }
     * }
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Donation not found"
     * }
     */
    public function show($id)
    {
        $donation = Donation::find($id);

        if (!$donation) {
            return ResponseHelper::error('Donation not found', 404);
        }

        return ResponseHelper::success($donation, 'Donation retrieved successfully');
    }
}
