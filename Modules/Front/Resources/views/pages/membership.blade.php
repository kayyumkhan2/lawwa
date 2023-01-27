@extends('front::layouts.master')
@section('title') Membership @endsection
@section('content')
<!-- Lawwa Page Title -->
<section class="lawwa-page-title" style="background-image: url({{asset('front/assets/images/backgrounds/membership.png')}})">
  <div class="container">                             
    <h2>Membership</h2>
    <h6>Lawwa.Asia, Your Personal Beauty Therapist</h6>
    <h4>Be part of Lawwa.Asia Family</h4>
  </div>
</section>

<!-- Lawwa Membership -->
<section class="lawwa-membership">
  <div class="container">
    <h2 class="section-title">Membership</h2>
    <p>Sign up to be a member of Lawwa.Asia and enjoy special promotions, updates and exclusive invitations.  Register as a member to enjoy our beauty treatments and receive a personal beauty starter kit. </p>
    <div class="membership-wrap">
      <div class="row justify-content-center">
         @foreach ($memberships as $key => $value) 
          <div class="col-lg-4 col-md-6">
            <div class="membership-info">                  
              <div class="membership-header" style="background-image: url({{asset('front/assets/images/backgrounds/membership-header-bg.png')}});">
                <h2 class="membership-price"><span>RM</span>{{round($value->price)}}</h2>
                <h3><i class="fa fa-users" aria-hidden="true"></i>{{$value->name}}</h3>
              </div>
              <div class="membership-body">
                <ul>
              @foreach ($value->MembershipFeatures as $Features)
                  <li><span>{{$Features->name}}</span></li>
                @endforeach
                @foreach ($value->MemberShipServices as $service)
                  <li><span>{{$service->name}}</span></li>
                @endforeach  
                </ul>
              @auth
                <div class="btn-block">
                  <a href="javascript:void(0)" class="lawwa-btn w-100 d-block plan_select" data-id="{{$value->name}}" data-membership_plan_id="{{$value->id}}" data-price="{{$value->price}}" >Choose Plan</a>
                  <span class="plan-error" style="display: none;">Please select a plan</span>
                </div>
              @endauth  
              </div>
            </div>
          </div>
         @endforeach 
      </div>
      <div class="btn-block next-btn">
        <form action="{{route('selected.subscription.plans')}}" id="plan" method="post">
          @csrf
          <input type="text" name="membership_plan_id" hidden="" class="membership_plan_id" value="">
          <input type="text" name="plan" hidden="" class="plan" value="">
          <input type="text" name="price" hidden="" value="">
        </form>
      </div>
    </div>
  </div>
</section>

<!-- Lawwa Membership Tabs -->                         
<section class="membership-tabs" style="background-image: url({{asset('front/assets/images/backgrounds/membership-tabs-bg.png')}});">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="payment-staps">
          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="registration-tab" data-toggle="tab" href="#registration" role="tab" aria-controls="registration" aria-selected="true">Registration</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="registration" role="tabpanel" aria-labelledby="registration-tab">
              <form  method="POST" name="registration" autocomplete="off" action="{{ route('customer.signuppost',['membership']) }}" class="form" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <input type="text" name="full_name"  {{ ( Auth::check()) ? 'readonly' : '' }}  class="form-control" value="{{ old('full_name',Auth::check() ? Auth::user()->full_name : '') }}" placeholder="Full name">
                  @if ($errors->has('full_name'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('full_name') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
               <div class="col-lg-12">
                  <div class="form-group">
                    <input type="text" name="phone_no" {{ ( Auth::check()) ? 'readonly' : '' }}    maxlength="12" minlength="7"   class="form-control" value="{{ old('phone_no',Auth::check() ? Auth::user()->phone_no : '') }}" placeholder="Phone number">
                  @if ($errors->has('phone_no'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('phone_no') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <input type="email" name="email" {{ ( Auth::check()) ? 'readonly' : '' }}   class="form-control" value="{{ old('email',Auth::check() ? Auth::user()->email : '') }}" placeholder="Email id">
                  @if ($errors->has('email'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('email') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                @php 
                  $Photo     = "";
                  $Id_Proof  = "";
                  $Nric      = "";
                  $Emergency_Number =  "";
                @endphp
                @if (Auth::check()) 
                  @if(Auth::user()->UserProfileInformation!="" )
                   @php 
                     $Photo   = Auth::user()->UserProfileInformation->Photo;
                     $Id_Proof = Auth::user()->UserProfileInformation->Id_Proof;
                     $Nric = Auth::user()->UserProfileInformation->Nric;
                     $Emergency_Number =  Auth::user()->UserProfileInformation->Emergency_Number;
                    @endphp
                  @endif
                @endif
              <div class="col-lg-12">
                 <div class="form-group">
                  <div class="custom-file">
                    <input type="file" name="Photo" @if(!$Photo=="") disabled @endif    class="form-control custom-file-input">
                    <label class="custom-file-label" for="Photo">Photo</label>
                    @if ($errors->has('Photo'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('Photo') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
              </div>
                <div class="col-lg-12">
                 <div class="form-group">
                  <div class="custom-file">
                    <input type="file" name="Id_Proof"  @if(!$Id_Proof=="") disabled   @endif  class="form-control custom-file-input">
                    <label class="custom-file-label" for="Id_Proof">Id Proof</label>
                    @if ($errors->has('Id_Proof'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('Id_Proof') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
              </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <input type="text" name="Nric" @if(!$Nric=="") readonly   @endif class="form-control" value="{{ old('Nric',Auth::check() ? $Nric : $Nric) }}" placeholder="Nric (Nationality number)">
                  @if ($errors->has('Nric'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('Nric') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <input type="text" name="Emergency_Number"  {{ ( Auth::check()) ? 'readonly' : '' }}  maxlength="12" minlength="7"  class="form-control" value="{{ old('Emergency_Number',Auth::check() ? $Emergency_Number : $Emergency_Number) }}" placeholder="Emergency number">
                  @if ($errors->has('Emergency_Number'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('Emergency_Number') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                      <textarea class="form-control" {{ ( Auth::check()) ? 'readonly' : '' }} id="exampleFormControlTextarea1" rows="3" name="Address_Location" placeholder="Address / Location">{{ old('Address_Location',Auth::check() ? Auth::user()->Address_Location : '') }}</textarea>
                        @if ($errors->has('Address_Location'))
                        <span class="invalid feedback" role="alert"> 
                            <strong class="text-danger">{{ $errors->first('Address_Location') }}</strong> 
                        </span>
                    @endif     
              </div>
              </div>
              @guest
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="password" name="password" minlength="6" maxlength="14" class="form-control" id="password" placeholder="Password">
                    @if ($errors->has('password'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('password') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
                    @if ($errors->has('password'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck1" name="Terms">
                      <label class="custom-control-label" for="customCheck1">I Accept the <a href="{{route('pages.terms-condition')}}" class="link">Terms and Conditions</a></label>
                    </div>
                  </div>
                </div>
                <div class="btn-block col-lg-12">
                  <button type="submit" class="lawwa-btn d-block w-100">Register</button>
                </div>
                @else 
                <div class="btn-block col-lg-12">
                  @if($Nric =="" || $Id_Proof =="" || $Photo=="" )
                    <button type="submit" class="lawwa-btn d-block w-100">Continue</button>
                  @else
                    <span type="submit" class="lawwa-btn d-block w-100" onClick='submitDetailsForm()'>Next</span>  
                  @endif
                </div>
                @endguest
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('js')
<style type="text/css">
  .toast-top-center {
  /*top: 13%;*/
}
</style>
<script>
  $("#plan").submit(function (e) {
    let value = $('.plan').val();
    if (value=="") 
      {
        e.preventDefault();
        $('.plan-error').css("display", "block");
        toastr.error('Please select a membership plan!', "", options);  
      }
    else
      {
        $('.plan-error').css("display", "none");
      }
  });
</script>
<script>
  $(document).ready(function(){ 
    $('.plan_select').click(function(){
        var dataId = $(this).data("id");
        var price = $(this).data("price");
        var membership_plan_id = $(this).data("membership_plan_id");
        $('.plan-error').css("display", "none");
        // $(this).html('<i class="fa fa-check-circle-o" aria-hidden="true"></i>');
        toastr.success('Plan selected successfully!', "", options);  
        $('input[name="plan"]').val(dataId);
        $('input[name="price"]').val(price);
        $('input[name="membership_plan_id"]').val(membership_plan_id);
     });
  });
</script>
<script language="javascript" type="text/javascript">
    function submitDetailsForm() {
       $("#plan").submit();
    }
</script>
<script type="text/javascript">
$(function() {
  jQuery.validator.addMethod("customEmail", function(value, element) {
             return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
            }, "Please enter valid email address!");
  jQuery.validator.addMethod("full_name", function(value, element) {
             return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
            }, "Please enter valid full Name !");
  $("form[name='registration']").validate({
    rules: {
      email: {
        required: true,
        email: true,
        customEmail: true,
      },
      full_name: {
        required: true,
        minlength:2,
        full_name:true
      },
      phone_no: {
        required: true,
        digits: true,
      },
      Nric: {
        required: true,
        digits: true,
      },
      Emergency_Number: {
        required: true,
        digits: true,
      },
      Photo: {
        required: true,
      },
      Id_Proof: {
        required: true,
      },
      Terms: {
        required: true,
      },
    Address_Location: {
      required: true,
    },  
      password: {
        required: true,
        minlength: 6,
      },
      confirm_password: {
        required: true,
        equalTo : "#password"
      }
    },
    messages: {
      full_name: {
        required: "Please enter your full name",
        minlength: "full name must be at least 2 characters long"
      },
      Photo: {
        required: "Please upload your photo",
      },
      Id_Proof: {
        required: "Please upload your Id Proof",
      },
      Address_Location: "Please enter your Address",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      },
      confirm_password: {
        required: "Please enter confirm password",
      },
      phone_no: {
        required: "Please enter your phone number",
        minlength: "Phone number must be at least 10 number long",
        maxlength: "Phone number can not more then 10 number long",
        digits: "Please enter a valid phone number",
      },
      Emergency_Number: {
        required: "Please enter your emergency number",
        minlength: "Phone number must be at least 10 number long",
        maxlength: "Phone number can not more then 10 characters long",
        digits: "Please enter a valid emergency number",
      },
      email: {
        required: "Please enter your email id",
        email: "Please enter a valid email address"
      },
      Nric: {
        required: "Please enter Nric (Nationality number)",
      },
      Terms: {
        required: "Please accept terms and conditions",
      },
      
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
@endsection