<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCrops = Crop::count();
        $cropsByStage = Crop::groupBy('growth_stage')
            ->selectRaw('growth_stage, count(*) as count')
            ->get();
        $healthReport = Crop::groupBy('health_status')
            ->selectRaw('health_status, count(*) as count')
            ->get();

        return view('admin.dashboard', compact('totalCrops', 'cropsByStage', 'healthReport'));
    }
}