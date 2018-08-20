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
							{{ $payroll->title }}

							<a href="{{ route('open-payroll.payslip.create', ['payroll' => $payroll->hashslug]) }}" class="btn btn-default border border-primary float-right">
								{{ __('Create Payslips') }}
							</a>
						</h4>
					</div>
					<div class="card-body">
						<a href="{{ route('open-payroll.payroll.recalculate', $payroll->hashslug) }}" class="btn btn-sm btn-warning border-warning float-right mb-2">Recalculate</a>
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
									<td class="text-center">
										<div class="btn-group">
											<a href="{{ route('open-payroll.payslip.show', $payslip->hashslug) }}" class="btn border-primary text-primary">Details</a>
											@if(!$payslip->is_locked)
												<div class="btn border-danger text-danger" onclick="confirmToDelete('{{ $payslip->hashslug }}')">Delete</div>
												<form id="delete-form-{{ $payslip->hashslug }}" 
													action="{{ route('open-payroll.payslip.destroy', $payslip->hashslug) }}" 
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
									<td colspan="8" class="text-center">No data available</td>
								</tr>
							@endforelse
						</table>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<a href="{{ route('open-payroll.payroll.index') }}" class="btn border-primary">Back</a>
	</div>
@endsection