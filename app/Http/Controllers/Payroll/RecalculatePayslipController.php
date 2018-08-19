<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecalculatePayslipController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        payslip($id)->calculate();

        swal()->success('Payroll', 'You have successfully recalculate a payslip.');

    	return redirect()->route('payslip.show', $id);
    }
}
