<?php

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class passwordUpdateController extends Controller
{

    public function updatePassword(Request $request): JsonResponse
    {


        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->current_password, $hashedPassword)) {

            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();

            $response = [
                'statusCode' => 200,
                'message' => 'Congratulations,Your password is successful changed'
            ];
            return response()->json($response, 200);
        }

        $response = [
            'statusCode' => 401,
            'message' => 'Ooooops!,Something went wrong(may be the old password is wrong)'
        ];
        return response()->json($response, 200);
    }
}
