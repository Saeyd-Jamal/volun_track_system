<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use App\Models\Employee;
use App\Models\WorkData;
use Illuminate\Http\Request;

class ConstantController extends Controller
{
    public function edit()
    {
        $constants = Constant::whereIn('key', ['cities', 'universities', 'volunteering_places'])
            ->get()
            ->keyBy('key');

        return view('dashboard.constant', compact('constants'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'cities' => 'array',
            'cities.*' => 'string',
            'universities' => 'array',
            'universities.*' => 'string',
            'volunteering_places' => 'array',
            'volunteering_places.*' => 'string',
        ]);

        foreach ($data as $key => $values) {
            Constant::updateOrCreate(
                ['key' => $key],
                ['value' => array_values($values)] 
            );
        }

        return redirect()->back()->with('success', 'تم تحديث الثوابت بنجاح');
    }
    
}
