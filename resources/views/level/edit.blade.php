@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Level') }}</div>

 


                

                <div class="card-body">
                    <form method="POST" action="{{ route('post_level_update') }}">
                        @csrf

                        	<div class="form-group row">
                            <label for="level_name" class="col-md-4 col-form-label text-md-right">{{ __('Level Name') }}</label>

                            <div class="col-md-6">
                                
                             <input id="level_name" type="text" class="form-control{{ $errors->has('level_name') ? ' is-invalid' : '' }}" name="level_name" value="{{ $data->level_name }}"  autofocus >
                               
                            <input id="level_id" type="hidden" name="level_id" value="{{ $data->level_id }}" >

                                @if ($errors->has('level_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('level_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <center>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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