<?php

namespace App\Http\Controllers\OpenPayroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __invoke(Request $request)
    {
    	$earning_types = \App\Models\OpenPayroll\EarningType::all();
    	$deduction_types = \App\Models\OpenPayroll\DeductionType::all();
    	return view('open-payroll.settings.index', compact('earning_types', 'deduction_types'));
    }
}
