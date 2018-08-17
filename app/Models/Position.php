<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $guarded = ['id'];

    public function employee()
    {
    	return $this->belongsTo(\App\Models\Employee::class, 'user_id');
    }
}
