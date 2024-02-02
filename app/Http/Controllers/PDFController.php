<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PDFController extends Controller
{

    public function generatePDF($trackingNumber, $name)
    {
        try {
            // Step 1: Request Token
            $base_url = "http://localhost:8087";
            $tokenResponse = Http::post($base_url . '/BaruaAuthentication', [
                'name' => $name,
                'tracking_number' => $trackingNumber,
                'secret_key' => config('app.barua_secret_key'),
            ]);
            $responseToken = json_decode($tokenResponse, true);
            if ($responseToken && $responseToken['success']) {
                $token = $tokenResponse->json('token');
                // Set up cURL
                $ch = curl_init($base_url . "/barua/" . $trackingNumber);

                // Set cURL options
                curl_setopt($ch,
                    CURLOPT_RETURNTRANSFER,
                    true
                );
                curl_setopt($ch,
                    CURLOPT_CUSTOMREQUEST,
                    'GET'
                );
                curl_setopt($ch,
                    CURLOPT_POSTFIELDS,
                    json_encode(['token' => $token])
                );
                curl_setopt($ch,
                    CURLOPT_HTTPHEADER,
                    [
                        'Content-Type: application/json',
                        'Accept: application/json',
                    ]
                );

                // Execute cURL
                $response = curl_exec($ch);
                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'cURL Error: ' . curl_error($ch);
                }
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="'.$trackingNumber.'.pdf"');
                header('Cache-Control: private, max-age=0, must-revalidate');
                header('Pragma: public');
                // Close cURL
                curl_close($ch);
                echo $response;
            }else{
                return $responseToken;
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
