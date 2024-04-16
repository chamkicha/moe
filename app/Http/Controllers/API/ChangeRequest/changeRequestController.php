<?php

namespace App\Http\Controllers\API\ChangeRequest;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Application_category;
use App\Models\Attachment;
use App\Models\Establishing_school;
use App\Models\Fee;
use App\Models\Former_manager;
use App\Models\Former_owner;
use App\Models\Former_owner_referee;
use App\Models\Former_school_combination;
use App\Models\Former_school_info;
use App\Models\Manager;
use App\Models\Owner;
use App\Models\Referee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class changeRequestController extends Controller
{
    
    public function sendChangeRequest(Request $request): JsonResponse
    {
           Log::debug($request);

        $validator = Validator::make($request->all(), [
            'application_category' => 'required|integer',
            'school' => 'required|integer',
            'attachments' => 'required|array',
            'attachments.*.attachment_path' => 'required|string',
            'attachments.*.attachment_type' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $application_category = Application_category::find($request->input('application_category'));
        $school = Establishing_school::find($request->input('school'));

        $application = Application::where('tracking_number', '=', $school->tracking_number)->first();
      

        if ($application_category->application_code == "KM" | $application_category->application_code == "KAU" | $application_category->application_code == "KUS" | $application_category->application_code == "KMS" | $application_category->application_code == "KUJS" | $application_category->application_code == "KHS" | $application_category->application_code == "KFS" | $application_category->application_code == "KUT" | $application_category->application_code == "KUD" | $application_category->application_code == "KOB") {

            if ($application_category->application_code == "KM") {
                $validator = Validator::make($request->all(), [
                    'stream' => 'required|integer',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }

                $stream = Former_school_info::create([
                    'secure_token' => Str::random(40),
                    'establishing_school_id' => $school->id,
                    'stream' => $request->input('stream')
                ]);

                $appRequest = $this->createApplicationChangeRequest($application, $request, $school, $stream);
                // dd($appRequest);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];

                    $bill = bill($billInfo);
                    // dd($bill);

//                    $response = json_decode(json_encode($bill), TRUE);

//                    foreach ($response as $resp) {

//                        foreach ($resp as $data) {

//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2,   //Bypass payment
                                'expire_date' => $billInfo['end']
                            ]);

                            $response = ['statusCode' => 1, 'message' => 'Ombi la kuongeza mikondo limetumwa kikamilifu'];
                            return response()->json($response, 200);
//                        }
//                    }
                }

                $response = ['statusCode' => 1, 'message' => 'Ombi la kuongeza mikondo limetumwa kikamilifu'];
                return response()->json($response, 200);

            } elseif ($application_category->application_code == "KAU") {

                $validator = Validator::make($request->all(), [
                    'category' => 'required|integer',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }

                $stream = Former_school_info::create([
                    'secure_token' => Str::random(40),
                    'establishing_school_id' => $school->id,
                    'school_category_id' => $request->input('category')
                ]);

                $appRequest = $this->createApplicationChangeRequest($application, $request, $school, $stream);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];

                    $bill = bill($billInfo);

                    $response = json_decode(json_encode($bill), TRUE);

//                    foreach ($response as $resp) {
//
//                        foreach ($resp as $data) {

//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2, //bypass payment
                                'expire_date' => $billInfo['end']
                            ]);

                            $response = ['statusCode' => 1, 'message' => 'Ombi la kubadili aina ya usajili limetumwa kikamilifu'];
                            return response()->json($response, 200);
//                        }
//                    }
                }

                $response = ['statusCode' => 1, 'message' => 'Ombi la kubadili aina ya usajili limetumwa kikamilifu'];
                return response()->json($response, 200);

            } elseif ($application_category->application_code == "KUS") {

                $validator = Validator::make($request->all(), [
                    'referees' => 'required|array',
                    'referees.*.first_name' => 'required|string',
                    'referees.*.middle_name' => 'required|string',
                    'referees.*.last_name' => 'required|string',
                    'referees.*.occupation' => 'required|string',
                    'referees.*.address' => 'required|string',
                    'referees.*.email' => 'required|string',
                    'referees.*.phone_number' => 'required|string',
                    'referees.*.ward' => 'required',
                    'owner_name' => 'required|string',
                    'authorized_person' => 'required|string',
                    'title' => 'required|string',
                    'owner_email' => 'required|string',
                    'phone_number' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }

                $check_owner_email = Owner::where('owner_email', '=', $request->input('owner_email'))->first();
                $check_owner_phone = Owner::where('phone_number', '=', $request->input('phone_number'))->first();
                $check_referee_email = Referee::where('email', '=', $request->input('referees.*.email'))->first();


                if ($check_owner_email != null) {
                    $response = ['statusCode' => 0, 'message' => 'Barua pepe ya mmiliki uliojaza tayari imeshatumika kwenye mfumo, tafadhali tumia barua pepe nyigine.'];
                    return response()->json($response, 200);
                } elseif ($check_owner_phone != null) {
                    $response = ['statusCode' => 0, 'message' => 'Namba ya simu ya mmiliki uliojaza tayari imeshatumika kwenye mfumo.'];
                    return response()->json($response, 200);
                } elseif ($check_referee_email != null) {
                    $response = ['statusCode' => 0, 'message' => 'Barua pepe ya kati ya wadhamini uliojaza tayari imeshatumika kwenye mfumo, tafadhali tumia barua pepe nyigine.'];
                    return response()->json($response, 200);
                }

                $owner = Former_owner::create([
                    'secure_token' => Str::random(40),
                    'establishing_school_id' => $school->id,
                    'owner_name' => $request->input('owner_name'),
                    'authorized_person' => $request->input('authorized_person'),
                    'title' => $request->input('title'),
                    'owner_email' => $request->input('owner_email'),
                    'phone_number' => $request->input('phone_number'),
                    'purpose' => $request->input('purpose'),
                ]);

                foreach ($request->referees as $referee) {

                    $referee_data = Former_owner_referee::create([
                        'secure_token' => Str::random(40),
                        'first_name' => $referee['first_name'],
                        'former_owner_id' => $owner->id,
                        'middle_name' => $referee['middle_name'],
                        'last_name' => $referee['last_name'],
                        'occupation' => $referee['occupation'],
                        'ward_id' => $referee['ward'],
                        'address' => $referee['address'],
                        'email' => $referee['email'],
                        'phone_number' => $referee['phone_number']
                    ]);
                }

                $appRequest = $this->createApplicationChangeRequest($application, $request, $school, $owner);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];

                    $bill = bill($billInfo);

                    $response = json_decode(json_encode($bill), TRUE);

//                    foreach ($response as $resp) {
//
//                        foreach ($resp as $data) {
//
//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2,  //bypass payment
                                'expire_date' => $billInfo['end']
                            ]);

                            $response = ['statusCode' => 1, 'message' => 'Ombi la Kubadili mmiliki wa shule limetumwa kikamilifu'];
                            return response()->json($response, 200);
//                        }
//                    }
                }

                $response = ['statusCode' => 1, 'message' => 'Ombi la Kubadili mmiliki wa shule limetumwa kikamilifu'];
                return response()->json($response, 200);

            } elseif ($application_category->application_code == "KMS") {

                $validator = Validator::make($request->all(), [
                    'manager_first_name' => 'required|string',
                    'manager_middle_name' => 'required|string',
                    'manager_last_name' => 'required|string',
                    'manager_occupation' => 'required|string',
                    'manager_ward' => 'required',
                    'manager_house_number' => 'required|string',
                    'manager_street' => 'required|string',
                    'manager_phone_number' => 'required|string',
                    'manager_email' => 'required|string',
                    'manager_expertise_level' => 'required|string',
                    'manager_education_level' => 'required|string',
                    'manager_cv' => 'required',
                    'manager_certificate' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }

                $manager_email = Manager::where('manager_email', '=', $request->input('manager_email'))->first();
                $manager_phone = Manager::where('manager_phone_number', '=', $request->input('manager_phone_number'))->first();

                if ($manager_email != null) {

                    $response = ['statusCode' => 0, 'message' => 'Barua pepe ya manager uliojaza tayari imeshatumika kwenye mfumo, tafadhali tumia barua pepe nyigine.'];
                    return response()->json($response, 200);
                } elseif ($manager_phone != null) {

                    $response = ['statusCode' => 0, 'message' => 'Namba ya simu ya manager uliojaza tayari imeshatumika kwenye mfumo.'];
                    return response()->json($response, 200);
                }

                $manager = Former_manager::create([
                    'establishing_school_id' => $school->id,
                    'manager_first_name' => $request->input('manager_first_name'),
                    'manager_middle_name' => $request->input('manager_middle_name'),
                    'manager_last_name' => $request->input('manager_last_name'),
                    'occupation' => $request->input('manager_occupation'),
                    'house_number' => $request->input('manager_house_number'),
                    'street' => $request->input('manager_street'),
                    'manager_phone_number' => $request->input('manager_phone_number'),
                    'manager_email' => $request->input('manager_email'),
                    'education_level' => $request->input('manager_education_level'),
                    'expertise_level' => $request->input('manager_expertise_level'),
                    'ward_id' => $request->input('manager_ward'),
                    'manager_cv' => $request->input('manager_cv'),
                    'manager_certificate' => $request->input('manager_certificate')
                ]);

                $appRequest = Application::create([
                    'secure_token' => Str::random(40),
                    'foreign_token' => $application->foreign_token,
                    'user_id' => auth()->user()->id,
                    'application_category_id' => $request->input('application_category'),
                    'tracking_number' => generateTrackingNumber($school->school_category_id),
                    'registry_type_id' => $application->registry_type_id,
                    'folio' => $school->max_folio + 1,
                ]);
              
                $manager->update([
                    'tracking_number' => $appRequest->tracking_number
                ]);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];
                    // dd($billInfo);

                    $bill = bill($billInfo);

//                    $response = json_decode(json_encode($bill), TRUE);
//
//                    foreach ($response as $resp) {
//
//                        foreach ($resp as $data) {

//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2,
                                'expire_date' => $billInfo['end']
                            ]);

                            $response = ['statusCode' => 1, 'message' => 'Ombi la Kubadili meneja wa shule limetumwa kikamilifu'];
                            return response()->json($response, 200);

//                        }
//                    }
                }

                $response = ['statusCode' => 1, 'message' => 'Ombi la Kubadili meneja wa shule limetumwa kikamilifu'];
                return response()->json($response, 200);

            } elseif ($application_category->application_code == "KUJS") {
                $validator = Validator::make($request->all(), [
                    'school_name' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }

                $school_change = Former_school_info::create([
                    'secure_token' => Str::random(40),
                    'establishing_school_id' => $school->id,
                    'school_name' => $request->input('school_name')
                ]);

                $appRequest = $this->createApplicationChangeRequest($application, $request, $school, $school_change);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];

                    $bill = bill($billInfo);

//                    $response = json_decode(json_encode($bill), TRUE);
//
//                    foreach ($response as $resp) {
//
//                        foreach ($resp as $data) {
//
//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2,  //bypass payment
                                'expire_date' => $billInfo['end']
                            ]);

                            $response = ['statusCode' => 1, 'message' => 'Ombi la Kubadili jina la shule limetumwa kikamilifu'];
                            return response()->json($response, 200);

//                        }
//                    }
                }

                $response = ['statusCode' => 1, 'message' => 'Ombi la Kubadili jina la shule limetumwa kikamilifu'];
                return response()->json($response, 200);

            } elseif ($application_category->application_code == "KHS") {

                $validator = Validator::make($request->all(), [
                    'region' => 'required',
                    'district' => 'required',
                    'ward' => 'required',
                    'village_id' => 'required'
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }

                $school_transfer = Former_school_info::create([
                    'secure_token' => Str::random(40),
                    'establishing_school_id' => $school->id,
                    'ward_id' => $request->input('ward'),
                    'village_id' => $request->input('village_id'),
                ]);

                $appRequest = $this->createApplicationChangeRequest($application, $request, $school, $school_transfer);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];

                    $bill = bill($billInfo);

//                    $response = json_decode(json_encode($bill), TRUE);
//
//                    foreach ($response as $resp) {
//
//                        foreach ($resp as $data) {

//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2,  //bypass payment
                                'expire_date' => $billInfo['end']
                            ]);

                            $response = ['statusCode' => 1, 'message' => 'Ombi la Kuhamisha shule limetumwa kikamilifu'];
                            return response()->json($response, 200);
//                        }
//                    }
                }

                $response = ['statusCode' => 1, 'message' => 'Ombi la Kuamisha shule limetumwa kikamilifu'];
                return response()->json($response, 200);

            } elseif ($application_category->application_code == "KFS") {

                $school_delete = Former_school_info::create([
                    'secure_token' => Str::random(40),
                    'establishing_school_id' => $school->id,
                ]);

                $appRequest = $this->createApplicationChangeRequest($application, $request, $school, $school_delete);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];

                    $bill = bill($billInfo);

//                    $response = json_decode(json_encode($bill), TRUE);
//
//                    foreach ($response as $resp) {
//
//                        foreach ($resp as $data) {

//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2,  //bypass payment
                                'expire_date' => $billInfo['end']
                            ]);

                            $response = ['statusCode' => 1, 'message' => 'Ombi la Kufuta usajili wa shule limetumwa kikamilifu'];
                            return response()->json($response, 200);
//                        }
//                    }
                }

                $response = ['statusCode' => 1, 'message' => 'Ombi la Kufuta usajili wa shule limetumwa kikamilifu'];
                return response()->json($response, 200);

            } elseif ($application_category->application_code == "KUT") {

                $validator = Validator::make($request->all(), [
                    'school_specialization' => 'required|array',
                    'combination' => 'required|array',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }

                foreach ($request->input('combination') as $comb){
                    $school_combination = Former_school_combination::create([
                        'establishing_school_id' => $school->id,
                        'combination_id' => $comb,
                    ]);
                }

                $appRequest = $this->createApplicationChangeRequest($application, $request, $school, $school_combination);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];

                    $bill = bill($billInfo);

//                    $response = json_decode(json_encode($bill), TRUE);
//
//                    Log::debug($response);
//
//                    foreach ($response as $resp) {
//
//                        Log::debug($resp);
//
//                        foreach ($resp as $data) {
//
//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2,  //bypass payment
                                'expire_date' => $billInfo['end']
                            ]);

                            $response = ['statusCode' => 1, 'message' => 'Ombi la Kuongeza tahasusi limetumwa kikamilifu'];
                            return response()->json($response, 200);

//                        }
//                    }
                }
                $response = ['statusCode' => 1, 'message' => 'Ombi la Kuongeza tahasusi limetumwa kikamilifu'];
                return response()->json($response, 200);

            } elseif ($application_category->application_code == "KUD") {

                $school_hostel = Former_school_info::create([
                    'secure_token' => Str::random(40),
                    'establishing_school_id' => $school->id,
                    'is_hostel' => TRUE,
                ]);

                $appRequest = $this->createApplicationChangeRequest($application, $request, $school, $school_hostel);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];

                    $bill = bill($billInfo);

                    $response = json_decode(json_encode($bill), TRUE);
//
//                    foreach ($response as $resp) {
//
//                        foreach ($resp as $data) {
//
//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2,  //bypass payment
                                'expire_date' => $billInfo['end']
                            ]);

                            $response = ['statusCode' => 1, 'message' => 'Ombi la Kuongeza dahalia limetumwa kikamilifu'];
                            return response()->json($response, 200);

//                        }
//                    }
                }

                $response = ['statusCode' => 1, 'message' => 'Ombi la Kuongeza dahalia limetumwa kikamilifu'];
                return response()->json($response, 200);

            } elseif ($application_category->application_code == "KOB") {

                $validator = Validator::make($request->all(), [
                    'school_sub_category' => 'required|integer',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }

                $school_sub_category = Former_school_info::create([
                    'secure_token' => Str::random(40),
                    'establishing_school_id' => $school->id,
                    'school_sub_category_id' => $request->input('school_sub_category'),
                ]);

                $appRequest = $this->createApplicationChangeRequest($application, $request, $school, $school_sub_category);

                if ($application->registry_type_id != 3) {

                    $date = Carbon::now()->format('Y-m-d*H:s:i');
                    $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

                    $bill_amount = Fee::where('fee_code', '=', 'CR')->where('is_active', '=', true)->first();

                    $billInfo = [
                        'BillId' => $appRequest->tracking_number,
                        'pyrid' => $school->school_name,
                        'name' => $school->school_name,
                        'phone' => $school->school_phone,
                        'amount' => $bill_amount->amount,
                        'description' => $bill_amount->description,
                        'start' => str_replace("*", 'T', $date),
                        'end' => str_replace("*", 'T', $endDate),
                    ];

                    $bill = bill($billInfo);

                    $response = json_decode(json_encode($bill), TRUE);

//                    foreach ($response as $resp) {
//
//                        foreach ($resp as $data) {
//
//                            if ($data['TrxStsCode'] != '7101') {
//
//                                Log::debug($response);
//                                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
//                                return response()->json($response, 200);
//                            }

                            Application::find($appRequest->id)->update([
                                'control_number' => controlNumber(),
                                'amount' => $billInfo['amount'],
                                'payment_status_id' => 2,
                                'expire_date' => $billInfo['end']
                            ]);


                            $response = ['statusCode' => 1, 'message' => 'Ombi la Kuongeza bweni limetumwa kikamilifu'];
                            return response()->json($response, 200);

//                        }
//                    }
                }

                $response = ['statusCode' => 1, 'message' => 'Ombi la Kuongeza bweni limetumwa kikamilifu'];
                return response()->json($response, 200);

            }

        }

        return response()->json(['statusCode' => 0, 'message' => 'Aina ya ombi ulilotuma halikubaliki']);
    }

    public function showChangeRequestApplications(): JsonResponse
    {

        $change_requests = Application::with([
            'former_school' => function ($query) {
                $query->with([
                    'school' => function ($qry) {
                        $qry->with([
                            'category' => function ($query) {
                                $query->select('id', 'category');
                            }
                        ])
                            ->select('id', 'school_category_id', 'school_name', 'stream', 'curriculum_id','file_number','school_folio');
                    },
                    'category' => function ($query) {
                        $query->select('id', 'category');
                    }
                ])->select('id', 'tracking_number', 'establishing_school_id', 'school_category_id', 'school_name', 'stream', 'curriculum_id');
            },
            'payment_status' => function ($query) {
                $query->select('id', 'status_code', 'status');
            },
            'category' => function ($query) {
                $query->select('id', 'secure_token', 'app_name');
            },
        ])
            ->where('application_category_id', '>', 4)
            ->where('user_id', '=', auth()->user()->id)
            ->select('id', 'secure_token', 'registry_type_id', 'foreign_token', 'application_category_id', 'tracking_number', 'is_approved', 'control_number', 'payment_status_id', 'amount', 'expire_date')
            ->orderBy('id', 'DESC')
            ->get();

        $response = ['change_requests' => $change_requests];
        return response()->json($response, 200);
    }

    public function changeRequestDetails($tracking_number): JsonResponse
    {

        $change_requests = Application::with([
            'former_school' => function ($query) {
                $query->with([
                    'school' => function ($qry) {
                        $qry->with([
                            'institute',
                            'personal',
                            'category' => function ($query) {
                                $query->select('id', 'category');
                            },
                            'school' => function($qr){
                              $qr->select('id','establishing_school_id','registration_number');
                            },
                            'subcategory' => function($query){
                                $query->select('id','subcategory');
                            },
                        ]);
                    },
                    'category' => function ($query) {
                        $query->select('id', 'category');
                    },
                    'subcategory' => function($query){
                        $query->select('id','subcategory');
                    },
                ])->select('id', 'tracking_number', 'establishing_school_id', 'school_category_id', 'school_name', 'stream', 'curriculum_id','is_hostel','school_sub_category_id');
            },
            'former_combination' => function($query){
               $query->with([
                   'school' => function($qr){
                      $qr->with([
                          'institute',
                          'personal',
                          'former_combination.combination',
                          'category' => function ($query) {
                              $query->select('id', 'category');
                          },
                      ]);
                   },
//                   'combination' => function($qr){
//                      $qr->select('id','combination');
//                   }
               ]);
            },
            'former_owner' => function($query){
                $query->with([
                    'school'
                ]);
            },
            'former_manager' => function($query){
                $query->with([
                    'school'
                ]);
            },
            'payment_status' => function ($query) {
                $query->select('id', 'status_code', 'status');
            },
            'category' => function ($query) {
                $query->select('id', 'secure_token', 'app_name');
            },
        ])
            ->where('tracking_number', '=', $tracking_number)
            ->select('id', 'secure_token', 'registry_type_id', 'foreign_token', 'application_category_id', 'tracking_number', 'is_approved', 'control_number', 'payment_status_id', 'amount', 'expire_date','approved_at','folio')
            ->first();

        $response = ['change_requests' => $change_requests];
        return response()->json($response, 200);
    }

    /**
     * @param $application
     * @param Request $request
     * @param $school
     * @param $stream
     * @return mixed
     */
    private function createApplicationChangeRequest($application, Request $request, $school, $stream)
    {
        $appRequest = Application::create([
            'secure_token' => Str::random(40),
            'foreign_token' => $application->foreign_token,
            'user_id' => auth()->user()->id,
            'application_category_id' => $request->input('application_category'),
            'tracking_number' => generateTrackingNumber($school->school_category_id),
            'registry_type_id' => $application->registry_type_id,
            'folio' => $school->max_folio + 1,
            'payment_status_id' => 2,
        ]);

        
        $school->update([
            'max_folio' => $appRequest->folio
        ]);

        $stream->update([
            'tracking_number' => $appRequest->tracking_number
        ]);

        foreach ($request->input('attachments') as $attachment) {
            $attachment_path = base64pdfToFile($attachment['attachment_path']);

            $attachment = Attachment::create([
                'secure_token' => Str::random(40),
                'uploader_token' => auth()->user()->secure_token,
                'tracking_number' => $appRequest->tracking_number,
                'attachment_path' => $attachment_path,
                'attachment_type_id' => $attachment['attachment_type'],
            ]);
        }
        return $appRequest;
    }
}
