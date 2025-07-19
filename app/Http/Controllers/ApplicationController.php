<?php

namespace App\Http\Controllers;

use App\Models\VolunteerApplication;
use App\Http\Requests\ApplicationRequest;
use App\Models\ApprovalHierarchy;
use App\Models\Constant;
use App\Models\Specialization;
use App\Services\ActivityLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {

        $constants = Constant::whereIn('key', ['cities', 'universities', 'volunteer_places'])
            ->get()
            ->pluck('value', 'key')
            ->mapWithKeys(function ($value, $key) {
                // دعم للحالتين: string أو decoded مسبقًا
                if (is_array($value)) {
                    return [$key => $value];
                }

                $decoded = json_decode($value, true);

                return [$key => is_array($decoded) ? $decoded : []];
            });

        $cities = $constants['cities'] ?? [];
        $universities = $constants['universities'] ?? [];
        $volunteer_places = $constants['volunteer_places'] ?? [];
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
                // تسجيل الحدث
                ActivityLogService::log(
                    'Created',
                    'VolunteerApplication',
                    "تم إضافة طلب التطوع.",
                    $application->getOriginal(),
                    $application->getChanges()
                );
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
