<?php

namespace App\Http\Controllers\OpenPayroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __invoke(Request $request)
    {
    	return view('settings.index');
    }
}
