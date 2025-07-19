<?php

namespace App\Http\Controllers;

use App\Models\VolunteerApplication;
use App\Http\Requests\ApplicationRequest;
use App\Models\ApprovalHierarchy;
use App\Models\ApprovalTracking;
use App\Models\Constant;
use App\Models\Specialization;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {

        $constants = Constant::get();

        $citiesValue = optional($constants->where('key', 'cities')->first())->value;
        $universitiesValue = optional($constants->where('key', 'universities')->first())->value;
        $volunteerPlacesValue = optional($constants->where('key', 'volunteer_places')->first())->value;

        $cities = is_string($citiesValue) ? json_decode($citiesValue, true) : [];
        $universities = is_string($universitiesValue) ? json_decode($universitiesValue, true) : [];
        $volunteer_places = is_string($volunteerPlacesValue) ? json_decode($volunteerPlacesValue, true) : [];

        $specializations = Specialization::active()->get();

        return view('index', compact(
            'specializations',
            'cities',
            'universities',
            'volunteer_places'

        ));
    }

    public function store(ApplicationRequest $request)
    {
        DB::beginTransaction();
        try {
            $request['skills'] = is_array($request['skills']) ? implode(', ', $request['skills']) : null;

            if ($request->file) {
                $file = $request->file('file');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $path = Storage::storeAs('uploads', $file, $file_name)->disk('public');
                $request['file'] = $path;
            }

            $application = VolunteerApplication::create($request->all());

            $firstHierarchy = ApprovalHierarchy::where('specialization_id', $application->specialization_id)
                ->orderBy('order_sequence')
                ->first();

            if ($firstHierarchy) {
                ApprovalTracking::create([
                    'volunteer_application_id' => $application->id,
                    'approval_hierarchy_id' => $firstHierarchy->id,
                    'action' => 'pending',
                    'approved_by' => null,
                    'notes' => null,
                    'action_date' => null,
                ]);
            }

            DB::commit();
            return redirect()->route('application.msg', ['msg_type' => 'done']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
            return abort(500);
        }
    }

    public function msg($msg_type = 'done')
    {
        return view('msg', compact('msg_type'));
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $application = VolunteerApplication::where('email', $request->email)->first();

        if ($application) {
            return response()->json([
                'exists' => true,
            ]);
        }

        return response()->json([
            'exists' => false,
        ]);
    }
}
