@extends('layouts.open-payroll')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-header bg-white border-0">{{ __('Create New Earning') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('open-payroll.earning.store', ['payslip' => request()->payslip]) }}" aria-label="{{ __('Create New Earning') }}">
                        @csrf
                        <input type="hidden" name="payslip" id="payslip" value="{{ request()->payslip }}">
                        <div class="form-group">
                            <label for="type">{{ __('Choose Earning Type:') }}</label>
                            <select name="type" id="type" class="form-control">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description:') }}</label>
                            
                            <input id="description" type="text" 
                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                name="description" value="{{ old('description') }}" 
                                autofocus>
                            <small class="text-muted pull-right">{{ __('(Optional)') }}</small>

                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="amount">{{ __('Amount:') }}</label>
                            
                            <input id="amount" type="number" 
                                class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" 
                                name="amount" value="{{ old('amount') }}" 
                                required autofocus>

                            @if ($errors->has('amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create New Earning') }}
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