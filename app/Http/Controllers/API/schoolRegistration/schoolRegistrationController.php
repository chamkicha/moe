<?php

namespace App\Http\Controllers\API\schoolRegistration;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Certificate_type;
use App\Models\Combination;
use App\Models\Establishing_school;
use App\Models\School_category;
use App\Models\School_registry;
use App\Models\School_specialization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class schoolRegistrationController extends Controller
{
    public function registerSchool(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'school' => 'required|integer',
            'stream' => 'required|integer',
            'school_address' => 'required|string',
            'po_box' => 'required|string',
            'application_category' => 'required|integer',
            'school_opening_date' => 'required|date',
            'level_of_education' => 'required|integer',
            'is_seminary' => 'required|integer',
            'number_of_students' => 'required|integer',
            'number_of_teachers' => 'required|integer',
            'teacher_information' => 'required',
            'certificate_type' => 'required|integer',
            'school_gender' => 'required|integer',
            'disabled' => 'required',
//            'school_specialisation' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }


        $school = Establishing_school::find($request->input('school'));

        $applicant = Application::where('tracking_number', '=', $school->tracking_number)->first();

        $school->update([
            'stream' => $request->input('stream'),
            'website' => $request->input('website'),
            'school_address' => $request->input('school_address'),
            'po_box' => $request->input('po_box'),
            'level_of_education' => $request->input('level_of_education'),
            'number_of_students' => $request->input('number_of_students'),
            'number_of_teachers' => $request->input('number_of_teachers'),
            'teacher_information' => $request->input('teacher_information'),
            'certificate_type_id' => $request->input('certificate_type'),
            'school_gender_type_id' => $request->input('school_gender'),
            'is_for_disabled' => $request->input('disabled'),
            'stage' => 3
        ]);

        $registration_data = [
            'secure_token' => Str::random(40),
            'school_opening_date' => $request->input('school_opening_date'),
            'level_of_education' => $request->input('level_of_education'),
            'is_seminary' => $request->input('is_seminary'),
        ];

        $register = $school->school()->updateOrCreate($registration_data);

        if (count($request->input('school_specialisation')) > 0){

            foreach ($request->input('school_specialisation') as $specialisation){

                $specialization_data = [
                    'school_specialization_id' => $specialisation
                ];

                $register->detours()->updateOrCreate($specialization_data);
            }
        }

        if (count($request->input('combinations')) > 0){

            foreach ($request->input('combinations') as $combination){

                $comb_data = [
                    'combination_id' => $combination
                ];
                $register->combination()->updateOrCreate($comb_data);
            }
        }

        $application = Application::create([
            'secure_token' => Str::random(40),
            'foreign_token' => $applicant->foreign_token,
            'tracking_number' => generateTrackingNumber($school->school_category_id),
            'user_id' => auth()->user()->id,
            'registry_type_id' => $applicant->registry_type_id,
            'application_category_id' => $request->input('application_category'),
            'folio' => $school->max_folio + 1
        ]);

        $school->update([
            'max_folio' => $application->folio
        ]);

        $register->update([
            'tracking_number' => $application->tracking_number,
        ]);

        $response = ['message' => 'Ombi la kusajili shule limetumwa kikamilifu'];
        return response()->json($response, 200);

    }

    public function certificateTypesPerSchool($id): JsonResponse
    {

        $school = Establishing_school::find($id);

        $certificate = Certificate_type::where('school_category_id', '=', $school->school_category_id)->get();

        $response = ['certificate' => $certificate];

        return response()->json($response, 200);

    }

    public function specialisation($id): JsonResponse
    {

        $specialisations = School_specialization::where('certificate_type_id', '=', $id)->get();

        $response = ['specialisations' => $specialisations];

        return response()->json($response, 200);
    }

    public function combinations(Request $request): JsonResponse
    {

        $array = $request->input('combinations');

        $combinations = Combination::whereIn('school_specialization_id', $array)->get();

        $response = ['combinations' => $combinations];
        return response()->json($response, 200);
    }

    public function registeredSchools(): JsonResponse
    {

        $registered_schools = Establishing_school::join('school_registrations', 'establishing_schools.id', '=', 'school_registrations.establishing_school_id')
            ->join('applications', 'school_registrations.tracking_number', '=', 'applications.tracking_number')
            ->with([
                'ward.district.region',
                'category' => function($query){
                $query->select('id','category');
                },
                'subcategory' => function($query){
                    $query->select('id','subcategory');
                }
            ])
            ->where('applications.user_id','=',auth()->user()->id)
            ->where('applications.is_approved', '=', 2)
            ->where('school_registrations.reg_status', '=', 1)
            ->select('establishing_schools.id','establishing_schools.school_name','establishing_schools.ward_id','establishing_schools.stream','school_registrations.school_opening_date','school_registrations.registration_number','establishing_schools.school_category_id','establishing_schools.school_sub_category_id','school_registrations.is_seminary','school_registrations.level_of_education')
            ->get();

        $response = ['registered_schools' => $registered_schools];

        return response()->json($response,200);
    }

}
