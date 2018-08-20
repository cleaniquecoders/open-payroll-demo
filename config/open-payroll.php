<?php


return [
    'seeds' => [
        'deduction_types' => [
            'Loan',
            'Income Tax',
        ],
        'earning_types' => [
            'Basic',
            'Overtime',
            'Allowance',
            'Bonus',
            'Other',
        ],
        'payroll_statuses' => [
            'Active', 'Inactive', 'Locked',
        ],
        'payslip_statuses' => [
            'Active', 'Inactive', 'Locked',
        ],
    ],
    'models' => [
        'user'             => \App\User::class,
        'employee'         => \App\Models\OpenPayroll\Employee::class,
        'payroll'          => \CleaniqueCoders\OpenPayroll\Models\Payroll\Payroll::class,
        'payroll_statuses' => \CleaniqueCoders\OpenPayroll\Models\Payroll\Status::class,
        'payslip'          => \CleaniqueCoders\OpenPayroll\Models\Payslip\Payslip::class,
        'payslip_statuses' => \CleaniqueCoders\OpenPayroll\Models\Payslip\Status::class,
        'deduction'        => \CleaniqueCoders\OpenPayroll\Models\Deduction\Deduction::class,
        'deduction_types'  => \CleaniqueCoders\OpenPayroll\Models\Deduction\Type::class,
        'earning'          => \CleaniqueCoders\OpenPayroll\Models\Earning\Earning::class,
        'earning_types'    => \CleaniqueCoders\OpenPayroll\Models\Earning\Type::class,
    ],
    'tables' => [
        'names' => [
            'earnings',
            'deductions',
            'payslips',
            'payrolls',
            'payroll_statuses',
            'earning_types',
            'deduction_types',
        ],
    ],
];
