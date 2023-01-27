@extends('admin::layouts.master')
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1>Add Role</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Role</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
    <strong>Create Role</strong>
                    <a class="btn btn-sm btn-info float-right ml-5 ml-lg-2" href="{{ route('Roles.index') }}" >Roles</a>

                    <a class="btn btn-sm btn-warning text-white float-right " href="javascript:history.go(-1)">Back</a>

       

            </div>
   <div class="card-body">
   

        <form method="POST" action="{{ route('Roles.store') }}" id="formid">
            @csrf

<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group"><label>Name:</label>
        <input type="text" name="name" class="form-control">
                  @if ($errors->has('name'))
                    <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('name') }}.</strong> 
                    </span>
            @endif</div>
			</div>
			  <div class="col-xs-12 col-sm-12 col-md-12"> 
    <div class="form-group"> 

      @foreach($permissions as $key=>$permission)
        <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header badge-pill "><b class="text-dark">{{$key}}</b></div>
                    <div class="card-body"> 
        @foreach ($permission as $value)
            <input type="checkbox" value="{{$value->id}}"   name="permission[]"> 
               {{ ucfirst($value->name) }} 
             </label>
          @endforeach 
                </div>
                </div>
            </div>

 
     @endforeach


  </div>
  </div>
  </div>
</div>
		<div class="card-footer">
  <button class="btn btn-sm btn-primary" type="submit">Save</button>
   <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
   <!--<x-button  type="submit">{{ __('Save') }}</x-button>
    <x-button  type="reset">{{ __('Reset') }}</x-button>-->
   </div>
	</div>
      @endsection
      @section('js')
      <script >
        $(document).ready(function(){
                  $("#formid").validate(
                  {
                      ignore: [],
                    debug: false,
                      rules: { 
                          name: {
                               required: true,
                              },
                          "permission[]": {
                              required: true,
                              },
                          },
                  });
              });
      </script>
     
@endsection
