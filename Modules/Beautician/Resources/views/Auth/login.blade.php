<!DOCTYPE html>
<html dir="ltr" lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="description" content="Lawwa">
      <meta name="keywords" content="Lawwa">
      <meta name="author" content="Lawwa">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <title>Lawwa - Log In</title>
      <link rel="shortcut icon" href="{{ asset('front/assets/images/icons/icon1.ico') }}" type="image/x-icon">
      @include('front::layouts.css')
   </head>
   <body>
      <div class="preloader"></div>
      <!-- Lawwa Log In -->
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
                        <form class="form" method="POST" name="registration" action="{{ route('login') }}">
                           @csrf
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your mail id ">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter your password" autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" id="customCheck1">
                                       <label class="custom-control-label" for="customCheck1">Keep me signed in</label>                      
                                    </div>
                                    <a href="{{ route('password.request') }}" class="float-right link">Forgot Password?</a>
                                 </div>
                              </div>
                              <div class="btn-block col-lg-12">
                                 <button type="submit" class="lawwa-btn d-block w-100">Log In</button>
                              </div>
                             <!--  <div class="social-login">
                                 <span>Or Log In With</span>
                                 <ul>
                                    <li>
                                       <a href="{{ route('Beautician.social.oauth', 'facebook') }}"><img src="{{ asset('front/assets/images/icons/facebook-icon.svg') }}" alt="Facebook"></a>
                                    </li>
                                    <li>
                                       <a href="{{ route('Beautician.social.oauth', 'google') }}"><img src="{{ asset('front/assets/images/icons/google-plus-icon.svg') }}" alt="Google Plus"></a>
                                    </li>
                                 </ul>
                                 <span>Already have an account? <a href="{{route('beautician.signup')}}" class="link">Sign Up</a></span>
                              </div> -->
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="bg-background" style="background-image: url({{ asset('front/assets/images/backgrounds/background1.png') }});"></div>
            </div>
         </div>
      </section>
      @include('front::layouts.js')
    @include('sweetalert::alert')
    @if(session()->has('status'))
        <script>
          swal("Success!", "{{ session()->get('status') }}", "success");
        </script>
    @endif
<script type="text/javascript">
$(function() {
  $("form[name='registration']").validate({
    rules: {
      Address_Location: "required",
      "services[]": "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
      }
    },
    messages: {
      password: {
        required: "Please provide a password",
      },
      email: {
        required: "Please enter your email id",
        email: "Please enter a valid email address"
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
