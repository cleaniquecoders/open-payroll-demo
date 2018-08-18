<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecalculatePayslipController extends Controller
{
    public function __invoke(Request $request, $id)
    {
    	$payslip = \App\Models\Payslip::whereHashslug($id)->with('earnings', 'deductions', 'payroll', 'employee', 'employee.salary')->firstOrFail();

    	$employee = $payslip->employee;
    	$salary = $employee->salary;
    	$payroll = $payslip->payroll;
    	$earnings = $payslip->earnings;
    	$deductions = $payslip->deductions;
    	
    	$payslip->basic_salary = $salary->amount;
    	$payslip->gross_salary = $gross_salary = ($earnings->sum('amount') + $salary->amount);
    	$payslip->net_salary = $gross_salary - $deductions->sum('amount');

    	$payslip->save();

    	return redirect()->route('payslip.show', $payslip->hashslug);
    }
}
