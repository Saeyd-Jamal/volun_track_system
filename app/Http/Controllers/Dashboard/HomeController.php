<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){

        
        $total = DB::table('approval_trackings')->count();

        $counts = DB::table('approval_trackings')
            ->selectRaw("action, COUNT(*) as count")
            ->groupBy('action')
            ->pluck('count', 'action');

        $data = [
            'pending' => $counts['pending'] ?? 0,
            'approved' => $counts['approved'] ?? 0,
            'rejected' => $counts['rejected'] ?? 0,
            'total' => $total,
        ];

        return view('dashboard.index' , compact('data'));
    }
}

