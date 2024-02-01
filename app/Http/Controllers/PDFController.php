<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PDFController extends Controller
{
    
    public function generatePDF($trackingNumber, $name)
    {
        // Step 1: Request Token
        $tokenResponse = Http::post('http://41.59.227.219:8087/BaruaAuthentication', [
            'name' => $name,
            'tracking_number' => $trackingNumber,
            'secret_key' => 'HszM7ncDpozchdgnZyqg9KDtN86kdNWQ',
        ]);

        // Check if the token request was successful
        if ($tokenResponse->successful()) {
            $token = $tokenResponse->json('token');

            // Step 3: Request PDF with Token
            $pdfResponse = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
                ->get('http://41.59.227.219:8087/barua/' . $trackingNumber);

            // Check if the PDF request was successful
            if ($pdfResponse->successful()) {
                // Return the PDF content or perform any further actions
                return $pdfResponse->body();
            }
        }

        // Handle token or PDF request failure
        return response()->json(['error' => 'Failed to generate PDF'], 500);
    }
}
