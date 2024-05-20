<?php

use App\Http\Controllers\API\Authentication\AuthenticationController;
use App\Http\Controllers\API\Authentication\forgotPasswordController;
use App\Http\Controllers\API\Establishment\schoolEstablishmentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountApplicationsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\LogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes(['verified']);

Route::get('/', function () {
    return view('welcome');
});


Route::get('email/verification/{token?}',[AuthenticationController::class,'verifyEmail'])->name('email.verification');

Route::get('/login', function () {
    $response = ['message' => 'Unauthorized please login again'];
    return response()->json($response,401);
})->name('login');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return response()->json(['message' => 'Email verified successful']);
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::get('/CountApplications/user-applications-count', [CountApplicationsController::class, 'getCountOfApplications']);


Route::get('/CountApplications/changerequests', [CountApplicationsController::class, 'getChangerequests']);

Route::get('/generate-pdf/{tracking_number}/{type?}', [PDFController::class, 'generatePDF']);


Route::get('/view-log',[LogController::class,'viewLog'])->name('view-log');

