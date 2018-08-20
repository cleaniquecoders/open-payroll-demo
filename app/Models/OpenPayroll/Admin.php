<?php

namespace App\Models\OpenPayroll;

class Admin extends Employee
{
    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'user_id');
    }
}
