@push('scripts')
	<script>
		function confirmToDeleteDeduction(hashslug)
		{
			swal({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  if (result.value) {
			    document.getElementById('delete-deduction-form-' + hashslug).submit();
			  }
			})
		}
	</script>
@endpush

<div class="card bg-white border-0 shadow-sm rounded">
	<div class="card-header bg-white border-0">
		{{ __('Earnings') }}
		<a href="{{ route('open-payroll.deduction.create', ['payslip' => $payslip->hashslug]) }}" class="btn btn-sm border-primary float-right">New Deduction</a>
	</div>
	<div class="card-body">
		<table class="table table-condensed">
			@forelse($deductions as $deduction)
				<tr>
					<th>{{ $deduction->type->name }}</th>
					<td>{{ money()->toHuman($deduction->amount ?? 0) }}</td>
					<td class="text-center">
						<div class="btn btn-sm border-danger text-danger" onclick="confirmToDeleteDeduction('{{ $deduction->hashslug }}')">Delete</div>
						<form id="delete-deduction-form-{{ $deduction->hashslug }}" 
							action="{{ route('open-payroll.deduction.destroy', $deduction->hashslug) }}" 
							method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
					</td>
				</tr>
			@empty
				<tr>
					<td class="text-center">No deductions at the moment.</td>
				</tr>
			@endforelse
		</table>
	</div>
</div>