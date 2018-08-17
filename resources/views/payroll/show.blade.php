@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">Payroll {{ \Carbon\Carbon::parse($payroll->year . '-' . $payroll->month . '-1')->format('M') }}, {{ $payroll->year }}</div>
						<div class="card-body">
							<table class="table table-hover table-condensed">
							<tr>
								<th class="text-center">Employee</th>
								<th class="text-center">Basic Salary</th>
								<th class="text-center">Gross Salary</th>
								<th class="text-center">Net Salary</th>
							</tr>
							@forelse($payroll->payslips as $payslip)
								<tr>
									<td>{{ $payslip->user->name }}</td>
									<td class="text-center">{{ money()->toHuman($payslip->basic_salary) }}</td>
									<td class="text-center">{{ money()->toHuman($payslip->gross_salary) }}</td>
									<td class="text-center">{{ money()->toHuman($payslip->net_salary) }}</td>
								</tr>
							@empty
								<tr>
									<td colspan="4" class="text-center">No data available</td>
								</tr>
							@endforelse
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection