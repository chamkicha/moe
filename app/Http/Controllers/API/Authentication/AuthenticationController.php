<?php

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailToRegisteredUser;
use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use DB;

class AuthenticationController extends Controller
{

    public function register(Request $request): JsonResponse
    {
        // Log::debug($request);
        try{
          
        DB::beginTransaction();
            
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|confirmed|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $check = User::where('email', '=', $request->input('email'))->first();

        if ($check != null) {

            $response = ['statusCode' => 0, 'message' => 'Barua pepe yako tayari imetumika kwenye mfumo,tafadhali tumia barua pepe nyingine'];
            return response()->json($response, 200);
        }

        $user = User::create([
            'secure_token' => Str::random(40),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $this->basic_email($user);
        DB::commit();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['statusCode' => 1, 'message' => 'Umefanikiwa kujisajili kikamilifu,tafadhali nenda kwenye barua pepe yako kuweza kuakiki', 'data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
       
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'statusCode' => 0,
                'message' => 'Error occurred while logging in.',
                'error' => $error,
            ]);
        }
    
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function login(Request $request): JsonResponse
    {
        //  \Log::info($request->email);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            $this->checkTooManyFailedAttempts();

            if (!Auth::attempt($request->only('email', 'password'))) {
                RateLimiter::hit($this->throttleKey());


                return response()->json([
                    'statusCode' => 401,
                    'message' => 'Unauthorized',
                ]);
            //            return response()
            //                ->json(['statusCode' => 401, 'message' => 'Unauthorized'], 401);
            }

            RateLimiter::clear($this->throttleKey());

            $user = User::where('email', $request['email'])->firstOrFail();

            if ($user->email_verified_at == null) {

                return response()->json(['statusCode' => 401, 'message' => 'Samahani hakiki barua pepe yako ili uweze kuendelea'], 401);
            }

            $incomplete = Application::where('user_id', '=', auth()->user()->id)
                ->where('application_category_id', '=', 1)
                ->where('is_complete', '=', 0)
                ->count('*');

            $token = $user->createToken('auth_token')->plainTextToken;

            if ($incomplete > 0) {

                $response = [
                    'statusCode' => 200,
                    'message' => 'Hi ' . $user->name . ', welcome to SAS APP, Samahani una maombi ' . $incomplete . ' haujakamilisha kuweka viambatanisho tafadhali nenda kwenye orodha yako ya maombi kamilisha au futa kama huna kazi nayo tena maombi hayo ili uweze kuanzisha shule ingine, ahsante',
                    'user' => $user->name,
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ];

                return response()->json($response, 200);
            }

            return response()
                ->json(['statusCode' => 200, 'message' => 'Hi ' . $user->name . ', welcome to SAS APP', 'user' => $user->name, 'access_token' => $token, 'token_type' => 'Bearer',]);
        } catch (Exception $error) {
            return response()->json([
                'statusCode' => 402,
                'message' => 'Error occurred while logging in.',
                'error' => $error,
            ]);
        }
    }

    public function verifyEmail($token): string
    {

        $verify = User::where('secure_token', '=', $token)->first();

        if ($verify == null) {

            return "Account yako aitambuliki";
        }

        $verify->email_verified_at = Carbon::now()->format('Y-m-d H:s:i');
        $verify->save();

        return "Barua pepe yako imethibitishwa kikamilifu, unaweza kurudi kwenye mfumo na kuendelea";
    }

    // method for user logout and delete token
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
        return response()->json($response, 200);
    }

    private function basic_email($user)
    {

        $details = [
            'title' => 'Hakiki Barua pepe yako',
            'body' => 'Samahani unatakiwa kubonyeza kitufe apo chini ili kuthibitisha uwalali wa barua pepe yako',
            'token' => $user->secure_token
        ];

        Mail::to($user->email)->send(new SendEmailToRegisteredUser($details));
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey(): string
    {
        return Str::lower(request('email')) . '|' . request()->ip();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     * @throws Exception
     */
    public function checkTooManyFailedAttempts()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        throw new ValidationException('IP address banned. Too many login attempts.');
    }
}
