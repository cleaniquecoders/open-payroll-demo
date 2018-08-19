<?php 

namespace App\Processors;

use App\Models\Payslip;
use App\Contracts\CalculateContract;

class PayslipProcessor implements CalculateContract
{
	public $payslip;

	public function __construct($identifier = null)
	{
		if(!is_null($identifier)) {
			if(is_string($identifier) || is_int($identifier)) {
				$this->payslip = Payslip::query()
					->with('earnings', 'deductions', 'payroll', 'employee', 'employee.salary')
					->whereId($identifier)
					->orWhere('hashslug', $identifier)
					->firstOrFail();		
			}
			
			if(is_object($identifier)) {
				$this->payslip($identifier);
			}
		}
	}

	public static function make($identifier = null)
	{
		return new self($identifier);
	}

	public function payslip(Payslip $payslip)
	{
		$this->payslip = $payslip;
		return $this;
	}

	public function calculate()
	{
		if($this->payslip) {
			$employee = $this->payslip->employee;
	    	$salary = $employee->salary;
	    	$payroll = $this->payslip->payroll;
	    	$earnings = $this->payslip->earnings;
	    	$deductions = $this->payslip->deductions;
	    	
	    	$this->payslip->basic_salary = $salary->amount;
	    	$this->payslip->gross_salary = $gross_salary = ($earnings->sum('amount') + $salary->amount);
	    	$this->payslip->net_salary = $gross_salary - $deductions->sum('amount');

	    	$this->payslip->save();
		}
		return $this;
	}
}