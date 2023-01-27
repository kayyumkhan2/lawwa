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
                           <h3 class="form-title">Create New Password</h3>
                           <p>Your new password should be at least 8  characters long</p>
                        </div>
                        @if(count($errors) > 0 )
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                              <ul class="p-0 m-0" style="list-style: none;">
                                  @foreach($errors->all() as $error)
                                  <li>{{$error}}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif   
                        <form method="POST" action="{{ route('password.update') }}" name="form" autocomplete="off">
                           <div class="row">
                              <div class="col-md-12">
                                 <input type="text" id="email" class="form-control" type="email" name="email" value="{{old('email', $request->email)}}" required  autofocus readonly="" autocomplete="off" />
                                 <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                 @csrf
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label></label>
                                    <input id="password" class="form-control" minlength="6" maxlength="6" type="password"  autocomplete="new-password" name="password" required placeholder="Enter New password">
                                    @if ($errors->has('password'))
                                    <span class="invalid feedback" role="alert"> 
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong> 
                                    </span>
                                    @endif
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label></label>
                                    <input id="password_confirmation" class="form-control"
                                       type="password"
                                       name="password_confirmation" minlength="6" maxlength="6" placeholder="Confirm New Password" autocomplete="off" required>
                                    @if ($errors->has('password_confirmation'))
                                    <span class="invalid feedback" role="alert"> 
                                    <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong> 
                                    </span>
                                    @endif
                                 </div>
                              </div>
                              <div class="btn-block col-lg-12">
                                 <button type="submit" class="lawwa-btn d-block w-100">Save</button>
                              </div>
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
         </div>
      </section>
      @include('front::layouts.js')
      <script type="text/javascript">
         $(function() {
           $("form[name='form']").validate({
             rules: {
               email: {
                 required: true,
                 email: true
               },
               password: {
                 required: true,
               },
               password_confirmation: {
                 required: true,
                 equalTo : "#password"
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
               password_confirmation: {
                 required: "Please enter confirm password",
               }
             },
             submitHandler: function(form) {
               form.submit();
             }
           });
         });
      </script>
