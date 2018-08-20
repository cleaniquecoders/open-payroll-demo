<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Open Payroll Web Routes
|--------------------------------------------------------------------------
*/

Route::namespace('OpenPayroll')
	->prefix('OpenPayroll')
	->as('open-payroll.')
	->group(function(){
		Route::resource('payroll', 'PayrollController');
		Route::resource('payslip', 'PayslipController');
		Route::resource('earning', 'EarningController');
		Route::resource('deduction', 'DeductionController');
		Route::get('recalculate/payslip/{id}', 'RecalculatePayslipController')->name('payslip.recalculate');
		Route::get('recalculate/payroll/{id}', 'RecalculatePayrollController')->name('payroll.recalculate');

		Route::get('setting', 'SettingController')->name('setting.index');

		Route::namespace('Setting')
			->prefix('setting')
			->as('setting.')
			->group(function(){
				Route::resource('deduction', 'DeductionController');
				Route::resource('earning', 'DeductionController');
			});
	});