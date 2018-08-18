<div class="card">
	<div class="card-header">
		{{ __('Earnings') }}
		<a href="{{ route('earning.create', ['payslip' => $payslip->hashslug]) }}" class="btn btn-sm border-primary float-right">New Earning</a>
	</div>
	<div class="card-body">
		<table class="table table-condensed">
			@forelse($earnings as $earning)
				<tr>
					<th>{{ $earning->type->name }}</th>
					<td>{{ money()->toHuman($earning->amount ?? 0) }}</td>
				</tr>
			@empty
				<tr>
					<td class="text-center">No earnings at the moment.</td>
				</tr>
			@endforelse
		</table>
	</div>
</div>