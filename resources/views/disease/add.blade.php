@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Disease') }}</div>



                @if (isset($error))
       			 <div class="alert alert-danger">
         		<ul>
             		<li>{{ $error }}</li>
                        
        		</ul>
        		</div>
         		@endif 

                <div class="card-body">
                    <form method="POST" action="{{ route('post_disease_add') }}">
                        @csrf

                        	<div class="form-group row">
                            <label for="disease_name" class="col-md-4 col-form-label text-md-right">{{ __('Disease Name') }}</label>

                            <div class="col-md-6">
                                <input id="disease_name" type="text" class="form-control{{ $errors->has('disease_name') ? ' is-invalid' : '' }}" name="disease_name" value="{{ old('disease_name') }}"  autofocus>

                                @if ($errors->has('disease_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('disease_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <center>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </center>






                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection