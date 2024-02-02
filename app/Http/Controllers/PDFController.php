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
            // Check if this tracking number belong to this user
            // $user = auth();
            $name  = 'dhadahdha' ;//$user->name;
            // $myApplication = Application::where('tracking_number' , $trackingNumber)->where('user_id' , $user->id)->first();
            // if($myApplication){
            //     // send request to api
            // }else{
            //     return response()->json([
            //         'message' => 'Not Found'
            //     ]);
            // }
            // Step 1: Request Token
            $base_url = config('app.barua_base_url');
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
                return $response;
            }else{
                return $responseToken;
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
