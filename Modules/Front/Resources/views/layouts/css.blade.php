<head>
   <meta charset="utf-9">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <meta name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, user-scalable=0" />
   @yield('meta')
   <title>@yield('title')</title>
  <meta charset="UTF-8">
   <meta name="description" content="Lawwa">
   <meta name="keywords" content="Lawwa">
   <meta name="author" content="Lawwa">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <title>Lawwa - Index</title>
   @yield('links')
   <link rel="shortcut icon" href="{{ asset('front/assets/images/icons/icon1.ico' ) }}" type="image/x-icon">
   <!-- Lawwa External CSS -->
   <link href="{{ asset('front/assets/css/magnific-popup.css' ) }}" rel="stylesheet" type="text/css" media="all">
   <link href="{{ asset('front/assets/css/intlTelInput.min.css' ) }}" rel="stylesheet" type="text/css" media="all">
   <link href="{{ asset('front/assets/css/animate.min.css' ) }}" rel="stylesheet" type="text/css" media="all">
   <link href="{{ asset('front/assets/css/swiper-bundle.min.css' ) }}" rel="stylesheet" type="text/css" media="all">
   <link href="{{ asset('front/assets/css/font-awesome.min.css' ) }}" rel="stylesheet" type="text/css" media="all">
   <link href="{{ asset('front/assets/css/bootstrap.min.css' ) }}" rel="stylesheet" type="text/css" media="all">
   <link href="{{ asset('front/assets/css/styles.css' ) }}" rel="stylesheet" type="text/css" media="all">
   <link href="{{ asset('front/assets/css/responsive.css' ) }}" rel="stylesheet" type="text/css" media="all">
   <link href="{{ asset('front/assets/css/owl.carousel.min.css' ) }}" rel="stylesheet" type="text/css" media="all">
   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
   @toastr_css


   @yield('cdnlinks')  
   @yield('jslinktop')
   @yield('csslinktop')
   @yield('customcss')
    <style type="text/css">
    .pointer {cursor: pointer;}
    .Required:after {
      content:" * ( Required ) ";
      color: #D83968; 
      }
      .asterisk:after {
      content:" *";
      color: #D83968; 
      }
      .asteriskconact:after {
      content:" * ( Required ) ";
      color: white; 
      }
      .Optional:after {
      content:"( optional ) ";
      color: #D83968;
      }
   .tdwidth {
      min-width: 100px;
   }    
   </style>
   <style type="text/css">
   .error{
      color:red !important;
      font-size: 15px !important;;
      }
   .preloader {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-repeat: no-repeat; 
      background-color: #FFF;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
}
.service-wrap .service-item {
      position: relative;
      border: 1px solid #C7C7C7;
      background-color: #fff;
      display: inline-block;
      transition: all ease .4s;
      width: 100%;
}
   </style>
</head>
