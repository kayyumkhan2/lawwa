@extends('admin::layouts.master')
@section('title') Change Password @endsection
@section('content')
<style>
  .error {
	  font-family:Constantia, "Lucida Bright", "DejaVu Serif", Georgia, serif  !important;
      color: #F8000F !important;
	  font-size:17px !important;
   }
</style>
<div class="main-content">
  <div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1>Change Password</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
    <div class="col-md-12">
        <div class="card">
        <div class="card-header"><div class="d-flex justify-content-between">
      <div>Change Password   
        <a href="{{ route('users.edit',$user->id) }}">
            <span class="badge badge-success ">Edit</span>
        </a>
      </div>
      <div>
       <a class="btn btn-sm btn-warning text-white" href="{{ URL::previous() }}" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> 
<a class="btn btn-sm btn-info " href="{{ route('users.show',$id) }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Profile</a>
       <a class="btn btn-sm btn-info " href="{{ route('users.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Users</a>
      </div>
 </div>
</div>
<div class="card-body">
        <form action="{{route('ChangePassword',$id)}}" method="post" id="chanagepassword" novalidate>
        @csrf
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="New Password">
                 @if ($errors->has('password'))
                 <span class="invalid feedback" role="alert"> 
                 	<strong class="text-danger">{{ $errors->first('password') }}.</strong> 
                 </span>
                @endif 
            </div>
            <div class="form-group">
                <label for="Confirm_password">Confirm Password</label>
                <input type="password" class="form-control  {{ $errors->has('Confirm_password') ? ' is-invalid' : '' }}" id="Confirm_password" name="Confirm_password"  placeholder="Confirm Password">
                @if ($errors->has('Confirm_password'))
                 <span class="invalid feedback" role="alert"> 
                 	<strong class="text-danger">{{ $errors->first('Confirm_password') }}.</strong> 
                 </span>
               @endif 
            </div>
</div>
<div class="card-footer">
		<button class="btn btn-sm btn-primary" type="submit">Save</button>
		<button class="btn btn-sm btn-danger" type="reset"> Reset</button>
</div>
        </form>
            </div>
        </div>
@endsection
@section('js')
<script type="text/javascript">
$(function() {
      $("#chanagepassword").validate({
      rules: {
        password: {
          required: true,
		   minlength :6
        },
        Confirm_password: {
          required: true,
		       minlength : 6,
           equalTo : "#password"
        }
      },
      messages: {
        password: {
          required: "Password is a Required field !"
        },
        Confirm_password: {
          required: "Confirm Password is a Required field !"
        }
    }
   });
});
</script>
@endsection
</div>
