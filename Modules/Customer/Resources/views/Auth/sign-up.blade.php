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
</head>
<body>
<div class="preloader"><img src="{{ asset('images/lawwaloder.gif' ) }}"></div>
<section class="form-wrap">
  <div class="row">
  	<div class="col-lg-6">
      <div class="lawwa-table-wrap">
        <div class="lawwa-align-wrap">
          <div class="form-content">
            <div class="img-block">
            <a href="{{route('front.home')}}">  <img src="{{ asset('front/assets/images/icons/form-icon.svg') }}" alt="Logo"></a>
            </div>
            <div class="section-form-title">
              <h3 class="form-title">Welcome to Lawwa.Asia Your Personal Beauty Therapist</h3>
            </div>
            <form  method="POST" name="registration" action="{{ route('customer.signuppost') }}" class="form" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                  	<span class="Required"></span>
                    <input type="text" name="full_name"  class="form-control" value="{{ old('full_name') }}" placeholder="Full name">
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
                    <input type="text" name="Emergency_Number"  maxlength="12" minlength="7"  class="form-control" value="{{ old('Emergency_Number') }}" placeholder="Emergency number">
                  @if ($errors->has('Emergency_Number'))
                      <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('Emergency_Number') }}</strong> 
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
                 <div class="form-group">
                  <span class="Required"></span>
                  <div class="custom-file">
                    <input type="file" name="Id_Proof"   class="form-control custom-file-input">
                    <label class="custom-file-label" for="validatedCustomFile">Id Proof</label>
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
                    <span class="Required"></span>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="Address_Location" placeholder="Address / Location">{{ old('Address_Location') }}</textarea>
                        @if ($errors->has('Address_Location'))
                        <span class="invalid feedback" role="alert"> 
                            <strong class="text-danger">{{ $errors->first('Address_Location') }}</strong> 
                        </span>
                  	@endif     
              </div>
              </div>
                <div class="col-md-6">
                  <div class="form-group">
                  	<span class="Required"></span>
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
                      <input type="checkbox" class="custom-control-input" id="customCheck1" name="Terms">
                      <label class="custom-control-label" for="customCheck1">I Accept the <a href="{{route('pages.terms-condition')}}" target="_blank"  class="link">Terms and Conditions</a></label>
                    </div>
                  </div>
                </div>
                <div class="btn-block form-group col-lg-12">
                  <button type="submit" class="lawwa-btn d-block w-100">Sign Up</button>
                </div>
                <div class="form-group text-center col-lg-12 ">
                   <a class="bottom-link" href="{{ route('customer.login') }}">Already have an account? Login</a>
                </div>
                <!-- <div class="social-login">
                  <span>Or Sign In With</span>
                  <ul>
                    <li>
                      <a href="{{ route('Customer.social.oauth', 'facebook') }}"><img src="{{ asset('front/assets/images/icons/facebook-icon.svg') }}" alt="Facebook"></a>
                    </li>
                    <li>
                      <a href="{{ route('Customer.social.oauth', 'google') }}"><img src="{{ asset('front/assets/images/icons/google-plus-icon.svg') }}" alt="Google Plus"></a>
                    </li>
                  </ul>
                  <span>Already have an account? <a href="{{ route('customer.login') }}" class="link">Log In</a></span>
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
       Emergency_Number: {
        required: true,
        digits: true,
      },
      Id_Proof: {
        required: true,
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
      Address_Location: "Please enter your Address",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      },
       Id_Proof: {
        required: "Please upload your Id Proof",
      },
        Emergency_Number: {
        required: "Please enter your emergency number",
        minlength: "Phone number must be at least 7 number long",
        maxlength: "Phone number can not more then 12 number long",
        digits: "Please enter a valid emergency number",
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
</body>
</html>