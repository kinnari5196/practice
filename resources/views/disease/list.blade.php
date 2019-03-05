@extends('layouts.app')
@extends('layouts.include');

@section('content')
<div class="container">
  <div class="col-xs-12 ">
    <div class="col-xs-12">
      <div class="float-right">
        <a href="{{ route('get_disease_add') }}" class="btn btn-primary btn-xs" role="button">Add</a>
      </div>
    </div>
  
    <div class="col-xs-12">
        <table class="table">
          <thead>
          <tr>
            <th scope="col"></th>
            
            <th scope="col">Disease Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
          </thead>
          <tbody>
            @foreach($data as $row)
            <tr>
              <td>{{ $row->disease_id  }}</td>
              <td>{{ $row->disease_name }}</td>
              <td><a href="{{ route('get_disease_edit',$row->disease_id)  }}" class="btn btn-success btn-xs" role="button">Edit</a></td> 
              <td><a href="{{ route('get_disease_delete',$row->disease_id)  }}" class="btn btn-secondary btn-xs" role="button" onclick="return del()">Delete</a> </td>
            </tr>  
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endsection

