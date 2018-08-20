@extends('layouts.open-payroll')

@push('scripts')
	<script>
		function confirmToDelete(hashslug)
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
			    document.getElementById('delete-form-' + hashslug).submit();
			  }
			})
		}
	</script>
@endpush

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card bg-white border-0 shadow-sm rounded">
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
										<div class="btn-group">
											<a href="{{ route('open-payroll.payroll.show', $payroll->hashslug) }}" class="btn border-primary text-primary">Details</a>
											@if(!$payroll->is_locked)
												<div class="btn border-danger text-danger" onclick="confirmToDelete('{{ $payroll->hashslug }}')">Delete</div>
												<form id="delete-form-{{ $payroll->hashslug }}" 
													action="{{ route('open-payroll.payroll.destroy', $payroll->hashslug) }}" 
													method="POST" style="display: none;">
			                                        @csrf
			                                        @method('DELETE')
			                                    </form>
											@endif
										</div>
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