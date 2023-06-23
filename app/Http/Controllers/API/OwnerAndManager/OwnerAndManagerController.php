<?php

namespace App\Http\Controllers\API\OwnerAndManager;

use App\Models\Owner;
use App\Models\Manager;
use App\Models\Application;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\School_category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Establishing_school;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OwnerAndManagerController extends Controller
{
    public function ownerApplication(Request $request): JsonResponse
    {

        try {
            $validator = Validator::make($request->all(), [
                'application_category' => 'required|integer',
                'school' => 'required|integer',
                'referees' => 'required|array',
                'referees.*.first_name' => 'required|string',
                'referees.*.middle_name' => 'required|string',
                'referees.*.last_name' => 'required|string',
                'referees.*.occupation' => 'required|string',
                'referees.*.address' => 'required|string',
                'referees.*.email' => 'required|string',
                'referees.*.phone_number' => 'required|string',
                'referees.*.referee_ward' => 'required|integer',
                'owner_name' => 'required|string',
                'authorized_person' => 'required|string',
                'title' => 'required|string',
                'owner_email' => 'required|string',
                'phone_number' => 'required|string',
                'purpose' => 'required|string',
                'manager_first_name' => 'required|string',
                'manager_middle_name' => 'required|string',
                'manager_last_name' => 'required|string',
                'manager_occupation' => 'required|string',
                'manager_ward' => 'required|integer',
                'manager_house_number' => 'required|string',
                'manager_street' => 'required|string',
                'manager_phone_number' => 'required|string',
                'manager_email' => 'required|string',
                'manager_expertise_level' => 'required|string',
                'manager_education_level' => 'required|string',
                'manager_cv' => 'required',
                'manager_certificate' => 'required',
                'is_manager' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            $message = '';
            Log::info("ID YA SHULE NI ".$request->school);
            $school = Establishing_school::find($request->school);
            if ($school) {
                $school->stage = 2;
                if ($school->save()) {
                    $app = Application::where('tracking_number', '=', $school->tracking_number)->first();
                    $tracking_number = generateTrackingNumber($school->school_category_id);
                    if ($app) {
                        $owner_data = [
                            'secure_token' => Str::random(40),
                            'establishing_school_id' => $school->id,
                            'owner_name' => $request->input('owner_name'),
                            'authorized_person' => $request->input('authorized_person'),
                            'title' => $request->input('title'),
                            'owner_email' => $request->input('owner_email'),
                            'phone_number' => $request->input('phone_number'),
                            'purpose' => $request->input('purpose'),
                            'tracking_number' => $tracking_number, // added
                            'is_manager' => $request->input('is_manager'),
                            'ownership_sub_type_id' => $request->input('ownership_sub_type'),
                            'denomination_id' => $request->input('denomination'),
                        ];

                        $owner = $school->owner()->updateOrCreate($owner_data);
                        if ($owner) {
                            $referees = $request->input('referees');
                            $ownerRefereesSaved = false;
                            foreach ($referees as $referee) {
                                $referee_data = [
                                    'secure_token' => Str::random(40),
                                    'first_name' => $referee['first_name'],
                                    'middle_name' => $referee['middle_name'],
                                    'last_name' => $referee['last_name'],
                                    'occupation' => $referee['occupation'],
                                    'ward_id' => $referee['referee_ward'],
                                    'address' => $referee['address'],
                                    'email' => $referee['email'],
                                    'phone_number' => $referee['phone_number']
                                ];

                                $ownerRefereesSaved = $owner->referees()->updateOrCreate($referee_data);
                            }
                            if ($ownerRefereesSaved) {
                                $manager_data = [
                                    'manager_first_name' => $request->input('manager_first_name'),
                                    'manager_middle_name' => $request->input('manager_middle_name'),
                                    'manager_last_name' => $request->input('manager_last_name'),
                                    'occupation' => $request->input('manager_occupation'),
                                    'house_number' => $request->input('manager_house_number'),
                                    'street' => $request->input('manager_street'),
                                    'tracking_number' => $tracking_number, //added
                                    'manager_phone_number' => $request->input('manager_phone_number'),
                                    'manager_email' => $request->input('manager_email'),
                                    'education_level' => $request->input('manager_education_level'),
                                    'expertise_level' => $request->input('manager_expertise_level'),
                                    'ward_id' => $request->input('manager_ward'),
                                    'manager_cv' => $request->input('manager_cv'),
                                    'manager_certificate' => $request->input('manager_certificate')
                                ];

                                $manager = $school->manager()->updateOrCreate($manager_data);
                                if ($manager) {

                                    $application = Application::create([
                                        'secure_token' => Str::random(40),
                                        'foreign_token' => $app->foreign_token,
                                        'tracking_number' => $tracking_number,
                                        'user_id' => auth()->user()->id,
                                        'registry_type_id' => $app->registry_type_id,
                                        'application_category_id' => $request->input('application_category'),
                                        'folio' => $school->max_folio + 1
                                    ]);

                                    $school->update([
                                        'max_folio' => $application->folio
                                    ]);
                                    // $owner->update([
                                    //     'tracking_number' => $tracking_number
                                    // ]);
                                    // $manager->update([
                                    //     'tracking_number' => $tracking_number
                                    // ]);
                                    $message = 'Ombi la umiliki na umeneja limetumwa kikamilifu';
                                } else {
                                    $message = 'Taarifa za Meneja hazijahifadhiwa.';
                                }
                            }
                        } else {
                            $message = "Taarifa za mmiliki hazijahifadhiwa.";
                        }
                    }
                }
            } else {
                $message = 'Hakuna taarifa za shule hii.';
            }
            Log::info($message);
            return response()->json(['message' => $message], 200);
        } catch (\Exception $th) {
            $message = 'Kuna hitilafu imetokea, Tafadhali wasiliana na Msimamizi wa Mfumo. '.$th->getMessage();
            Log::error($message);
            return response()->json(['message' => $message], 200);
        }
    }

    public function getSchoolApprovedFromTwoStages(): JsonResponse
    {

        $schools = DB::table('applications')
            ->join('owners', 'applications.tracking_number', '=', 'owners.tracking_number')
            ->join('establishing_schools', 'owners.establishing_school_id', '=', 'establishing_schools.id')
            ->where('applications.user_id', '=', auth()->user()->id)
            ->where('applications.is_approved', '=', 2)
            ->where('establishing_schools.stage', '=', 2)
            ->select('establishing_schools.id', 'establishing_schools.school_name', 'establishing_schools.tracking_number','applications.application_category_id')
            ->get();

        $response = ['schools' => $schools];

        return response()->json($response, 200);
    }


    public function getSchoolApprovedFromOneStages(): JsonResponse
    {

        $schools = DB::table('applications')
            ->join('establishing_schools', 'applications.tracking_number', '=', 'establishing_schools.tracking_number')
            ->where('applications.user_id', '=', auth()->user()->id)
            ->where('applications.is_approved', '=', 2)
            ->where('establishing_schools.stage', '=', 1)
            ->select('establishing_schools.id', 'establishing_schools.school_name', 'establishing_schools.tracking_number')
            ->get();

        $response = ['schools' => $schools];

        return response()->json($response, 200);
    }

    public function checkTheOlderApplicationBeforeOwnership(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'tracking_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $tracking_number = $request->input('tracking_number');
        $application = Application::where('tracking_number', '=', $tracking_number)->first();

        if ($application == null) {

            $response = ['statusCode' => 601, 'message' => 'Ombi lenye nambari' . ' ' . $tracking_number . ' ' . 'alipo kwenye mfumo, tafadhali ingiza namba ya ombi iliyo sahihi'];
            return response()->json($response, 200);
        } elseif (!$application->is_approved) {

            $response = ['statusCode' => 602, 'message' => 'Ombi uliloingiza bado linashughulikiwa litakapo dhubitishwa ndio utaweza kuendelea na ombi hili'];
            return response()->json($response, 200);
        }

        $response = ['statusCode' => 700];
        return response()->json($response, 200);

    }

}
