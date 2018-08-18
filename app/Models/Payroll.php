<?php 

namespace App\Models;

use CleaniqueCoders\OpenPayroll\Models\Payroll\Payroll as OpenPayroll;

class Payroll extends OpenPayroll
{
	protected $casts = [
		'date' => 'datetime:Y-m-d',
	];

	public function getTitleAttribute()
	{
		return 'Payroll for ' . \Carbon\Carbon::parse($this->year . '-' . $this->month . '-1')->format('M') . ' ' . $this->year;
	}
}