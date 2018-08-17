<?php 

namespace App\Models;

use CleaniqueCoders\OpenPayroll\Models\Payroll\Payroll as OpenPayroll;

class Payroll extends OpenPayroll
{
	protected $casts = [
		'date' => 'datetime:Y-m-d',
	];
}