<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\VolunteerApplication;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // عرض الطلبات الخاصة بالمراجع الحالي
    public function index()
    {
        $user = Auth::user();
        $request = request();
        $status = $request->status;
        if ($user->role ==  'admin') {
            if ($status != null) {
                $applications = VolunteerApplication::where('status', $status)->get();
            } else {
                $applications = VolunteerApplication::get();
            }
        } else {
            $applications = VolunteerApplication::forReviewer($user)->get();
        }
        return view('dashboard.reviewers.index', compact('applications'));
    }

    public function show($id)
    {
        $app = VolunteerApplication::findOrFail($id);
        return view('dashboard.reviewers.details', compact('app')); // تستخدم داخل الـ Modal فقط
    }

    public function decision(Request $request, $id)
    {
        $app = VolunteerApplication::findOrFail($id);
        $decision = $request->input('decision');
        $reason = $request->input('reason');

        if ($decision === 'reject') {
            $app->reject(Auth::user(), $reason);
        } else {
            $app->moveToNextLevel();
        }

        // تسجيل الحدث
        ActivityLogService::log(
            'Updated',
            'VolunteerApplication',
            "تم تعديل طلب التطوع.",
            $app->getOriginal(),
            $app->getChanges()
        );

        return response()->json(['success' => true]);
    }
}
