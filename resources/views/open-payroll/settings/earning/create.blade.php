@extends('layouts.open-payroll')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-header bg-white border-0">
                    @if(isset($type) && $type->id)
                        {{ __('Update Earning Type') }}
                    @else
                        {{ __('Create New Earning Type') }}
                    @endif
                </div>

                <div class="card-body">
                    <form method="POST" 
                        @if(isset($type) && $type->id)
                            action="{{ route('open-payroll.setting.earning.update', $type->id) }}" 
                        @else
                            action="{{ route('open-payroll.setting.earning.store') }}" 
                        @endif
                        aria-label="{{ __('Create New Earning Type') }}">

                        @csrf

                        @if(isset($type) && $type->id)
                            <input type="hidden" name="id" id="id" value="{{ $type->id }}">
                            @method('UPDATE')
                        @endif

                        <div class="form-group">
                            <label for="name">{{ __('Name:') }}</label>
                            
                            <input id="name" type="text" 
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                name="name" 

                                value="{{ (isset($type) ? $type->name : old('name')) }}" 
                                required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if(isset($type) && $type->id)
                                        {{ __('Update Earning Type') }}
                                    @else
                                        {{ __('Create New Earning Type') }}
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <a href="{{ route('open-payroll.setting.index') }}" class="btn border-primary">Back</a>
        </div>
    </div>
</div>
@endsection