<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <meta name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, user-scalable=0" />
   @yield('meta')
   <title>@yield('title')</title>
   @yield('links')
   @yield('csslink')
   <link rel="icon" type="image/png" href="{{ asset('images/favicon-32x32.png') }}" sizes="32x32" />
   <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
   <link href="{{ asset('admin/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
   <link  rel="stylesheet" href="{{ asset('admin/css/style.css' ) }}" type="text/css">
   <link  rel="stylesheet" href="{{ asset('admin/css/select2.min.css' ) }}" type="text/css">
   @yield('jslink')
   @yield('css')
   <style type="text/css">
      .starlabel:after {
         content:" * ";
         color:red;
      }
      .tdwidth {
         min-width: 100px;
      }
   .Statuschange{
      cursor: pointer;
   }    
   </style>
   <style type="text/css">
      #loading {
      position: fixed;
      width: 100%;
      height: 100vh;
      background: #fff url("{{ asset('images/adminloader.gif')}}")  no-repeat center center;
      z-index: 9999;
   }
   </style>
   <style type="text/css">
      .select2-selection__rendered {
         line-height: 41px !important;
      }
      .select2-container .select2-selection--single {
         height: 45px !important;
      }
      .select2-selection__arrow {
         height: 44px !important;
      }
   </style>
   <style type="text/css">    
      .error
      {
         font-family:Constantia, "Lucida Bright", "DejaVu Serif", Georgia, serif  !important;
         color: #F8000F !important;
         font-size:12px !important;
      }
   </style>
   <style type="text/css">
      .alert-success
      {
         height: 55px ;
      }
      #show-edit
      {
         margin: 1px 8px 1px;
      }
      #delete-btn
      {
         margin: 1px 8px 1px;
      }
      #show-btn
      {
         margin: 1px 6px 1px;
      }
   </style>
</head>
