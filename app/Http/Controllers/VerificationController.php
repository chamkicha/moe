<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyEmail($user_id, Request $request)
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return redirect(env('FRONT_URL') . '/email/verify/already-success');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect(env('FRONT_URL') . '/email/verify/success');
    }

//    public function resend(): JsonResponse
//    {
//
//        if (auth()->user()->hasVerifiedEmail()) {
//            return response()->json(["msg" => "Email already verified."], 400);
//        }
//
//        auth()->user()->sendEmailVerificationNotification();
//
//        return response()->json(["msg" => "Email verification link sent on your email id"]);
//    }

    public function verifyAccount($token): JsonResponse
    {

        $verify = User::where('secure_token','=',$token)->first();

        if ($verify == null){

            $response = ['message' => 'Account does not exist'];
            return response()->json($response,200);
        }

        $verify->update([
            'email_verified_at' => Carbon::now()->format('Y-m-d H:s:i')
        ]);

        $response = ['message' => 'Email verified successful'];
        return response()->json($response,200);
    }

}
