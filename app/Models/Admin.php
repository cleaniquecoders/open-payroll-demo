<?php 

namespace App\Models;

use App\User;

class Admin extends Employee
{
	public function payrolls()
	{
		return $this->hasMany(Payroll::class, 'user_id');
	}
}