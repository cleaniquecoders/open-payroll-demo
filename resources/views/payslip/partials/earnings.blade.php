@push('scripts')
	<script>
		function confirmToDeleteEarning(hashslug)
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
			    document.getElementById('delete-earning-form-' + hashslug).submit();
			  }
			})
		}
	</script>
@endpush

<div class="card bg-white border-0 shadow-sm rounded">
	<div class="card-header bg-white border-0">
		{{ __('Earnings') }}
		<a href="{{ route('open-payroll.earning.create', ['payslip' => $payslip->hashslug]) }}" class="btn btn-sm border-primary float-right">New Earning</a>
	</div>
	<div class="card-body">
		<table class="table table-condensed">
			@forelse($earnings as $earning)
				<tr>
					<th>{{ $earning->type->name }}</th>
					<td>{{ money()->toHuman($earning->amount ?? 0) }}</td>
					<td class="text-center">
						<div class="btn btn-sm border-danger text-danger" onclick="confirmToDeleteEarning('{{ $earning->hashslug }}')">Delete</div>
						<form id="delete-earning-form-{{ $earning->hashslug }}" 
							action="{{ route('open-payroll.earning.destroy', $earning->hashslug) }}" 
							method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
					</td>
				</tr>
			@empty
				<tr>
					<td class="text-center">No earnings at the moment.</td>
				</tr>
			@endforelse
		</table>
	</div>
</div>