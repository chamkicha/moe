<?php

use App\Http\Controllers\API\Authentication\AuthenticationController;
use App\Http\Controllers\API\Authentication\forgotPasswordController;
use App\Http\Controllers\API\Authentication\passwordUpdateController;
use App\Http\Controllers\API\Authentication\resetPasswordController;
use App\Http\Controllers\API\ChangeRequest\changeRequestController;
use App\Http\Controllers\API\Establishment\governmentSchoolEstablishmentController;
use App\Http\Controllers\API\Establishment\schoolEstablishmentController;
use App\Http\Controllers\API\MetaData\MetaDataController;
use App\Http\Controllers\API\OwnerAndManager\OwnerAndManagerController;
use App\Http\Controllers\API\schoolRegistration\schoolRegistrationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('user/registration', [AuthenticationController::class,'register']);
Route::post('login', [AuthenticationController::class,'login']);

//Route::post('password/forgot-password', [ForgotPasswordController::class, 'sendResetLinkResponse'])->name('passwords.sent');
//Route::post('password/reset', [ResetPasswordController::class, 'sendResetResponse'])->name('password.reset');

Route::post('forget/password',[forgotPasswordController::class,'sendResetLinkResponse'])->name('forget.password');
Route::post('reset/password',[forgotPasswordController::class,'sendResetResponse'])->name('reset.password');

Route::controller(MetaDataController::class)->group(function (){
    Route::get('regions','regions');
    Route::get('districts/{RegionCode?}','districts');
    Route::get('wards/{LgaCode?}','wards');
    Route::get('streets/{wardCode?}','streets');
    Route::get('identity-types','identity');
    Route::get('curricula','curricula');
    Route::get('certificate/{id?}','certificate');
    Route::get('sect','sect');
    Route::get('building-structure','buildingStructure');
    Route::get('school-category','schoolCategory');
    Route::get('school-subcategory','SchoolSubCategory');
    Route::get('application-category','applicationCategory');
    Route::get('application-status','applicationStatus');
    Route::get('registration-structure','registrationStructure');
    Route::get('class-rooms','classRooms');
    Route::get('building-types','buildingTypes');
    Route::get('registry-types','registryTypes');
    Route::get('schoolGender-types','schoolGenderTypes');
    Route::get('languages','languages');
    Route::get('school-specialization','schoolSpecialization');
    // Route::get('institute-attachments/{id?}','instituteAttachments');
    Route::get('institute-attachments/{registry_type_id}/{registration_structure_id?}','instituteAttachments');
    Route::get('attachments/types/{id?}','attachmentsTypes');

    Route::get('ownership_types','ownership_types');
    Route::get('ownership_sub_types/{id?}','ownership_sub_types');
    Route::get('denominations/{id?}','denominations');
    
    Route::post('add/institute-attachments','addInstituteAttachments');
    Route::post('add/attachments','addAttachments');

});

Route::middleware('auth:sanctum')->group( function () {
    Route::get('user',function (Request $request){
        return $request->user();
    });

    Route::post('logout', [AuthenticationController::class,'logout']);

    Route::controller(schoolEstablishmentController::class)->group(function (){
        Route::post('payment/callback','paymentCallBack');
        Route::post('bill/payment/callback','billCallBack');
        Route::post('school-establishment/submit','establishSchool');
        Route::post('school-establishment/attachments','sendAttachments');
        Route::get('applications','showApplications');
        Route::get('applicationsGvt','showApplicationsGvt');
        Route::get('applications/owner-and-manager','showOwnerAndManagerApplications');
        Route::get('applications/registration','showRegistrationApplications');
        Route::get('application/{tracking_number?}/details','showApplicationDetails');
        Route::get('application/owner-and-manager/{tracking_number?}/details','showOwnerAndManagerDetails');
        Route::get('application/school-registration/{tracking_number?}/details','showSchoolRegistrationDetails');
        Route::get('get/attachment-type/{id}/{registry_type_id}/{tracking_number}','attachmentType');
        Route::get('delete/application/{tracking_number?}','deleteApplication');

        Route::controller(passwordUpdateController::class)->group(function (){
            Route::post('update/password','updatePassword');
        });
    });

    Route::controller(OwnerAndManagerController::class)->group(function (){
        Route::post('ownership/application','ownerApplication');
        Route::post('validating/application/tracking_number','checkTheOlderApplicationBeforeOwnership');

        Route::get('schools','getSchoolApprovedFromTwoStages');
        Route::get('schools-for-ownership-application','getSchoolApprovedFromOneStages');
    });

    Route::controller(schoolRegistrationController::class)->group(function () {
        Route::post('school/registration/submit', 'registerSchool');
        Route::get('get/school/certificate/provisions/{id?}', 'certificateTypesPerSchool');
        Route::get('get/certificate/specialisations/{id?}', 'specialisation');
        Route::get('get/specialisation/combinations', 'combinations');
        Route::get('registered/schools', 'registeredSchools');
    });

    Route::controller(governmentSchoolEstablishmentController::class)->group(function () {
        Route::post('school-establishment/government/submit', 'governmentEstablishment');
    });

    Route::controller(changeRequestController::class)->group(function () {
        Route::post('change-request/submit', 'sendChangeRequest');
        Route::get('show/change-requests', 'showChangeRequestApplications');
        Route::get('change-request/{tracking_number?}/details', 'changeRequestDetails');
    });

});
