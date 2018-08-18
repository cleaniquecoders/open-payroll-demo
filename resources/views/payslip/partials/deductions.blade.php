<div class="card">
	<div class="card-header">
		{{ __('Earnings') }}
		<a href="" class="btn btn-sm border-primary float-right">New Deduction</a>
	</div>
	<div class="card-body">
		<table class="table table-condensed">
			@forelse($deductions as $deduction)
				<tr>
					<th>{{ $deduction->type->name }}</th>
					<td>{{ money()->toHuman($deduction->amount ?? 0) }}</td>
				</tr>
			@empty
				<tr>
					<td class="text-center">No deductions at the moment.</td>
				</tr>
			@endforelse
		</table>
	</div>
</div>