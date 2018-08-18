@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h4>
							{{ $payroll->title }}
							<a href="{{ route('payslip.create', ['payroll' => $payroll->hashslug]) }}" class="btn btn-default border border-primary float-right">
								{{ __('Create Payslips') }}
							</a>
						</h4>
					</div>
					<div class="card-body">
						<table class="table table-hover table-condensed">
							<tr>
								<th class="text-center">Employee</th>
								<th class="text-center">Basic Salary</th>
								<th class="text-center">Gross Salary</th>
								<th class="text-center">Net Salary</th>
								<td class="text-center">Is Verified?</td>
								<td class="text-center">Is Approved?</td>
								<td class="text-center">Is Locked?</td>
								<td class="text-center">Actions</td>
							</tr>
							@forelse($payroll->payslips as $payslip)
								<tr>
									<td>{{ $payslip->user->name }}</td>
									<td class="text-center">{{ money()->toHuman($payslip->basic_salary) }}</td>
									<td class="text-center">{{ money()->toHuman($payslip->gross_salary) }}</td>
									<td class="text-center">{{ money()->toHuman($payslip->net_salary) }}</td>
									<td class="text-center">
										<span class="p-2 badge badge-{{ getYesNoClassName($payslip->is_verified) }}">{{ $payslip->is_verified ? 'Yes' : 'No' }}</span>
									</td>
									<td class="text-center">
										<span class="p-2 badge badge-{{ getYesNoClassName($payslip->is_approved) }}">{{ $payslip->is_approved ? 'Yes' : 'No' }}</span>
									</td>
									<td class="text-center">
										<span class="p-2 badge badge-{{ getYesNoClassName($payslip->is_locked) }}">{{ $payslip->is_locked ? 'Yes' : 'No' }}</span>
									</td>
									<td class="text-center"></td>
								</tr>
							@empty
								<tr>
									<td colspan="8" class="text-center">No data available</td>
								</tr>
							@endforelse
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection