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
public function getChangerequests(Request $request)
{
    // Validate and get input parameters (name and is_approved)
    $request->validate([
        'name' => 'required',
        'application_category_id' => 'sometimes|integer', // 'sometimes' allows the parameter to be optional
    ]);

    // Get input values
    $name = $request->input('name');
    $ApplicationCategory = $request->input('application_category_id');

    // Find the user based on the name
    $user = User::where('name', $name)->first();

    if ($user) {
        // Start building the query based on user_id
        $query = Application::where('user_id', $user->id);

        // Add additional conditions based on the is_approved value if provided
        if ( $ApplicationCategory !== null && $ApplicationCategory!== '') {
            $query->where('application_category_id',$ApplicationCategory);
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