<?php

namespace App\Http\Controllers\OpenPayroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecalculatePayslipController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        payslip($id)->calculate();

        swal()->success('Payroll', 'You have successfully recalculate a payslip.');

        return redirect()->route('open-payroll.payslip.show', $id);
    }
}
