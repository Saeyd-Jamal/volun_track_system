<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\VolunteerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // عرض الطلبات الخاصة بالمراجع الحالي
    public function index()
    {
        $user = Auth::user();
        if($user->role ==  'admin') {
            $applications = VolunteerApplication::where('status', 'approved')->get();
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

        return response()->json(['success' => true]);
    }

}
