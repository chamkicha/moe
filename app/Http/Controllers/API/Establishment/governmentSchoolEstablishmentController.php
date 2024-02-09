<?php

namespace App\Http\Controllers\API\Establishment;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Attachment_type;
use App\Models\Establishing_school;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use DB;

class governmentSchoolEstablishmentController extends Controller
{
    public function governmentEstablishment(Request $request): JsonResponse
    {
        // Log::debug($request);

        // try{

        
        $validator = Validator::make($request->all(), [
            'school_name' => 'required',
            'area' => 'required|integer',
            'school_category' => 'required|integer',
            'school_sub_category' => 'required|integer',
            'language' => 'required|integer',
            'building_structure' => 'required|integer',
            'ward' => 'required',
            'registration_structure' => 'required|integer',
            'stream' => 'required|integer',
            'school_address' => 'required|string',
            'po_box' => 'required|string',
            'school_opening_date' => 'required|date',
            'number_of_students' => 'required|integer',
            'number_of_teachers' => 'required|integer',
            'teacher_information' => 'required',
            'certificate_type' => 'required|integer',
            'school_gender' => 'required|integer',
            'disabled' => 'required',
           //            'ƒ' => 'required|array',
            'owner_name' => 'required|string',
            'manager_name' => 'required|string',
            'is_hostel' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $school = Establishing_school::create([
            'secure_token' => Str::random(40),
            'school_category_id' => $request->input('school_category'),
            'school_sub_category_id' => $request->input('school_sub_category'),
            'school_name' => $request->input('school_name'),
            'school_phone' => $request->input('school_phone'),
            'school_email' => $request->input('school_email'),
            'area' => $request->input('area'),
            'language_id' => $request->input('language'),
            'building_structure_id' => $request->input('building_structure'),
            'ward_id' => $request->input('ward'),
            'village_id' => $request->input('village_id'),
            'registration_structure_id' => $request->input('registration_structure'),
            'stream' => $request->input('stream'),
            'website' => $request->input('website'),
            'school_address' => $request->input('school_address'),
            'po_box' => $request->input('po_box'),
            'number_of_students' => $request->input('number_of_students'),
            'number_of_teachers' => $request->input('number_of_teachers'),
            'teacher_information' => $request->input('teacher_information'),
            'certificate_type_id' => $request->input('certificate_type'),
            'school_gender_type_id' => $request->input('school_gender'),
            'is_for_disabled' => $request->input('disabled'),
            'stage' => 3,
            'file_number' => generateFileNumber(3,$request->input('school_category')),
            'school_folio' => 1,
            'payment_status_id'=>2,
            'max_folio' => 1
        ]);

        $owner_data = [
            'secure_token' => Str::random(40),
            'owner_name' => $request->input('owner_name')
        ];

        $school->owner()->updateOrCreate($owner_data);

        $manager_data = [
            'manager_first_name' => $request->input('manager_name'),
        ];

        $school->manager()->updateOrCreate($manager_data);

        $registration_data = [
            'secure_token' => Str::random(40),
            'school_opening_date' => $request->input('school_opening_date'),
            'level_of_education' => $request->input('certificate_type'),
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
            'foreign_token' => Str::random(40),
            'tracking_number' => generateTrackingNumber($school->school_category_id),
            'user_id' => auth()->user()->id,
            'registry_type_id' => 3,
            'application_category_id' => 4,
            'folio' => 1
        ]);

        $school->update([
            'tracking_number' => $application->tracking_number,
        ]);

        $register->update([
            'tracking_number' => $application->tracking_number,
        ]);

        // $attachment_types = Attachment_type::where('application_category_id', '=', 1)
        //     ->select('id', 'secure_token', 'attachment_name')
        //     ->get();

        $attachment_types = Attachment_type::select('attachment_types.id as id', 'app_name', 'file_size', 'file_format', 'attachment_name', 'registry')
            ->join('application_categories', 'application_categories.id', '=', 'attachment_types.application_category_id')
            ->join('registry_types', 'attachment_types.registry_type_id', '=', 'registry_types.id')
            ->where('attachment_types.status_id', '=', '1')
            ->where('attachment_types.application_category_id', '=', '4')
            ->where('attachment_types.registry_type_id', '=', '3')
            ->get();
            


        $response = ['application' => $application, 'attachment_types' => $attachment_types];
        return response()->json($response, 200);

    //  } catch (\Exception $th) {
    //     // DB::rollback();
    //     $error = $th->getMessage();
    //     Log::error($error);
    //     return response()->json(['message' => 'something went wrong','error' => $error], 400);
    //  }
    }
}
