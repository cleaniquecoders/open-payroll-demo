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
        'payroll'          => \App\Models\Payroll::class,
        'payroll_statuses' => \CleaniqueCoders\OpenPayroll\Models\Payroll\Status::class,
        'payslip'          => \App\Models\Payslip::class,
        'payslip_statuses' => \CleaniqueCoders\OpenPayroll\Models\Payslip\Status::class,
        'deduction'        => \App\Models\Deduction::class,
        'deduction_types'  => \CleaniqueCoders\OpenPayroll\Models\Deduction\Type::class,
        'earning'          => \App\Models\Earning::class,
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
