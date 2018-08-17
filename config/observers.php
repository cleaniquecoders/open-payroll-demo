<?php


return [
    \CleaniqueCoders\LaravelObservers\Observers\ReferenceObserver::class => [],
    \CleaniqueCoders\LaravelObservers\Observers\HashidsObserver::class   => [
    	\App\Models\Employee::class,
    	\App\Models\Position::class,
    	\App\Models\Salary::class,
    	\App\Models\Admin::class,
    	\App\Models\Payroll::class,
    	\App\Models\Payslip::class,
    	\App\Models\Earning::class,
    	\App\Models\Deduction::class,
    ],
];
