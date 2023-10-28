<?php

namespace App\Http\Controllers\API\Establishment;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Attachment;
use App\Models\Attachment_type;
use App\Models\Establishing_school;
use App\Models\Fee;
use App\Models\Maoni;
use App\Models\Institute_info;
use App\Models\Personal_info;
use App\Models\Registry_type;
use App\Models\School_category;
use App\Models\School_registry;
use App\Models\School_specialization;
use ErrorException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use http\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class schoolEstablishmentController extends Controller
{
    public function establishSchool(Request $request)
    {
        //    Log::debug($request);
    //  try{
        $validator = Validator::make($request->all(), [
            'application_category' => 'required|integer',
            'school_name' => 'required',
            'school_phone' => 'required|string',
            'school_email' => 'required|string',
            'area' => 'required',
            'registry_type' => 'required|integer',
            'school_category' => 'required|integer',
            'school_sub_category' => 'required|integer',
            'language' => 'required|integer',
            'building_structure' => 'required|integer',
            'ward' => 'required',
            'village_id' => 'required',
            'registration_structure' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // DB::beginTransaction();

        $registry = Registry_type::find($request->input('registry_type'));

        if ($registry->registry == "Mtu binafsi") {

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'middle_name' => 'required|string',
                'last_name' => 'required|string',
                'occupation' => 'required|string',
                'personal_email' => 'required|string',
                'personal_phone_number' => 'required|string',
                'personal_identity_type' => 'required|integer',
                'personal_id_number' => 'required|string',
                'personal_address' => 'required|string',
                'ward_of_person' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

        } elseif ($registry->registry == "Taasisi/Kampuni/NGO") {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'registration_number' => 'required|string',
                'institute_email' => 'required|string',
                'institute_phone' => 'required|string',
                'box' => 'required|string',
                'ward' => 'required',
                'address' => 'required|string',
                'institute_attachments' => 'required|array',
                'institute_attachments.*.attachment_type' => 'required|integer',
                'institute_attachments.*.attachment_path' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

        }

        $incomplete = Application::where('user_id','=',auth()->user()->id)
            ->where('application_category_id','=',1)
            ->where('is_complete','=',0)
            ->count('*');

        if ($incomplete > 0){

            $response = ['statusCode' => 0, 'message' => 'Samahani una maombi '.$incomplete.' aujakamilisha kuweka viambatanisho tafadhali nenda kwenye orodha yako ya maombi kamilisha au futa kama huna kazi nayo tena maombi hayo ili uweze kuanzisha shule ingine, ahsante'];
            return response($response,200);
        }

        $folio = Establishing_school::where('school_category_id','=',$request->input('school_category'))->max('school_folio');

        $establishment = Establishing_school::create([
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
            'stage' => 1,
            'file_number' => generateFileNumber($registry->id,$request->input('school_category')),
            'school_folio' => $folio + 1,
            'max_folio' => 1
        ]);

        if ($registry->registry == "Mtu binafsi") {

            $person_info = Personal_info::create([
                'secure_token' => Str::random(40),
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'occupation' => $request->input('occupation'),
                'personal_email' => $request->input('personal_email'),
                'personal_phone_number' => $request->input('personal_phone_number'),
                'identity_type_id' => $request->input('personal_identity_type'),
                'personal_id_number' => $request->input('personal_id_number'),
                'personal_address' => $request->input('personal_address'),
                'ward_id' => $request->input('ward_of_person'),
            ]);

            $school_registry = School_registry::create([
                'school_token' => $establishment->secure_token,
                'registry_token' => $person_info->secure_token
            ]);



            $applicaion_data = [
                'secure_token' => Str::random(40),
                'user_id' => auth()->user()->id,
                'application_category_id' => $request->input('application_category'),
                'registry_type_id' => $request->input('registry_type'),
                'tracking_number' => generateTrackingNumber($request->input('school_category')),
                'folio' => 1
            ];

            return $this->createApplicationRequest($person_info, $applicaion_data, $establishment, $request);

        } elseif ($registry->registry == "Taasisi/Kampuni/NGO") {

            $institute_info = Institute_info::create([
                'secure_token' => Str::random(40),
                'name' => $request->input('name'),
                'registration_number' => $request->input('registration_number'),
                'institute_email' => $request->input('institute_email'),
                'institute_phone' => $request->input('institute_phone'),
                'box' => $request->input('box'),
                'ward_id' => $request->input('ward'),
                'registration_certificate_copy' => $request->input('registration_certificate_copy'),
                'organizational_constitution' => $request->input('organizational_constitution'),
                'agreement_document' => $request->input('agreement_document'),
                'address' => $request->input('address')
            ]);

            foreach ($request->institute_attachments as $attachment) {

                $inst_attachment = [
                    'attachment_type_id' => $attachment['attachment_type'],
                    'attachment' => $attachment['attachment_path'],
                ];

                $institute_info->attachments()->updateOrCreate($inst_attachment);
            }

            $school_registry = School_registry::create([
                'school_token' => $establishment->secure_token,
                'registry_token' => $institute_info->secure_token
            ]);

            $applicaion_data = [
                'secure_token' => Str::random(40),
                'user_id' => auth()->user()->id,
                'application_category_id' => $request->input('application_category'),
                'tracking_number' => generateTrackingNumber($request->input('school_category')),
                'registry_type_id' => $request->input('registry_type'),
            ];

            return $this->createApplicationRequest($institute_info, $applicaion_data, $establishment, $request);

        }
        // DB::commit();

    //  } catch (\Exception $th) {
    //     DB::rollback();
    //     $error = $th->getMessage();
    //     Log::error($error);
    //     return response()->json(['message' => 'something went wrong','error' => $error], 200);
    //  }

    }

    public function deleteApplication($trackingNumber): JsonResponse
    {

        $application = Application::where('tracking_number','=',$trackingNumber)->delete();

        $response = [ 'statusCode' => 0, 'message' => 'Ombi lako limefutwa kikamilifu'];

        return response()->json($response,200);
    }

    public function updateEstablishingSchoolApplication(Request $request){

        // try{


        $validator = Validator::make($request->all(), [
            'application_category' => 'required|integer',
            'school_name' => 'required',
            'school_phone' => 'required|string',
            'school_email' => 'required|string',
            'area' => 'required',
            'registry_type' => 'required|integer',
            'school_category' => 'required|integer',
            'school_sub_category' => 'required|integer',
            'language' => 'required|integer',
            'building_structure' => 'required|integer',
            'ward' => 'required',
            'registration_structure' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        // DB::beginTransaction();

        $registry = Registry_type::find($request->input('registry_type'));

        if ($registry->registry == "Mtu binafsi") {

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'middle_name' => 'required|string',
                'last_name' => 'required|string',
                'occupation' => 'required|string',
                'personal_email' => 'required|string',
                'personal_phone_number' => 'required|string',
                'personal_identity_type' => 'required|integer',
                'personal_id_number' => 'required|string',
                'personal_address' => 'required|string',
                'ward_of_person' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

        } elseif ($registry->registry == "Taasisi/Kampuni/NGO") {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'registration_number' => 'required|string',
                'institute_email' => 'required|string',
                'institute_phone' => 'required|string',
                'box' => 'required|string',
                'ward' => 'required|integer',
                'address' => 'required|string',
                'institute_attachments' => 'required|array',
                'institute_attachments.*.attachment_type' => 'required|integer',
                'institute_attachments.*.attachment_path' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

        }

        $establishment = Establishing_school::create([
            'id' => $request->input('establishing_id'),
            'secure_token' => Str::random(40),
            'school_category_id' => $request->input('school_category'),
            'school_sub_category_id' => $request->input('school_sub_category'),
            'school_name' => $request->input('school_name'),
            'school_phone' => $request->input('school_phone'),
            'school_email' => $request->input('school_email'),
            'area' => $request->input('area'),
            'po_box' => $request->input('po_box'),
            'language_id' => $request->input('language'),
            'building_structure_id' => $request->input('building_structure'),
            'ward_id' => $request->input('ward'),
            'registration_structure_id' => $request->input('registration_structure'),
            'stage' => 1
        ]);

        if ($registry->registry == "Mtu binafsi") {

            $person_info = Personal_info::create([
                'id' => $request->input('personal_id'),
                'secure_token' => Str::random(40),
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'occupation' => $request->input('occupation'),
                'personal_email' => $request->input('personal_email'),
                'personal_phone_number' => $request->input('personal_phone_number'),
                'identity_type_id' => $request->input('personal_identity_type'),
                'personal_id_number' => $request->input('personal_id_number'),
                'personal_address' => $request->input('personal_address'),
                'ward_id' => $request->input('ward_of_person'),
            ]);

            $school_registry = School_registry::create([
                'school_token' => $establishment->secure_token,
                'registry_token' => $person_info->secure_token
            ]);

            $applicaion_data = [
                'secure_token' => Str::random(40),
                'user_id' => auth()->user()->id,
                'application_category_id' => $request->input('application_category'),
                'registry_type_id' => $request->input('registry_type'),
                'tracking_number' => generateTrackingNumber($request->input('school_category'))
            ];

            return $this->createApplicationRequest($person_info, $applicaion_data, $establishment, $request);
            // DB::commit();

        } elseif ($registry->registry == "Taasisi/Kampuni/NGO") {

            $institute_info = Institute_info::create([
                'id' => $request->input('institute_id'),
                'secure_token' => Str::random(40),
                'name' => $request->input('name'),
                'registration_number' => $request->input('registration_number'),
                'institute_email' => $request->input('institute_email'),
                'institute_phone' => $request->input('institute_phone'),
                'box' => $request->input('box'),
                'ward_id' => $request->input('ward'),
                'registration_certificate_copy' => $request->input('registration_certificate_copy'),
                'organizational_constitution' => $request->input('organizational_constitution'),
                'agreement_document' => $request->input('agreement_document'),
                'address' => $request->input('address')
            ]);

            foreach ($request->institute_attachments as $attachment) {

                $inst_attachment = [
                    'id' => $attachment['institute_attachment_id'],
                    'attachment_type_id' => $attachment['attachment_type'],
                    'attachment' => $attachment['attachment_path'],
                ];

                $institute_info->attachments()->updateOrCreate($inst_attachment);
            }

            $tracking_number = $request->input('tracking_number');

            foreach ($request->input('attachments') as $attachment) {

                $attachment_path = base64pdfToFile($attachment['attachment_path']);

                Attachment::create([
                    'secure_token' => Str::random(40),
                    'uploader_token' => auth()->user()->secure_token,
                    'tracking_number' => $tracking_number,
                    'attachment_path' => $attachment_path,
                    'attachment_type_id' => $attachment['attachment_type'],
                ]);
            }
            // DB::commit();

            $response = ['statusCode' => 1,'message' => 'Ombi la kuanzisha shule limetumwa kikamilifu'];
            return response()->json($response, 200);


        }

    //  } catch (\Exception $th) {
    //     DB::rollback();
    //     $error = $th->getMessage();
    //     Log::error($message);
    //     return response()->json(['message' => 'something went wrong','error' => $error], 200);
    //  }
    }

    public function sendAttachments(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tracking_number' => 'required|string',
            'attachments' => 'required|array',
            'attachments.*.attachment_path' => 'required|string',
            'attachments.*.attachment_type' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $tracking_number = $request->input('tracking_number');

        foreach ($request->input('attachments') as $attachment) {

            $attachment_path = base64pdfToFile($attachment['attachment_path']);

            Attachment::create([
                'secure_token' => Str::random(40),
                'uploader_token' => auth()->user()->secure_token,
                'tracking_number' => $tracking_number,
                'attachment_path' => $attachment_path,
                'attachment_type_id' => $attachment['attachment_type'],
            ]);
        }

        $application = Application::where('applications.tracking_number', '=', $tracking_number)
            ->leftjoin('establishing_schools', 'applications.tracking_number', '=', 'establishing_schools.tracking_number')
            ->select('applications.id', 'applications.registry_type_id','applications.tracking_number', 'establishing_schools.school_name', 'establishing_schools.school_phone',)
            ->first();

        // dd($application);
        if ($application->registry_type_id != 3) {

            $date = Carbon::now()->format('Y-m-d*H:s:i');
            $endDate = Carbon::now()->addDays(7)->format('Y-m-d*23:59:59');

            $bill_amount = Fee::where('fee_code', '=', 'RF')->where('is_active', '=', true)->first();

            $billInfo = [
                'BillId' => $application->tracking_number,
                'pyrid' => $application->school_name,
                'name' => $application->school_name,
                'phone' => $application->school_phone,
                'amount' => $bill_amount->amount,
                'description' => $bill_amount->description,
                'start' => str_replace("*", 'T', $date),
                'end' => str_replace("*", 'T', $endDate),
            ];

            $bill = bill($billInfo);

                //            Log::info($bill);
                //
                //            return json_decode(json_encode($bill), TRUE);
                //
                //            $statusCodetag = "TrxStsCode";
                //            $billIDtag = "BillId";
                //            $controlNumbertag = "PayCntrNum";
                //
                //            $codeData = getDataString($bill,$statusCodetag);
                //            $billData = getDataString($bill,$billIDtag);
                //            $controlNumberData = getDataString($bill,$controlNumbertag);
                //
                //            $codeDataXML =  toXML($codeData);
                //            $billDataXML =  toXML($billData);
                //            $controlNumberDataXML =  toXML($controlNumberData);
                //
                //            $codeDataJSON = toJSON($codeDataXML);
                //            $billDataJSON = toJSON($billDataXML);
                //            $controlNumberDataJSON = toJSON($controlNumberDataXML);
                //
                //            Log::info("codeData ".$codeData);
                //            Log::info($codeDataJSON[0]);
                //            Log::info("billData ". $billData);
                //            Log::info($billDataJSON[0]);
                //            Log::info("controlNumberData ". $controlNumberData);
                //            Log::info($controlNumberDataJSON[0]);

                //            if ($codeDataJSON[0] != 7101) {
                //
                //                Log::debug($bill);
                //                $response = ['message' => 'Ooooop!, kuna tatizo la mtandao wa malipo, lakin ombi lako limetumwa kikamilifu'];
                //                return response()->json($response, 200);
                //            }

                    Application::find($application->id)->update([
                        'control_number' => controlNumber(),
                        'amount' => $billInfo['amount'],
                        'payment_status_id' => 2,  //bypass payment
                        'expire_date' => $billInfo['end'],
                        'is_complete' => 1
                    ]);


                    $response = ['statusCode' => 1,'message' => 'Ombi la kuanzisha shule limetumwa kikamilifu'];
                    return response()->json($response, 200);

        }

        $response = ['statusCode' => 1,'message' => 'Ombi la kuanzisha shule limetumwa kikamilifu'];
        return response()->json($response, 200);
    }

    public function showApplicationsGvt(): JsonResponse
    {

        $applications = Application::with([
            'personal' => function ($query) {
                $query->select('id', 'secure_token', 'first_name', 'middle_name', 'last_name', 'occupation', 'personal_email', 'personal_phone_number', 'identity_type_id', 'personal_id_number', 'personal_address')
                    ->with([
                        'identity_type' => function ($query) {
                            $query->select('id', 'id_type');
                        }
                    ]);
            },
            'institute' => function ($query) {
                $query->select('id', 'secure_token', 'name', 'registration_number', 'institute_email', 'institute_phone', 'box', 'registration_certificate_copy', 'organizational_constitution', 'agreement_document', 'institute_address', 'ward_id')
                    ->with([
                        'village.ward.district.region'
                    ]);
            },
            'category' => function ($query) {
                $query->select('id', 'secure_token', 'app_name');
            },
            'applicant_type' => function ($query) {
                $query->select('id', 'registry');
            },
            'establishing' => function ($query) {
                $query->select('id', 'secure_token', 'school_name', 'school_phone', 'school_email', 'school_size', 'area', 'tracking_number','file_number','school_folio');
            },
            'payment_status' => function($query){
                $query->select('id','status_code','status');
            }
        ])
            ->where('application_category_id', '=', 4)
            ->where('user_id', '=', auth()->user()->id)
            ->select('id', 'secure_token', 'registry_type_id', 'foreign_token', 'application_category_id', 'tracking_number', 'is_approved','is_complete', 'control_number', 'payment_status_id','amount','expire_date')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($applications as $application){

            $attachment = Attachment::where('tracking_number','=',$application->tracking_number)->count('*');
            $application->number_of_attachement = $attachment;
        }

        $response = ['applications' => $applications];
        return response()->json($response, 200);
    }

    public function showApplications(): JsonResponse
    {

        $applications = Application::with([
            'personal' => function ($query) {
                $query->select('id', 'secure_token', 'first_name', 'middle_name', 'last_name', 'occupation', 'personal_email', 'personal_phone_number', 'identity_type_id', 'personal_id_number', 'personal_address')
                    ->with([
                        'identity_type' => function ($query) {
                            $query->select('id', 'id_type');
                        }
                    ]);
            },
            'institute' => function ($query) {
                $query->select('id', 'secure_token', 'name', 'registration_number', 'institute_email', 'institute_phone', 'box', 'registration_certificate_copy', 'organizational_constitution', 'agreement_document', 'institute_address', 'ward_id')
                    ->with([
                        'village.ward.district.region'
                    ]);
            },
            'category' => function ($query) {
                $query->select('id', 'secure_token', 'app_name');
            },
            'applicant_type' => function ($query) {
                $query->select('id', 'registry');
            },
            'establishing' => function ($query) {
                $query->select('id', 'secure_token', 'school_name', 'school_phone', 'school_email', 'school_size', 'area', 'tracking_number','file_number','school_folio');
            },
            'payment_status' => function($query){
                $query->select('id','status_code','status');
            }
        ])
            ->where('application_category_id', '=', 1)
            ->where('user_id', '=', auth()->user()->id)
            ->select('id', 'secure_token', 'registry_type_id', 'foreign_token', 'application_category_id', 'tracking_number', 'is_approved','is_complete', 'control_number', 'payment_status_id','amount','expire_date')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($applications as $application){

            $attachment = Attachment::where('tracking_number','=',$application->tracking_number)->count('*');
            $application->number_of_attachement = $attachment;
        }

        $response = ['applications' => $applications];
        return response()->json($response, 200);
    }

    public function showOwnerAndManagerApplications(): JsonResponse
    {

        $applications = Application::with([
            'personal' => function ($query) {
                $query->select('id', 'secure_token', 'first_name', 'middle_name', 'last_name', 'occupation', 'personal_email', 'personal_phone_number', 'personal_id_number', 'identity_type_id', 'personal_address')
                    ->with([
                        'identity_type' => function ($qr) {
                            $qr->select('id', 'id_type');
                        },
                        'ward.district.region'
                    ]);
            },
            'institute' => function ($query) {
                $query->select('id', 'secure_token', 'name', 'registration_number', 'institute_email', 'institute_phone', 'box', 'ward_id', 'registration_certificate_copy', 'organizational_constitution', 'agreement_document', 'address');
            },
            'category' => function ($query) {
                $query->select('id', 'secure_token', 'app_name');
            },
            'applicant_type' => function ($query) {
                $query->select('id', 'registry');
            },
            'owner' => function($query){
              $query->with([
                  'ownership.owner_type',
                  'denomination',
                  'school' => function ($query) {
                      $query->select('id','secure_token', 'school_name','file_number','school_folio');
                  },
              ])
                  ->select('id','establishing_school_id','tracking_number')
              ;
            },
            'payment_status' => function($query){
                $query->select('id','status_code','status');
            }
        ])
            ->where('application_category_id', '=', 2)
            ->where('user_id', '=', auth()->user()->id)
            ->select('id', 'secure_token', 'registry_type_id', 'foreign_token', 'application_category_id', 'tracking_number', 'is_approved','control_number','updated_at', 'payment_status_id','amount','expire_date')
            ->orderBy('id', 'DESC')
            ->get();

        $response = ['applications' => $applications];
        return response()->json($response, 200);
    }

    public function showRegistrationApplications(): JsonResponse
    {

        $applications = Application::with([
            'personal' => function ($query) {
                $query->select('id', 'secure_token', 'first_name', 'middle_name', 'last_name', 'occupation', 'personal_email', 'personal_phone_number', 'personal_id_number', 'identity_type_id', 'personal_address')
                    ->with([
                        'identity_type' => function ($qr) {
                            $qr->select('id', 'id_type');
                        },
                        'ward.district.region'
                    ]);
            },
            'institute' => function ($query) {
                $query->select('id', 'secure_token', 'name', 'registration_number', 'institute_email', 'institute_phone', 'box', 'ward_id', 'registration_certificate_copy', 'organizational_constitution', 'agreement_document', 'address');
            },
            'category' => function ($query) {
                $query->select('id', 'secure_token', 'app_name');
            },
            'applicant_type' => function ($query) {
                $query->select('id', 'registry');
            },
             'registration' => function($query){
               $query->with([
                   'school' => function ($query) {
                       $query->select('id','secure_token', 'school_name','file_number','school_folio');
                   },
               ])
                   ->select('id','establishing_school_id','tracking_number')
               ;
             },
            'payment_status' => function($query){
                $query->select('id','status_code','status');
            }
        ])
            ->where('application_category_id', '=', 4)
            ->where('user_id', '=', auth()->user()->id)
            ->select('id', 'secure_token', 'registry_type_id', 'foreign_token', 'application_category_id', 'tracking_number', 'is_approved','control_number','updated_at', 'payment_status_id','amount','expire_date')
            ->orderBy('id', 'DESC')
            ->get();

        $response = ['applications' => $applications];
        return response()->json($response, 200);
    }

    public function showApplicationDetails($tracking_number): JsonResponse
    {

        $application = Application::with([
            'maoni',
            'personal' => function ($query) {
                $query->select('id', 'secure_token', 'first_name', 'middle_name', 'last_name', 'occupation', 'personal_email', 'personal_phone_number', 'personal_id_number', 'identity_type_id', 'personal_address')
                    ->with([
                        'identity_type' => function ($qr) {
                            $qr->select('id', 'id_type');
                        },
                        'ward.district.region'
                    ]);
            },
            'institute' => function ($query) {
                $query->select('id', 'secure_token', 'name', 'registration_number', 'institute_email', 'institute_phone', 'box', 'ward_id', 'registration_certificate_copy', 'organizational_constitution', 'agreement_document', 'address','box');
            },
            'category' => function ($query) {
                $query->select('id', 'secure_token', 'app_name');
            },
            'applicant_type' => function ($query) {
                $query->select('id', 'registry');
            },
            'establishing' => function ($query) {
                $query->with([
                    'registration_structure' => function ($query) {
                        $query->select('id', 'structure');
                    },
                    'building_structure' => function ($query) {
                        $query->select('id', 'building');
                    },
                    'category' => function($query){
                        $query->select('id','category');
                    },
                    'subcategory' => function($query){
                        $query->select('id','subcategory');
                    },
                    'village.ward.district.region',
                    'owner' => function ($query) {
                        $query->with([
                            'referees' => function ($qr) {
                                $qr->with([
                                    'village.ward.district.region'
                                ])->select('id', 'owner_id','first_name', 'middle_name', 'last_name', 'occupation', 'ward_id', 'address', 'email', 'phone_number');
                            }
                        ])->select('id', 'establishing_school_id','tracking_number', 'owner_name', 'authorized_person', 'title', 'owner_email', 'phone_number', 'purpose');
                    },
                    'manager' => function ($query) {
                        $query->with([
                            'village.ward.district.region'
                        ])->select('id', 'establishing_school_id', 'tracking_number', 'manager_first_name', 'manager_middle_name', 'manager_last_name', 'occupation', 'house_number', 'street', 'manager_phone_number', 'manager_email', 'education_level', 'expertise_level', 'ward_id');
                    },
                ])
                    ->select('id', 'ward_id', 'village_id', 'registration_structure_id', 'school_category_id', 'school_sub_category_id', 'building_structure_id', 'secure_token', 'school_name', 'school_phone', 'school_email', 'school_size', 'area', 'tracking_number','file_number','school_folio','po_box');
            },
            'attachments' => function ($query) {
                $query->with([
                    'attachment_type' => function($qry){
                    $qry->select('id','attachment_name');
                    }
                ])->select('id', 'attachment_type_id', 'tracking_number', 'attachment_path');
            },
            'payment_status' => function($query){
                $query->select('id','status_code','status');
            }
        ])
            ->where('tracking_number', '=', $tracking_number)
            ->where('user_id', '=', auth()->user()->id)
            ->select('id', 'secure_token', 'registry_type_id', 'foreign_token', 'application_category_id', 'tracking_number', 'is_approved','control_number','updated_at','approved_at', 'payment_status_id','amount','expire_date','folio','approved_at')
            ->first();

        $application_check = Application:: where('tracking_number', '=', $tracking_number)->first();

        if($application_check->is_approved == 2){

        $approve_staff = Maoni::where('maoni.trackingNo', '=', $tracking_number)
                                     ->join('staffs','staffs.id','=','maoni.user_from')
                                     ->select('staffs.*','maoni.coments')
                                     ->latest('maoni.created_at')->first();

        }else{
            $approve_staff = null;

        }


        $application = ['application' => $application,'approve_staff' => $approve_staff];
        $response = ['application' => $application];
        return response()->json($response, 200);
    }

    public function showOwnerAndManagerDetails($tracking_number): JsonResponse
    {

        $application = Application::where('tracking_number', '=', $tracking_number)
            ->with([
                'maoni',
                'owner' => function ($query) {
                    $query->with([
                        'ownership.owner_type',
                        'denomination',
                        'referees' => function ($qr) {
                            $qr->with([
                                'village.ward.district.region'
                            ])->select('id', 'owner_id', 'first_name', 'middle_name', 'last_name', 'occupation', 'ward_id', 'address', 'email', 'phone_number');
                        },
                        'school' => function ($query) {
                            $query->with([
                                'registration_structure' => function ($query) {
                                    $query->select('id', 'structure');
                                },
                                'building_structure' => function ($query) {
                                    $query->select('id', 'building');
                                },
                                'manager' => function ($query) {
                                    $query->with([
                                        'village.ward.district.region'
                                    ])->select('id', 'establishing_school_id', 'tracking_number', 'manager_first_name', 'manager_middle_name', 'manager_last_name', 'occupation', 'house_number', 'street', 'manager_phone_number', 'manager_email', 'education_level', 'expertise_level', 'ward_id');
                                },
                                'village.ward.district.region',
                                'language' => function($query){
                                    $query->select('id','language');
                                },
                                'category' => function($query){
                                    $query->select('id','category');
                                },
                                'subcategory' => function($query){
                                    $query->select('id','subcategory');
                                },
                                'curriculum' => function($query){
                                    $query->select('id','curriculum');
                                }
                            ])->select('id', 'ward_id', 'curriculum_id', 'language_id', 'school_category_id','school_sub_category_id','registration_structure_id', 'building_structure_id', 'secure_token', 'school_name', 'school_phone', 'school_email', 'school_size', 'area', 'tracking_number','stream','file_number','school_folio');
                        }
                    ])->select('id', 'establishing_school_id', 'tracking_number', 'is_manager', 'owner_name', 'authorized_person', 'title', 'owner_email', 'phone_number', 'purpose');
                }
            ])
            ->select('id', 'tracking_number', 'application_category_id', 'is_approved','updated_at','control_number','created_at', 'payment_status_id','amount','expire_date','folio','approved_at')
            ->first();



        $application_check = Application:: where('tracking_number', '=', $tracking_number)->first();

        if($application_check->is_approved == 2){

        $approve_staff = Maoni::where('maoni.trackingNo', '=', $tracking_number)
                                     ->join('staffs','staffs.id','=','maoni.user_from')
                                     ->select('staffs.*','maoni.coments')
                                     ->latest('maoni.created_at')->first();

        }else{
            $approve_staff = null;

        }


        $application = ['application' => $application,'approve_staff' => $approve_staff];
        $response = ['application' => $application];

        return response()->json($response, 200);
    }

    public function showSchoolRegistrationDetails($tracking_number): JsonResponse
    {

        $application = Application::where('tracking_number', '=', $tracking_number)
            ->with([
                'maoni',
                'registration' => function ($query) {
                    $query->with([
                        'school' => function ($qr) {
                            $qr->with([
                                'registration_structure' => function ($query) {
                                    $query->select('id', 'structure');
                                },
                                'building_structure' => function ($query) {
                                    $query->select('id', 'building');
                                },
                                'manager' => function ($query) {
                                    $query->with([
                                        'village.ward.district.region'
                                    ])->select('id', 'establishing_school_id', 'tracking_number', 'manager_first_name', 'manager_middle_name', 'manager_last_name', 'occupation', 'house_number', 'street', 'manager_phone_number', 'manager_email', 'education_level', 'expertise_level', 'ward_id');
                                },
                                'owner' => function ($query) {
                                    $query->with([
                                        'referees' => function ($qr) {
                                            $qr->with([
                                                'village.ward.district.region'
                                            ])->select('id', 'owner_id', 'first_name', 'middle_name', 'last_name', 'occupation', 'ward_id', 'address', 'email', 'phone_number');
                                        }
                                    ])->select('id', 'establishing_school_id', 'is_manager', 'tracking_number', 'owner_name', 'authorized_person', 'title', 'owner_email', 'phone_number', 'purpose');
                                },
                                'village.ward.district.region',
                                'language' => function($query){
                                    $query->select('id','language');
                                },
                                'category' => function($query){
                                    $query->select('id','category');
                                },
                                'subcategory' => function($query){
                                    $query->select('id','subcategory');
                                },
                                'curriculum' => function($query){
                                    $query->select('id','curriculum');
                                }
                            ])
                                ->select('id', 'school_category_id', 'school_sub_category_id', 'po_box', 'school_address', 'ward_id', 'registration_structure_id', 'building_structure_id', 'secure_token', 'curriculum_id', 'sect_name_id', 'number_of_students', 'number_of_teachers', 'school_name', 'school_phone', 'school_email', 'school_size', 'area', 'tracking_number','file_number','school_folio','language_id','stream','website');
                        },
                        'education_level' => function($query){
                             $query->select('id','certificate','level');
                        },
                        'detours.specialization',
                        'combination.combination'
                    ])->select('id', 'tracking_number', 'establishing_school_id', 'school_opening_date', 'level_of_education', 'is_seminary', 'registration_number','updated_at');
                }
            ])
            ->select('id', 'tracking_number', 'registry_type_id', 'application_category_id','is_approved','control_number','created_at', 'payment_status_id','amount','expire_date','folio','approved_at')
            ->first();



        $application_check = Application:: where('tracking_number', '=', $tracking_number)->first();

        if($application_check->is_approved == 2){

        $approve_staff = Maoni::where('maoni.trackingNo', '=', $tracking_number)
                                     ->join('staffs','staffs.id','=','maoni.user_from')
                                     ->select('staffs.*','maoni.coments')
                                     ->latest('maoni.created_at')->first();

        }else{
            $approve_staff = null;

        }


        $application = ['application' => $application,'approve_staff' => $approve_staff];

        $response = ['application' => $application];
        return response()->json($response, 200);
    }

    public function billCallBack(Request $request): JsonResponse
    {
        $billCallback = $request->all();



        $response = ['message' => 'Bill callback successful received'];

        return response()->json($response,200);
    }

    public function paymentCallBack(Request $request): JsonResponse
    {
        $callback = $request->all();


        $response = ['message' => 'Callback successful received'];

        return response()->json($response,200);
    }

    public function attachmentType($application_category,$registry_type_id): JsonResponse
    {



        $attachment_types = Attachment_type::select('attachment_types.id as id', 'app_name', 'file_size', 'file_format', 'attachment_name', 'registry')
            ->join('application_categories', 'application_categories.id', '=', 'attachment_types.application_category_id')
            ->join('registry_types', 'attachment_types.registry_type_id', '=', 'registry_types.id')
            ->where('attachment_types.status_id', '=', '1')
            ->where('attachment_types.application_category_id', '=', $application_category)
            ->where('attachment_types.registry_type_id', '=', $registry_type_id)
            ->get();
            // dd($attachmentTypes);

        $response = ['statusCode' => 1,'attachment_types' => $attachment_types];
        return response()->json($response, 200);
    }

//    public function checkIncomplete(){
//
//        $school = Application::where('user_id','=',auth()->user()->id)
//            ->with([
//                'establishing' => function($query){
//                   $query->with([
//                       'attachments' => function($qr){
//                        $qr->where
//                       }
//                   ]);
//                }
//            ]);
//    }

    /**
     * @param $institute_info
     * @param array $applicaion_data
     * @param $establishment
     * @param Request $request
     * @return JsonResponse
     */
    private function createApplicationRequest($institute_info, array $applicaion_data, $establishment, Request $request): JsonResponse
    {

        $application = $institute_info->applications()->updateOrCreate($applicaion_data);

        $establishment->update([
            'tracking_number' => $applicaion_data['tracking_number']
        ]);


        $attachment_types = Attachment_type::select('attachment_types.id as id', 'app_name', 'file_size', 'file_format', 'attachment_name', 'registry')
        ->join('application_categories', 'application_categories.id', '=', 'attachment_types.application_category_id')
        ->join('registry_types', 'attachment_types.registry_type_id', '=', 'registry_types.id')
        ->where('attachment_types.status_id', '=', '1')
        ->where('attachment_types.application_category_id', '=', $request->input('application_category'))
        ->where('attachment_types.registry_type_id', '=', $applicaion_data['registry_type_id'])
        ->get();
        // dd($application);

        $response = ['statusCode' => 1, 'application' => $application, 'attachment_types' => $attachment_types];
        // Log::debug($response);

        return response()->json($response, 200);
    }
}
