<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="description" content="Lawwa">
<meta name="keywords" content="Lawwa">
<meta name="author" content="Lawwa">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Lawwa - Sign Up</title>
    @include('front::layouts.css')
     <style type="text/css">
    .select2-container .select2-selection--multiple {
      font-family: 'Arial', Verdana;
      font-size: 12px;
      box-sizing: border-box;
      display: block;
      height: auto;
      padding-top: 5px;
    }
    #dropList1+.select2 .select2-selection--multiple {
     height: auto !important;
}
</style>
<body>
<div class="preloader"><img src="{{asset('images/lawwaloder.gif')}}"></div>
<section class="form-wrap">
  <div class="row">
  	<div class="col-lg-6">
      <div class="lawwa-table-wrap">
        <div class="lawwa-align-wrap">
          <div class="form-content">
            <div class="img-block">
              <a href="{{route('front.home')}}"><img src="{{ asset('front/assets/images/icons/form-icon.svg') }}" alt="Logo"></a>
            </div>
            <div class="section-form-title">
              <h3 class="form-title">Welcome to Lawwa.Asia Your Personal Beauty Therapist</h3>
            </div>
           <!--  @if($errors->any())
             {{ implode('', $errors->all('<div class="error">:message</div>')) }}
           @endif -->
            <form  method="POST" action="{{ route('beautician.signuppost') }}" name="registration" autocomplete="off"  enctype="multipart/form-data" class="form">
              @csrf
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <span class="Required"></span>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" placeholder="Full name">
                  @if ($errors->has('full_name'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('full_name') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <span class="Required"></span>
                    <input type="text" name="phone_no" maxlength="12" minlength="7"   class="form-control" value="{{ old('phone_no') }}" placeholder="Phone number">
                  @if ($errors->has('phone_no'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('phone_no') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <span class="Required"></span>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email id">
                  @if ($errors->has('email'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('email') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                <div class="col-lg-12">
                  <span class="Optional"></span>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input coupon_question" name="certifiedstatus" id="customCheck2" @if(old('certifiedstatus') && old('certifiedstatus')=='true')) checked=""  @endif ; >
                      <label class="custom-control-label" for="customCheck2">Beautician has already certified</label>
                    </div>
                  </div>
                </div>
                 <div class="col-md-12 doc" style="display: @if(old('certifiedstatus') && old('certifiedstatus')=='true')) block @else none @endif ;">
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input form-control " name="doc" id="validatedCustomFile" >
                      <label class="custom-file-label" for="validatedCustomFile">Attach the certificate</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                   <span class="Required"></span>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input form-control " name="id_proof" id="id_proof" >
                      <label class="custom-file-label" for="id_proof">Attach the Id Proof</label>
                    </div>
                  </div>
                </div>
              <div class="col-xs-12 col-sm-12 col-md-12 doc">
                <div class="form-group">
                  <span class="Required"></span>
                <select class="form-control js-example-basic-multiple select-services" data-placeholder="Select Services" name="services[]" multiple="multiple"  >
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
                <div class="col-md-6">
                  <div class="form-group">
                    <span class="Required"></span>
                    <input type="password" name="password" id="password" class="form-control"  placeholder="Password">
                    @if ($errors->has('password'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('password') }}</strong> 
                      </span>
                  @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <span class="Required"></span>
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
                      <input type="checkbox" class="custom-control-input " id="Terms" required="" name="Terms" >
                      <label class="custom-control-label" for="Terms">I Accept the <a href="{{route('pages.terms-condition')}}" target="_blank" class="link">Terms and Conditions</a></label>
                    </div>
                  </div>
                </div>
                <div class="btn-block col-lg-12">
                  <button type="submit" class="lawwa-btn d-block w-100">Sign Up</button>
                </div>
                <!-- <div class="social-login">
                  <span>Or Sign In With</span>
                  <ul>
                    <li>
                      <a href="{{ route('Beautician.social.oauth', 'facebook') }}"><img src="{{ asset('front/assets/images/icons/facebook-icon.svg') }}" alt="Facebook"></a>
                    </li>
                    <li>
                      <a href="{{ route('Beautician.social.oauth', 'google') }}"><img src="{{ asset('front/assets/images/icons/google-plus-icon.svg') }}" alt="Google Plus"></a>
                    </li>
                  </ul>
                  <span>Already have an account? <a href="{{ route('beautician.login') }}" class="link">Log In</a></span>
                </div> -->
              </div>
            </form>
          </div>
        </div>
      </div>
  	</div>
  	<div class="col-lg-6">
      <div class="bg-background" style="background-image: url({{ asset('front/assets/images/backgrounds/background1.png)') }};"></div>
  	</div>
  </div>
</section>
@include('front::layouts.js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.doc').hide();
    $('.js-example-basic-multiple').select2();
}); 
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
      doc:{
        required:"#customCheck2:checked"
      },
      "services[]":{
        required:"#customCheck2:checked"
      },
      Terms: {
        required: true,
      },
      id_proof: {
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
      "services[]": "Please select services",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      },
      confirm_password: {
        required: "Please enter confirm password",
      },
      phone_no: {
        required: "Please enter your phone number",
        minlength: "Phone number must be at least 7 number long",
        maxlength: "Phone number can not more then 12 number long",
        digits: "Please enter a valid phone number",
      },
      email: {
        required: "Please enter your email id",
        email: "Please enter a valid email address"
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
<script type="text/javascript">
  $(".coupon_question").on('change', function() {
    if($(this).is(":checked")) {
        $(".doc").show(300);
        $(this).attr('value', 'true');
    } else {
        $(".doc").hide(200);
        $(this).attr('value', 'false');
    }
 });
</script>
</body>
</html>