<?php

namespace App\Http\Controllers\API\MetaData;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Application_category;
use App\Models\Application_status;
use App\Models\Attachment_type;
use App\Models\Building_structure;
use App\Models\Building_type;
use App\Models\Certificate_type;
use App\Models\Class_room;
use App\Models\Curriculum;
use App\Models\Denomination;
use App\Models\District;
use App\Models\Establishing_school;
use App\Models\Identity_type;
use App\Models\Institute_info;
use App\Models\Language;
use App\Models\Ownership_sub_type;
use App\Models\Ownership_type;
use App\Models\Personal_info;
use App\Models\Region;
use App\Models\Street;
use App\Models\Registration_structure;
use App\Models\Registry_type;
use App\Models\School_category;
use App\Models\School_gender_type;
use App\Models\School_specialization;
use App\Models\School_sub_category;
use App\Models\Sect_name;
use App\Models\Ward;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MetaDataController extends Controller
{
    public function regions(): JsonResponse
    {

        $regions = Region::get();

        $response = ['regions' => $regions];

        return response()->json($response,200);
    }

    public function districts($RegionCode): JsonResponse
    {

        $districts = District::where('RegionCode','=',$RegionCode)->get();

        $response = ['districts' => $districts];

        return response()->json($response,200);
    }

    public function streets($wardCode): JsonResponse
    {

        $streets = Street::where('wardCode','=',$wardCode)->get();

        $response = ['streets' => $streets];

        return response()->json($response,200);
    }

    public function wards($LgaCode): JsonResponse
    {

        $wards = Ward::where('LgaCode','=',$LgaCode)->get();

        $response = ['wards' => $wards];

        return response()->json($response,200);
    }

    public function identity(): JsonResponse
    {

        $identity = Identity_type::get();

        $response = ['identity' => $identity];

        return response()->json($response,200);
    }

    public function curricula(): JsonResponse
    {

        $curricula = Curriculum::get();

        $response = ['curricula' => $curricula];

        return response()->json($response,200);
    }

    public function certificate($id): JsonResponse
    {

        $certificate = Certificate_type::where('school_category_id','=',$id)->get();

        $response = ['certificate' => $certificate];

        return response()->json($response,200);
    }

    public function sect(): JsonResponse
    {

        $sect = Sect_name::get();

        $response = ['sect' => $sect];

        return response()->json($response,200);
    }

    public function buildingStructure(): JsonResponse
    {

        $structure = Building_structure::get();

        $response = ['structure' => $structure];

        return response()->json($response,200);
    }

    public function schoolCategory(): JsonResponse
    {

        $category = School_category::get();

        $response = ['category' => $category];

        return response()->json($response,200);
    }

    public function SchoolSubCategory(): JsonResponse
    {

        $subCategory = School_sub_category::get();


        $response = ['subCategory' => $subCategory];

        return response()->json($response,200);
    }

    public function applicationCategory(): JsonResponse
    {

        $app_categories = Application_category::where('id','>',4)
            ->select('id','app_name')
            ->get();

        $response = ['app_categories' => $app_categories];

        return response()->json($response,200);
    }

    public function applicationStatus(): JsonResponse
    {

        $app_statuses = Application_status::get();

        $response = ['app_statuses' => $app_statuses];

        return response()->json($response,200);
    }

    public function registrationStructure(): JsonResponse
    {

        $reg_structures = Registration_structure::get();

        $response = ['reg_structures' => $reg_structures];

        return response()->json($response,200);
    }

    public function classRooms(): JsonResponse
    {

        $classes = Class_room::get();

        $response = ['classes' => $classes];

        return response()->json($response,200);
    }

    public function buildingTypes(): JsonResponse
    {

        $building_types = Building_type::get();

        $response = ['building_types' => $building_types];

        return response()->json($response,200);
    }

    public function registryTypes(): JsonResponse
    {

        $registry_types = Registry_type::where('id','!=',3)->get();

        $response = ['registry_types' => $registry_types];

        return response()->json($response,200);
    }

    public function schoolGenderTypes(): JsonResponse
    {

        $gender_types = School_gender_type::get();

        $response = ['gender_types' => $gender_types];

        return response()->json($response,200);
    }

    public function languages(): JsonResponse
    {

        $languages = Language::get();

        $response = ['languages' => $languages];

        return response()->json($response,200);
    }

    public function instituteAttachments($id): JsonResponse
    {

        $attachment_types = Attachment_type::where('registry_type_id', '=', $id)
            ->where('status_id','=',1)
            ->select('id', 'secure_token', 'attachment_name')
            ->get();

        $response = ['attachment_types' => $attachment_types];

        return response()->json($response, 200);
    }

    public function attachmentsTypes($id): JsonResponse
    {

        $attachment_types = Attachment_type::where('application_category_id', '=', $id)
            ->select('id', 'secure_token', 'attachment_name')
            ->get();

        $response = ['attachment_types' => $attachment_types];

        return response()->json($response, 200);
    }

    public function addInstituteAttachments(Request $request): JsonResponse
    {

        $registry = $request->input('registry_type');

//        return response()->json(['request' => $request->attachment_names]);

        foreach ($request->input('attachment_names') as $attachment_name){

                Attachment_type::create([
                    'registry_type_id' => $registry,
                    'attachment_name' => $attachment_name,
                ]);

        }

        $response = ['message' => 'Institute attachments added successful'];

        return response()->json($response,200);
    }

    public function addAttachments(Request $request): JsonResponse
    {

        $registry = $request->input('application_type');

        foreach ($request->attachment_names as $attachment_name){
            Attachment_type::create([
                'application_category_id' => $registry,
                'attachment_name' => $attachment_name,
            ]);
        }

        $response = ['message' => 'Attachments added successful'];

        return response()->json($response,200);

    }

    public function schoolSpecialization(): JsonResponse
    {

        $specialisation = School_specialization::get();

        $response = ['specialisation' => $specialisation];

        return response()->json($response,200);
    }

    public function ownership_types(): JsonResponse
    {

        $ownership_types = Ownership_type::get();

        $response = ['ownership_types' => $ownership_types];

        return response()->json($response,200);
    }

    public function ownership_sub_types($id): JsonResponse
    {

        $ownership_sub_types = Ownership_sub_type::where('ownership_type_id','=',$id)->get();

        $response = ['ownership_sub_types' => $ownership_sub_types];

        return response()->json($response,200);
    }

    public function denominations($id): JsonResponse
    {

        $denominations = Denomination::where('ownership_sub_type_id','=',$id)->get();

        $response = ['denominations' => $denominations];

        return response()->json($response,200);
    }

}
