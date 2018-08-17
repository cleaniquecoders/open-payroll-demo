<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        /** References Data */
        Schema::create('payroll_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->name();
            $table->code();
            $table->is('locked');
            $table->timestamps();
        });

        Schema::create('payslip_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->name();
            $table->code();
            $table->is('locked');
            $table->timestamps();
        });

        Schema::create('deduction_types', function (Blueprint $table) {
            $table->increments('id');
            $table->name();
            $table->code();
            $table->is('locked');
            $table->timestamps();
        });

        Schema::create('earning_types', function (Blueprint $table) {
            $table->increments('id');
            $table->name();
            $table->code();
            $table->is('locked');
            $table->timestamps();
        });

        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->hashslug();

            $table->user();
            
            $table->unsignedTinyInteger('month')->comment('Payroll for Month');
            $table->unsignedSmallInteger('year')->comment('Payroll for Year');
            $table->date('date')->comment('Pay Date / Pay Day');

            $table->is('locked', false);

            $table->standardTime();
        });

        Schema::create('payslips', function (Blueprint $table) {
            $table->increments('id');
            $table->hashslug();
            
            $table->user();
            $table->belongsTo('payrolls');
            
            $table->amount('total_earning')->comment('Total Earning');
            $table->amount('total_deduction')->comment('Total Deduction');

            $table->amount('basic_salary')->comment('Total Basic Salary');
            $table->amount('gross_salary')->comment('Total Gross Salary');
            $table->amount('net_salary')->comment('Total Net Salary');

            $table->addAcceptance('verified');
            $table->addAcceptance('approved');
            $table->addAcceptance('locked');

            $table->standardTime();
        });

        Schema::create('earnings', function (Blueprint $table) {
            $table->increments('id');
            $table->hashslug();

            $table->user();
            $table->belongsTo('payrolls');
            $table->belongsTo('payslips');
            $table->belongsTo('earning_types');

            $table->name();
            $table->description();
            $table->amount();

            $table->standardTime();
        });

        Schema::create('deductions', function (Blueprint $table) {
            $table->increments('id');
            $table->hashslug();

            $table->user();
            $table->belongsTo('payrolls');
            $table->belongsTo('payslips');
            $table->belongsTo('deduction_types');

            $table->name();
            $table->description();
            $table->amount();

            $table->standardTime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        foreach (config('open-payroll.tables.names') as $table) {
            Schema::dropIfExists($table);
        }
        Schema::enableForeignKeyConstraints();
    }
}