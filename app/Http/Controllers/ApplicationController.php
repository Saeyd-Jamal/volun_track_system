<?php

namespace App\Http\Controllers;

use App\Models\VolunteerApplication;
use App\Http\Requests\ApplicationRequest;
use App\Models\Constant;
use App\Models\Specialization;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(){

        // Get constants and specializations
        $constants = Constant::get();
        $cities = $constants->where('key', 'cities')->select('value')->first() ? json_decode($constants->where('key', 'cities')->select('value')->first()['value']) : [];
        $universities = $constants->where('key', 'universities')->select('value')->first() ? json_decode($constants->where('key', 'universities')->select('value')->first()['value']) : [];
        $volunteer_places = $constants->where('key', 'volunteer_places')->select('value')->first() ? json_decode($constants->where('key', 'volunteer_places')->select('value')->first()['value']) : [];
        $skills = $constants->where('key', 'skills')->select('value')->first() ? json_decode($constants->where('key', 'skills')->select('value')->first()['value']) : [];

        $specializations = Specialization::active()->get();
        return view('index', compact('specializations', 'cities', 'universities', 'volunteer_places', 'skills'));
    }

    public function store(ApplicationRequest $request){
        $application = VolunteerApplication::create($request->all());

        return redirect()->route('application.msg');
    }

    public function msg(){
        return view('msg');
    }

    public function checkEmail(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $application = VolunteerApplication::where('email', $request->email)->first();

        if($application){
            return response()->json([
                'exists' => true,
            ]);
        }

        return response()->json([
            'exists' => false,
        ]);
    }
}
