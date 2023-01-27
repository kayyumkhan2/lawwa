@extends('admin::layouts.master')
@section('title') Add @if($type==0) PBTLA @elseif($type==1) Customer  @else Admin manager @endif @endsection
@section('content')
<div class="main-content">
   <div class="page-title col-sm-12">
      <div class="row align-items-center">
         <div class="col-md-6">
            <h4>Add  @if($type==0) PBTLA @elseif($type==1) Customer  @else Admin manager @endif </h4>
            
         </div>
         <div class="col-md-6">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb m-0 p-0">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item">@if($type==0) <a href="{{route('users.beauticians')}}"> PBTLA @elseif($type==1) <a href="{{route('users.customers')}}"> Customers  @else <a href="{{route('users.admin.managers')}}"> Admin managers @endif </a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add  @if($type==0) PBTLA @elseif($type==1) Customer  @else Admin manager @endif </li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
    <div class="card"> 
      <div class="card-header">
         <strong>Fill Details For Add  @if($type==0) PBTLA @elseif($type==1) Customer  @else Admin manager @endif </strong>
         <a class="btn btn-sm btn-info rounded-pill float-right ml-5 ml-lg-2" href="@if($type==0) {{ route('users.beauticians') }}@elseif($type==1){{ route('users.customers') }}@else {{ route('users.admin.managers') }} @endif" ><i class="fas fa-user"> </i>@if($type==0)  PBTLA @elseif($type==1) Customers  @else Admin managers @endif</a>
         <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back</a>
      </div>
      <div class="card-body">
       <form method="POST" action="{{ route('users.store') }}" id="formvalidation" autocomplete="off"  enctype="multipart/form-data" class="ml-1">
          @csrf
          <input type="text" name="type" value="@isset($type){{$type}}@endisset"  hidden="">
          <div class="form-group row">
             <div class="col-xs-6 col-sm-6 col-md-6">
                <label class="col-form-label starlabel" >Full Name : </label>
                <input type="text" name="full_name" placeholder = 'Enter full name' value="{{ old('full_name') }}" class = "form-control  @error('full_name') is-invalid @enderror" >
                @if ($errors->has('full_name'))
                <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('full_name') }}.</strong> 
                </span>
                @endif
             </div>
             <div class="col-xs-6 col-sm-6 col-md-6">
                <label class="col-form-label starlabel" >Email : </label>
                <input type="text" name="email" placeholder = 'Enter email address' value="{{ old('email') }}" class = "form-control  @error('email') is-invalid @enderror" >
                @if ($errors->has('email'))
                <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('email') }}.</strong> 
                </span>
                @endif
             </div>
          </div>
          <div class="form-group row">
             <div class="col-xs-3 col-sm-3 col-md-3">
                <label class="col-form-label starlabel" >Phone Number : </label>
                <input type="text" name="phone_no" maxlength="12" minlength="7" placeholder = 'Enter phone number' value="{{ old('phone_no') }}"  class = "form-control  @error('phone_no') is-invalid @enderror" >
                @if ($errors->has('phone_no'))
                <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('phone_no') }}.</strong> 
                </span>
                @endif
             </div>
             <div class="col-xs-3 col-sm-3 col-md-3">
                <label class="col-form-label starlabel">Emergency Number : </label>
                <input type="text" name="Emergency_Number" maxlength="12" minlength="7" placeholder = 'Enter emergency number' value="{{ old('Emergency_Number') }}"  class = "form-control  @error('Emergency_Number') is-invalid @enderror" >
                @if ($errors->has('Emergency_Number'))
                <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('Emergency_Number') }}.</strong> 
                </span>
                @endif
             </div>
             <div class="col-xs-3 col-sm-3 col-md-3">
                <label class="col-form-label starlabel">Profile Picture : </label>
                <input type="file" name="profile_pic"  class = "form-control  @error('profile_pic') is-invalid @enderror" >
                @if ($errors->has('profile_pic'))
                <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('profile_pic') }}.</strong> 
                </span>
                @endif
             </div>
             <div class="col-xs-3 col-sm-3 col-md-3">
                <label class="col-form-label starlabel">Id Proof : </label>
                <input type="file" name="id_proof"  class = "form-control  @error('id_proof') is-invalid @enderror" >
                @if ($errors->has('id_proof'))
                <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('id_proof') }}.</strong> 
                </span>
                @endif
             </div>
          </div>
          @if($type==0)
          <div class="form-group row">
             <div class="col-xs-12 col-sm-12 col-md-12"> &nbsp;&nbsp; Do you certified :  </div>
             <div class="col-lg-4 col-md-6">
              <ul class="payments_li">
                  <li>
                    <label class="custom_radios" for="exampleRadios1"> Yes
                      <input class="form-check-input" type="radio" name="certifiedstatus" id="exampleRadios1" value="true" @if(old('certifiedstatus') && old('certifiedstatus')=="true")) checked @endif class="certifiedstatus" value="true" >
                      <small class="checkmark_rad"></small>
                    </label>
                  </li>
                </ul>  
                  <!-- <div class="form-check main">
                  <input class="form-check-input" type="radio" name="certifiedstatus" id="exampleRadios1" value="true" @if(old('certifiedstatus') && old('certifiedstatus')=="true")) checked @endif class="certifiedstatus" value="true" >
                  <label class="form-check-label" for="exampleRadios1">
                   Yes
                  </label>
                </div> -->
                 <!-- <input type="radio" name="certifiedstatus" @if(old('certifiedstatus') && old('certifiedstatus')=="true")) checked @endif class="certifiedstatus" value="true" />
                 <label>Yes</label>  --> 
             </div>
             <div class="col-lg-4 col-md-6">
                  <ul class="payments_li">
                    <li>
                      <label class="custom_radios" for="exampleRadios2"> No
                        <input class="form-check-input" type="radio" name="certifiedstatus" id="exampleRadios2" value="option2" @if(old('certifiedstatus') && old('certifiedstatus')=="false")) checked @endif  class="certifiedstatus" value="false">
                        <small class="checkmark_rad"></small>
                      </label>
                    </li>
                  </ul> 
                <!-- <div class="form-check main">
                <input class="form-check-input" type="radio" name="certifiedstatus" id="exampleRadios2" value="option2" @if(old('certifiedstatus') && old('certifiedstatus')=="false")) checked @endif  class="certifiedstatus" value="false">
                  <label class="form-check-label" for="exampleRadios2">
                    No
                  </label>
                </div> -->
                <!-- <input type="radio" name="certifiedstatus" @if(old('certifiedstatus') && old('certifiedstatus')=="false")) checked @endif  class="certifiedstatus" value="false" /> 
                <label>No</label>  -->
             </div>
          </div> 
          <div class="form-group doc row">
             <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="emp-id" class="form-input-label">Select services : </label>
                <select  id="to" class="selectpicker form-control" data-live-search="true" name="services[]" data-actions-box="true"  multiple>
                   @foreach($services as $service)
                   <option value="{{$service->id}}">{{$service->name}}</option>
                   @endforeach
                </select>
                @if ($errors->has('services'))
                <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('services') }}.</strong> 
                </span>
                @endif
             </div>
          </div>
        <div class="form-group row doc" style="display: @if(old('certifiedstatus') && old('certifiedstatus')=="true")) block @else none @endif;">
            <div class="col-xs-12 col-sm-12 col-md-12" >
               <label>Doc : </label>
               <input type="file" name="doc" required="" class = "form-control  @error('doc') is-invalid @enderror" >
               @if ($errors->has('doc'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('doc') }}.</strong> 
               </span>
               @endif
            </div>
          </div>
          @elseif($type==1)
          @else 
          {{--User panel--}} 
          @endif
          <div class="form-group row" style="display:@if($type==0) none @elseif($type==1) none @else block @endif ">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <label>Role : </label>
                <select class ="form-control js-example-basic-single" name="roles[]">
                @foreach($roles as $role)
                <option value="{{$role}}">{{$role}}</option>
                @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <label class="col-form-label starlabel" >Password : </label>
              <input type="password" name="password" placeholder = 'Enter password'  id="password" class = "form-control  @error('password') is-invalid @enderror" >
              @if ($errors->has('password'))
              <span class="invalid feedback" role="alert"> 
              <strong class="text-danger">{{ $errors->first('password') }}.</strong> 
              </span>
              @endif
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <label class="col-form-label starlabel" >Confirm Password : </label>
              <input type="password" name="confirm_password" placeholder = 'Enter Confirm Password' id="confirmpassword"  class = "form-control  @error('confirm_password') is-invalid @enderror" >
              @if ($errors->has('confirm_password'))
              <span class="invalid feedback" role="alert"> 
              <strong class="text-danger">{{ $errors->first('confirm_password') }}.</strong> 
              </span>
              @endif
            </div>
          </div>
        @if($type==1)
          <div class="form-group row">
          <div class="col-xs-12 col-sm-12 col-md-12">
          <label for="exampleFormControlTextarea1">Address / Location</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="Address_Location"></textarea>
          </div>
          </div>
        @endif  
          <div class="card-footer ">
        <button class="btn btn-sm btn-primary" type="submit">Save</button>
        <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
      </div>
       </form>
      </div>
    </div>   

    
@endsection
@section('csslink')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endsection
@section('jslink')
<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script type="text/javascript">
   $(document).ready(function() {
      $(".certifiedstatus") 
      .change(function(){ 
        if( $(this).is(":checked") ){ 
          var val = $(this).val();
          if (val=='true') {
             $(".doc").show();
          }
          else{
              $(".doc").hide();  
          }
        }
    });
   });
</script>
<script type="text/javascript">
   onkeyup: $(function() {
          $("#formvalidation").validate({
       onkeyup: true, 
          rules: {
            full_name: {
              required: true,
            },
            email: {
              required: true,
              email: true
            },
            services: {
              required: true,
            },
            id_proof: {
              required: true,
            },
            profile_pic: {
              required: true,
            },
            Address_Location: {
              required: true,
            },
            certifiedstatus: {
               required: true,
                 },
            phone_no: {
              required: true,
                digits: true
            },
            Emergency_Number: {
              required: true,
                digits: true
            },
             password: {
              required: true,
               minlength :6
            },
            confirm_password: {
              required: true,
              minlength : 6,
               equalTo : "#password"
            }
       
          },
      });
    });
</script>
@endsection
