@extends('layouts.app')
@extends('layouts.include')


@section('content')
<div class="container">
  <div class="col-xs-12 ">
    <div class="col-xs-12">
      <div class="float-right">
        <a href="{{ route('get_steps_add') }}" class="btn btn-primary btn-xs" role="button">Add</a>
      </div>
    </div>



    <div class="container">
   <!--  <div class="card"> -->
    <div class="col-md-8">    
    <div class="card-body" >
    <form method="get" action="{{ route('steps') }}">
          <div class="form-group row">
          <label for="disease" class="col-md-4 col-form-label text-md-right">{{ __('Select Disease') }}</label>

              <div class="col-md-6">
              <select name="disease" class="form-control{{ $errors->has('disease') ? ' is-invalid' : '' }}"  >
                <option  value></option>
                @foreach($diseases as $disease)
                <option {{($disease->disease_id == $disease_id ? 'selected="selected"' : '') }} value="{{ $disease->disease_id }}">{{ $disease->disease_name }}</option>

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
                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Select Level') }}</label>

                <div class="col-md-6">
                                <select name="level" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}"  >
                                  <option value></option>

                                    @foreach($levels as $level)
                                     <option {{($level->level_id == $level_id ? 'selected="selected"' : '')}} value="{{ $level->level_id }}">{{ $level->level_name }}</option>   
                                    @endforeach
                                    

                                </select>
                                @if ($errors->has('level'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



 <div class="form-group">
        <div class="float-left">
        <button class="btn btn-primary btn-xs">Apply</button>
      
        <a href="{{ route('steps') }}" class="btn btn-primary btn-xs" role="button">Reset</a>
      </div>                
 </div>
    </div>
    </form>
    <!-- </div> -->
 
</div>
</div>
</div>
  
    <div class="col-xs-12">
        <table class="table">
          <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Disease Name</th>
            <th scope="col">Level Name</th>
            <th scope="col">Steps</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
          </thead>
          <tbody>
            @foreach($data as $row)
            <tr>
              <td>{{ $row->steps_id  }}</td>
              <td>{{ $row->disease_name }}</td>
              <td>{{ $row->level_name }}</td>
              <td>{{ $row->steps_desc }}</td>


              <td><a href="{{ route('get_steps_edit',$row->steps_id)  }}" class="btn btn-success btn-xs" role="button">Edit</a></td> 
              <td><a href="{{ route('get_steps_delete',$row->steps_id)  }}" class="btn btn-secondary btn-xs" role="button" onclick="return del()">Delete</a> </td>


            </tr>  
            @endforeach


            </tbody>
          </table>
          </div>

      {{ $data->links() }}
      </div>
    </div>
  </div>
  @endsection

