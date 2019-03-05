@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Steps') }}</div>



                @if (isset($error))
       			 <div class="alert alert-danger">
         		<ul>
             		<li>{{ $error }}</li>
                        
        		</ul>
        		</div>
         		@endif 

                <div class="card-body">
                    <form method="POST" action="{{ route('post_steps_add') }}">
                        @csrf



                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Select Level') }}</label>

                            <div class="col-md-6">
                                <select name="level" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}"  required>

                                    @foreach($levels as $level)
                                     <option value="{{ $level->level_id }}">{{ $level->level_name }}</option>   
                                    @endforeach
                                    

                                </select>
                                @if ($errors->has('level'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="disease" class="col-md-4 col-form-label text-md-right">{{ __('Select Disease') }}</label>

                            <div class="col-md-6">
                                <select name="disease" class="form-control{{ $errors->has('disease') ? ' is-invalid' : '' }}"  required>

                                    @foreach($disease as $data)
                                     <option value="{{ $data->disease_id }}">{{ $data->disease_name }}</option>   
                                    @endforeach
                                    

                                </select>
                                @if ($errors->has('disease'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('disease') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        	<div class="form-group row">
                            <label for="steps_desc" class="col-md-4 col-form-label text-md-right">{{ __('Add Steps') }}</label>

                            <div class="col-md-6">

                                 <textarea rows = "14" cols = "50" name = "steps_desc" class="form-control{{ $errors->has('steps_desc') ? ' is-invalid' : '' }}" name="steps_desc" value="{{ old('steps_desc') }}" required autofocus>
                                       
                                </textarea>
                                

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