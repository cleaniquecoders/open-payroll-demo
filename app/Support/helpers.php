<?php 

if(!function_exists('getYesNoClassName')) {
	function getYesNoClassName($value)
	{
		return ($value) ? 'success' : 'danger';
	}	
}


if(!function_exists('payrollProcessor')) {
	function payrollProcessor($identifier)
	{
		return \App\Processors\PayrollProcessor::make($identifier);
	}
}

if(!function_exists('payslip')) {
	function payslip($identifier)
	{
		return \App\Processors\PayslipProcessor::make($identifier);
	}
}