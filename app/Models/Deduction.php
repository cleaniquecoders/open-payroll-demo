<?php 

namespace App\Models;

use CleaniqueCoders\OpenPayroll\Models\Deduction\Deduction as OPDeduction;

class Deduction extends OPDeduction
{
	public function type()
    {
        return $this->belongsTo(config('open-payroll.models.deduction_types'), 'deduction_type_id');
    }
}