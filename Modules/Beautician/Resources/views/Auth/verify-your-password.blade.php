<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="description" content="Lawwa">
<meta name="keywords" content="Lawwa">
<meta name="author" content="Lawwa">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Lawwa - Verify Your Password</title>
<link rel="shortcut icon" href="assets/images/icons/icon1.ico" type="image/x-icon">
<!-- Lawwa External CSS -->
<link href="assets/css/intlTelInput.min.css" rel="stylesheet" type="text/css" media="all">
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css" media="all">
<link href="assets/css/swiper-bundle.min.css" rel="stylesheet" type="text/css" media="all">
<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<link href="assets/css/styles.css" rel="stylesheet" type="text/css" media="all">
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" media="all">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- Lawwa Verify Your Password -->
<section class="form-wrap">
  <div class="row">
  	<div class="col-lg-6">
      <div class="lawwa-table-wrap">
        <div class="lawwa-align-wrap">
          <div class="form-content">
            <div class="img-block">
              <img src="{{asset('assets/images/icons/form-icon.svg')}}" alt="Logo">
            </div>
            <div class="section-form-title">
              <h3 class="form-title">Verify Your Password</h3>
              <p>Please enter the 4 Digit code send to</p>
              <p>ahmad125@gmail.com</p>
            </div>
            <form class="form">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group digit-group">
                    <input type="text" class="form-control" id="digit-1" name="digit-1" data-next="digit-2" />
                    <input type="text" class="form-control" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                    <input type="text" class="form-control" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                    <input type="text" class="form-control" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />                  
                  </div>
                  <a href="#0" class="link resend-code">Resend Code</a>
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
      <div class="bg-background" style="background-image: url(assets/images/backgrounds/background1.png);"></div>
  	</div>
  </div>
</section>

<!-- Lawwa Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/swiper-bundle.min.js"></script>
<script src="assets/js/intlTelInput.min.js"></script>
<script src="assets/js/sticky.min.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>