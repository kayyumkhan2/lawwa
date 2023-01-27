@section('title') Edit   @endsection

@extends('admin::layouts.master')

@section('content')
<style>
.card-title
{
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	
	}
</style>
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1>Role Edit</h1>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('Roles.index')}}"> Roles</a></li>
          <li class="breadcrumb-item active" aria-current="page">Role Edit</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="card">
<div class="card-header"> 
<div class="d-flex justify-content-between">
      <div>
         {{ $role->name }}
      </div>
      <div>
       <a class="btn btn-sm btn-warning text-white" href="{{ URL::previous() }}" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> <a class="btn btn-sm btn-info " href="{{ route('Roles.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Roles</a>
      </div>
 </div>

</div>
<div class="card-body">
<form method="post" action="{{route('Roles.update', $role->id)}}">
     {{ csrf_field() }}
     {{ method_field('PATCH') }}

<div class="form-group  ml-3">
  <div class="col-xs-12 col-sm-12 col-md-12">
     
      <label>Name:</label>
      <input type="name" class="form-control" readonly="" name="name" value="{{$role->name}}">
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12"> 
    <div class="form-group"> 

      @foreach($permissions as $key=>$permission)
        <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header badge-pill "><b class="text-dark">{{$key}}</b></div>
                    <div class="card-body"> 
        @foreach ($permission as $value)
            <input type="checkbox" value="{{$value->id}}" @if(in_array($value->id, $rolePermissions)) checked @endif   name="permission[]"> 
               {{ ucfirst($value->name) }} 
             </label>
          @endforeach 
                </div>
                </div>
            </div>

 
     @endforeach


  </div>
  </div>
  

    <div class="card-footer">
      <button class="btn btn-sm btn-primary" type="submit">Save</button>
      <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
    </div>
  <!--<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>-->
</div>
</form>
</div>


@endsection

		