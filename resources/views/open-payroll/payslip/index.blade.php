@extends('layouts.open-payroll')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card border-0">
					<div class="card-header bg-white border-0">
						<h4>
							Payrolls
							<a href="{{ route('open-payroll.payroll.create') }}" class="float-right btn btn-default border border-info">Create New Payroll</a>
						</h4>
					</div>
					<div class="card-body  border-0">
						<div class="float-right">
							{{ $payrolls->links() }}
						</div>
						<table class="table table-hover table-condensed">
							<tr>
								<th class="text-center">Month</th>
								<th class="text-center">Year</th>
								<th class="text-center">Pay Day</th>
								<th class="text-center">Actions</th>
							</tr>
							@forelse($payrolls as $payroll)
								<tr>
									<td class="text-center">{{ \Carbon\Carbon::parse($payroll->year . '-' . $payroll->month . '-1')->format('M') }}</td>
									<td class="text-center">{{ $payroll->year }}</td>
									<td class="text-center">{{ $payroll->date->format('l, d-M-Y') }}</td>
									<td class="text-center">
										<a href="{{ route('open-payroll.payroll.show', $payroll->hashslug) }}" class="btn btn-default">Details</a>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="4" class="text-center">No data available</td>
								</tr>
							@endforelse
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection