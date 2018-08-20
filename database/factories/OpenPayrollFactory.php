<?php


use Faker\Generator as Faker;

$factory->define(\App\Models\OpenPayroll\Employee::class, function(Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => bcrypt('password'),
    ];
});

$factory->define(\CleaniqueCoders\OpenPayroll\Models\Payroll\Payroll::class, function(Faker $faker) {
    return [
    ];
});

$factory->define(\CleaniqueCoders\OpenPayroll\Models\Payslip\Payslip::class, function(Faker $faker) {
    return [
        'total_earning'   => 0,
        'total_deduction' => 0,
        'basic_salary'    => 0,
        'gross_salary'    => 0,
        'net_salary'      => 0,
    ];
});

$factory->define(\CleaniqueCoders\OpenPayroll\Models\Deduction\Deduction::class, function(Faker $faker) {
    return [
        'name'              => $faker->sentence,
        'description'       => $faker->sentence,
        'amount'            => $faker->numberBetween(10000, 20000),
        'deduction_type_id' => $faker->randomElement([1, 2]),
    ];
});

$factory->define(\CleaniqueCoders\OpenPayroll\Models\Earning\Earning::class, function(Faker $faker) {
    return [
        'name'            => $faker->sentence,
        'description'     => $faker->sentence,
        'amount'          => $faker->numberBetween(10000, 20000),
        'earning_type_id' => $faker->randomElement([1, 2]),
    ];
});
