<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="description" content="Lawwa">
<meta name="keywords" content="Lawwa">
<meta name="author" content="Lawwa">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Lawwa - Reset Password</title>
  @include('front::layouts.css')
</head>
<body>

<div class="preloader"></div>
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
              <h3 class="form-title">Reset Password</h3>
              <p>Enter the email associated with your account and we'll send an email with instructions to reset your password.</p>
            </div>
            <form class="form">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email id">
                  </div>
                </div>
                <div class="btn-block col-lg-12 mt-2">
                  <button type="submit" class="lawwa-btn d-block w-100">Reset Password</button>
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
</section>


<!-- Lawwa Scripts -->
@include('front::layouts.js')
</body>
</html>