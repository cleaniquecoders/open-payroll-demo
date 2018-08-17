<?php

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
	public $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = \Faker\Factory::create();
    	$this->seedEmployees();
        $this->seedPayroll();
        $this->calculatePayroll();
    }

    private function seedEmployees()
    {
        $this->command->info('Seeding employees...');
    	factory(\App\Models\Employee::class, 3)->create()->each(function($user){
    		$user->addresses()->create([
    			'primary' => $this->faker->address,
    			'postcode' => $this->faker->postcode,
    			'city' => $this->faker->city,
    			'state' => $this->faker->state,
    			'country_id' => $this->faker->randomElement(range(1, 100)),
    			'is_default' => true,
    		]);

    		$user->phones()->create([
    			'phone_type_id' => $this->faker->randomElement([1,2]),
    			'phone_number' => $this->faker->phoneNumber,
    			'is_default' => true,
    		]);

    		$user->banks()->create([
    			'bank_id' => $this->faker->randomElement(range(1, 50)),
    			'account_no' => $this->faker->bankAccountNumber,
    		]);

    		$user->position()->create([
    			'name' => $this->faker->jobTitle,
    		]);

    		$user->salary()->create([
    			'amount' => $this->faker->randomElement(range(10000, 20000)) * 100,
    		]);
    	});
    }

    private function seedPayroll()
    {
        $this->command->info('Seeding payroll...');
    	$admin = \App\Models\Admin::create([
            'name' => 'OpenPayroll Admin',
            'email' => 'admin@openpayroll.com',
            'password' => bcrypt('password')
        ]);

        for ($month = 1; $month <= 12; $month++) { 
            $admin->payrolls()->create([
                'month' => now()->addMonths($month)->format('n'),
                'year' => now()->addMonths($month)->format('Y'),
                'date' => now()->addMonths($month)->format('Y-m-d')
            ]);
        }
    }

    private function calculatePayroll()
    {
        $payrolls = \App\Models\Payroll::all();

        \App\Models\Employee::with('salary')->get()->each(function($employee) use ($payrolls) {
            $payrolls->each(function($payroll) use ($employee) {
                $payroll->payslips()->create([
                    'user_id' => $employee->id,
                    'payroll_id' => $payroll->id,
                    'basic_salary' => optional($employee->salary)->amount ?? 0,
                    'gross_salary' => optional($employee->salary)->amount ?? 0,
                    'net_salary' => optional($employee->salary)->amount ?? 0,
                ]);

                $payslip = $payroll->payslips()->first();
                
                // earnings
                config('open-payroll.models.earning')::create([
                    'user_id' => $employee->id,
                    'payroll_id' => $payroll->id,
                    'payslip_id' => $payslip->id,
                    'earning_type_id' => 1,
                    'name' => 'Basic Salary',
                    'description' => 'Basic Salary',
                    'amount' => optional($employee->salary)->amount ?? 0,
                ]);
                
                // deduction
                // @todo
            });
        });
    }
}
