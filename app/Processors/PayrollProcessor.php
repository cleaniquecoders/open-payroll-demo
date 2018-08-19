<?php 

namespace App\Processors;

use App\Models\Payroll;
use App\Contracts\CalculateContract;

class PayrollProcessor implements CalculateContract
{
	public $payroll;

	public function __construct($identifier = null)
	{
		$this->payroll = Payroll::query()
			->with('payslips', 'payslips.earnings', 'payslips.deductions', 'payslips.employee', 'payslips.employee.salary')
			->whereId($identifier)
			->orWhere('hashslug', $identifier)
			->firstOrFail();
	}

	public static function make($identifier = null)
	{
		return new self($identifier);
	}

	public function payroll(Payroll $payroll)
	{
		$this->payroll = $payroll;
		return $this;
	}

	public function calculate()
	{
		$this->payroll->payslips->each(function($payslip){
			payslip($payslip)->calculate();
		});
		return $this;
	}
}