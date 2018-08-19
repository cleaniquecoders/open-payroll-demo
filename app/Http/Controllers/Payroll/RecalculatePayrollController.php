<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecalculatePayrollController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        payrollProcessor($id)->calculate();

        swal()->success('Payroll', 'You have successfully recalculate all paylips.');

    	return redirect()->route('payroll.show', $id);
    }
}
