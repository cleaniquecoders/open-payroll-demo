@extends('layouts.open-payroll')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">
						{{ $payslip->title }}
						<a href="{{ route('payslip.recalculate', $payslip->hashslug) }}" class="btn btn-sm btn-warning border-warning float-right">Recalculate</a>
					</div>
					<div class="card-body">
						<table class="table table-hover table-condensed">
							<tr>
								<th class="text-right">
									Employee Name:
								</th>
								<td class="text-left">
									{{ $payslip->user->name }}
								</td>
							</tr>
							<tr>
								<th class="text-right">
									Position:
								</th>
								<td class="text-left">
									{{ optional($payslip->user->position)->name ?? '-' }}
								</td>
							</tr>
						</table>

						<table class="table table-hover table-condensed">
							<tr>
								<th class="text-center">Basic Salary</th>
								<th class="text-center">Gross Salary</th>
								<th class="text-center">Net Salary</th>
							</tr>
							<tr>
								<td class="text-center">{{ money()->toHuman($payslip->basic_salary) }}</td>
								<td class="text-center">{{ money()->toHuman($payslip->gross_salary) }}</td>
								<td class="text-center">{{ money()->toHuman($payslip->net_salary) }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-6">
				@include('payslip.partials.earnings', ['earnings' => $payslip->earnings])
			</div>
			<div class="col-6">
				@include('payslip.partials.deductions', ['deductions' => $payslip->deductions])
			</div>
		</div>
		<hr>
		<a href="{{ route('payroll.show', $payslip->payroll->hashslug) }}" class="btn border-primary">Back</a>
	</div>
@endsection