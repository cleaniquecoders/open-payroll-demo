@extends('layouts.open-payroll')

@push('scripts')
    <script>
        jQuery(document).ready(function($) {
            $(document).on('click', '#all_employees', function(event) {
                $('.employees').prop('checked', $(this).is(":checked") ? true : false);
            });
        });
    </script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-header bg-white border-0">{{ __('Create New Payslip') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('open-payroll.payslip.store') }}" aria-label="{{ __('Create New Payslip') }}">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value={{ auth()->user()->id }}>

                        @if(request()->payroll)
                            <input type="hidden" name="payroll" id="payroll" value={{ request()->payroll }}>
                        @else
                            <div class="form-group">
                                <label for="payroll">Choose Payroll:</label>
                                <select name="payroll" id="payroll" class="form-control">
                                    @foreach($payrolls as $payroll)
                                        <option value="{{ $payroll->hashslug }}">{{ $payroll->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        
                        Select employee(s):
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover">
                                <tr>
                                    <th>
                                        <input type="checkbox" name="all_employees" id="all_employees" value="0">
                                    </th>
                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        {{ __('Position') }}
                                    </th>
                                </tr>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="employees" name="employees[]" id="employees" value="{{ $employee->hashslug }}">
                                        </td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->position->name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create New Payslip') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection