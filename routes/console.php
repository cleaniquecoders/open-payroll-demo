<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('seed:demo', function () {
	$this->info('Remigrate & seeding...');
	Artisan::call('migrate:fresh', ['--seed' => true]);
	$this->info('Seeding profile references...');
    Artisan::call('profile:seed');
    $this->info('Seeding demo data...');
    Artisan::call('db:seed', ['--class' => 'DemoSeeder']);
})->describe('Seed Demo Data');
