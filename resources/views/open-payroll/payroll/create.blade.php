@extends('layouts.open-payroll')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-header bg-white border-0">{{ __('Create New Payroll') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('open-payroll.payroll.store') }}" aria-label="{{ __('Create New Payroll') }}">
                        @csrf
						<input type="hidden" name="user_id" id="user_id" value={{ auth()->user()->id }}>
                        <div class="form-group row">
                            <label for="month" class="col-md-4 col-form-label text-md-right">{{ __('Month') }}</label>

                            <div class="col-md-6">
                                <input id="month" type="number" 
                                	min="1" max="12" 
                                	class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" 
                                	name="month" value="{{ old('month', date('n')) }}" 
                                	required autofocus>

                                @if ($errors->has('month'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="number" 
                                	min="{{ date('Y') }}" 
                                	class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" 
                                	name="year" value="{{ old('year', date('Y')) }}" 
                                	required autofocus>

                                @if ($errors->has('year'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Pay Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" 
                                	class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" 
                                	name="date" value="{{ old('date', date('d/m/Y')) }}" 
                                	required autofocus>
								
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create New Payroll') }}
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