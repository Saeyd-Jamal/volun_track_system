<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\FormSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormSettingController extends Controller
{
    public function edit()
    {
        $setting =FormSetting::first(); 

       
    if (!$setting) {
        $setting = FormSetting::create([
            'form_status' => 'open',
            'form_open_at' => now(),
            'form_close_at' => now()->addDays(30),
        ]);
    }

        return view('dashboard.form_settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'form_status' => 'required|in:open,closed',
            'form_open_at' => 'nullable|date',
            'form_close_at' => 'nullable|date|after_or_equal:form_open_at',
        ]);

        $setting = FormSetting::first();
        $setting->update($request->only(['form_status', 'form_open_at', 'form_close_at']));

        return redirect()->back()->with('success', 'تم تحديث إعدادات النموذج بنجاح');
    }
}
