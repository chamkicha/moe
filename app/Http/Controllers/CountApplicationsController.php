<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;

class CountApplicationsController extends Controller
{
    public function getCountOfApplications(Request $request)
{
    // Validate and get input parameters (name and is_approved)
    $request->validate([
        'name' => 'required',
        'is_approved' => 'sometimes|integer', // 'sometimes' allows the parameter to be optional
    ]);

    // Get input values
    $name = $request->input('name');
    $isApproved = $request->input('is_approved');

    // Find the user based on the name
    $user = User::where('name', $name)->first();

    if ($user) {
        // Start building the query based on user_id
        $query = Application::where('user_id', $user->id);

        // Add additional conditions based on the is_approved value if provided
        if ($isApproved !== null && $isApproved !== '') {
            $query->where('is_approved', $isApproved);
        }

        // Retrieve the count of applications
        $applicationsCount = $query->count();

        // Return the response with the retrieved applications count
        return response()->json(['applications_count' => $applicationsCount]);
    } else {
        // User not found
        return response()->json(['error' => 'User not found'], 404);
    }
}
}