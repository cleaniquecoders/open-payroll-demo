<?php

namespace App\Http\Controllers\OpenPayroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecalculatePayrollController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        payroll($id)->calculate();

        swal()->success('Payroll', 'You have successfully recalculate all paylips.');

        return redirect()->route('open-payroll.payroll.show', $id);
    }
}
