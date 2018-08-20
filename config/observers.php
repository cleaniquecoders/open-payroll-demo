<?php


return [
    \CleaniqueCoders\LaravelObservers\Observers\ReferenceObserver::class => [],
    \CleaniqueCoders\LaravelObservers\Observers\HashidsObserver::class   => [
    	\App\Models\OpenPayroll\Employee::class,
    	\App\Models\OpenPayroll\Position::class,
    	\App\Models\OpenPayroll\Salary::class,
    	\App\Models\OpenPayroll\Admin::class,
    	\App\Models\OpenPayroll\Payroll::class,
        \App\Models\OpenPayroll\Payslip::class,
    	\App\Models\OpenPayroll\Earning::class,
    	\App\Models\OpenPayroll\Deduction::class,
    ],
];
