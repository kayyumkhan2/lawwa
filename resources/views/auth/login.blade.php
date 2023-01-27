<!doctype html>
<html>
   @include('admin::layouts.css')
   @section('title')  Login  @endsection
   <body>
      <div class="login-page">
         <div class="login-box">
            <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
               <div class="lawwa-table-wrap">
            <div class="contentBox">
               <div class="logo d-flex flex-wrap w-100">
                  <a href="{{route('front.home')}}">  <img src="{{ asset('front/assets/images/icons/form-icon.svg') }}" alt="Logo"></a>
               </div>
               <h4>Welcome to Lawwa.Asia Your Personal Beauty Therapist</h4>
               <form class="mt-4" method="POST" action="{{ route('login') }}" autocomplete="random">
                  @csrf
                  <div class="form-group">
                     <label>Email Address</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fal fa-envelope"></i></span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="new-password" autofocus placeholder="Example@gmail.com">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Password @if (Route::has('password.request'))<a class="float-right forgot-text" href="{{ route('password.request') }}">Forgot your password?</a></label>
                     @endif
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fal fa-lock"></i></span>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  @error('invalidrole')
                  <div class="alert alert-danger" role="alert">Please enter valid login Details!</div>
                  @enderror
                  <div class="form-group">
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" value='1' id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Keep me signed in</label> 
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="btn-block">
                        <button type="submit" class="lawwa-btn d-block w-100">Login</button>
                     </div>
                  </div>
                  <div class="form-group text-center">
                     <a class="bottom-link" href="{{route('customer.signup')}}">New to Lawwa? Create an account</a>
                  </div>
               </form>
            </div>
         </div>
         </div>
         <div class="col-lg-6 col-md-12">
            <div class="imgBox">                                     
               <div class="bg-background" style="background-image: url({{ asset('front/assets/images/backgrounds/background1.png') }});"></div>
               <!-- <img src="{{asset('front/assets/images/backgrounds/background1.png')}}" alt="image"> -->
            </div>
         </div>
      </div>
      </div>
      </div>
      @include('admin::layouts.js')
      @include('sweetalert::alert')
      @if(session()->has('status'))
        <script>
          swal("Success!", "{{ session()->get('status') }}", "success");
        </script>
    @endif
   </body>
</html>
