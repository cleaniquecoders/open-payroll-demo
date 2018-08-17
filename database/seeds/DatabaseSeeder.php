<?php

use CleaniqueCoders\OpenPayroll\Traits\ReferenceTrait;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	use ReferenceTrait;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->seedReferences();
    }
}
