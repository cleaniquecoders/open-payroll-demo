<?php 

namespace App\Models;

use CleaniqueCoders\OpenPayroll\Models\Payslip\Payslip as OPPayslip;

class Payslip extends OPPayslip
{
	public function getTitleAttribute()
	{
		return 'Payslip from ' . $this->payroll->title; 
	}

	public function earnings()
	{
		return $this->hasMany(Earning::class);
	}

	public function deductions()
	{
		return $this->hasMany(Deduction::class);
	}

}