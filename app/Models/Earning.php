<?php 

namespace App\Models;

use CleaniqueCoders\OpenPayroll\Models\Earning\Earning as OPEarning;

class Earning extends OPEarning
{
	public function type()
    {
        return $this->belongsTo(config('open-payroll.models.earning_types'), 'earning_type_id');
    }
}