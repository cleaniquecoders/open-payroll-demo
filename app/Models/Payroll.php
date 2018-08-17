<?php 

namespace App\Models;

use CleaniqueCoders\OpenPayroll\Models\Payroll\Payroll as OpenPayroll;

class Payroll extends OpenPayroll
{
	protected $casts = [
		'month' => 'datetime:n',
		'year' => 'datetime:Y',
		'date' => 'datetime:Y-m-d',
	];
}