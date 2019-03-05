@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Steps') }}</div>

 


                

                <div class="card-body">
                    <form method="POST" action="{{ route('post_steps_update') }}">
                        @csrf

                        	<div class="form-group row">
                            <label for="steps_desc" class="col-md-4 col-form-label text-md-right">{{ __('Steps') }}</label>

                            <div class="col-md-6">
                                
                            <textarea rows = "14" cols = "50" name = "steps_desc" class="form-control{{ $errors->has('steps_desc') ? ' is-invalid' : '' }}" name="steps_desc" required autofocus>
                            {{$data->steps_desc }}
                                </textarea>
                               
                            <input id="steps_id" type="hidden" name="steps_id" value="{{ $data->steps_id }}" >

                                @if ($errors->has('steps_desc'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('steps_desc') }}</strong>
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