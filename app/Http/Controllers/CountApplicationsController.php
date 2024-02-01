<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CountApplicationsController extends Controller
{
    public function getUserApplicationsCount(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        // Extract user_id from the request
        $userId = $request->input('user_id');
        $isAproved=$request->input('is_approved');

        // Retrieve the count from the database
        $userApplicationsCount = DB::table('applications')
        ->where('user_id', $userId)
        ->where('is_approved', $isAproved)
        ->count();

        // Return the count as JSON
        return response()->json(['user_applications_count' => $userApplicationsCount]);
    }
  
    
}
