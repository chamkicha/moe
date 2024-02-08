<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PDFController extends Controller
{

    public function generatePDF($trackingNumber)
    {
        try {
            // Step 1: Request Token
            $base_url = config('app.barua_base_url');
            $tokenResponse = Http::post($base_url . '/BaruaAuthentication', [
                'name' => "james",
                'tracking_number' => $trackingNumber,
                'secret_key' => config('app.barua_secret_key'),
            ]);
    
            $responseToken = json_decode($tokenResponse, true);
            if ($responseToken && $responseToken['success']) {
                $token = $tokenResponse->json('token');
    
                // Set up cURL
                $ch = curl_init($base_url . "/barua/" . $trackingNumber);
    
                // Set cURL options
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['token' => $token]));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Accept: application/json',
                ]);
    
                // Execute cURL
                $pdfContent = curl_exec($ch);
    
                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'cURL Error: ' . curl_error($ch);
                    // Handle the error appropriately
                }
    
                // Close cURL
                curl_close($ch);
    
                // Return the PDF as a response
                return response($pdfContent)
                ->header('Access-Control-Allow-Origin', '*')
              
                    ->header('Content-Type', 'application/pdf');
                    // ->header('Content-Disposition', 'inline; filename="' . $trackingNumber . '.pdf"');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'An error occurred',
                'message' => $th->getMessage(),
                'status_code' => 500,
            ], 500);
        }
    }
}
