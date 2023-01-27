<section class="about">
   <div class="container">
      <div class="img-block">
         @if($page->name=="Aboutus")
         <img src="{{ asset('/images/icart.png') }}" alt="icart" height="300" width="300">
         @elseif($page->name=="Terms")
         <img src="{{ asset('/images/icart2.png') }}" alt="icart" height="300" width="300">
         @else
         <img src="{{ asset('/images/icart3.png') }}" alt="icart" height="300" width="300">
         @endif
      </div>
      <div class="content-wrap">
         <h2> {{$page->title}}</h2>
         <h6>About us</h6>
         {!! $page->content !!}
      </div>
   </div>
</section>
<style type="text/css">
   body {
   color: #000000;
   font-family: 'Roboto', sans-serif;
   font-weight: 400;
   font-size: 14px;
   line-height: 1.42857143;
   text-rendering: auto;
   }
   *, *:focus {
   outline: none;
   }
   img {
   max-width: 100%;
   height: auto;
   }
   h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {
   font-size: 60px
   padding-bottom: 10px;
   margin-bottom: 0;
   font-family: 'Roboto', sans-serif;
   font-weight: 500;
   line-height: 1.3;
   margin: 0;
   }
   p {
   margin: 0;
   padding-bottom: 10px;
   color: #484848;
   font-size: 38px;
   line-height: normal;
   }
   section {
   padding: 50px 0;
   }
   .about .img-block {
   text-align: center;
   padding-bottom: 20px;
   }
   .content-wrap {
   padding: 0 50px;
   }
   .content-wrap h2 {
   font-size: 90px;
   padding-bottom: 15px !important;
   font-weight: 800;
   padding-bottom: 0;
   }
   .content-wrap h6 {
   font-size: 46px;
   font-weight: 600;
   padding-bottom: 10px;
   padding-top: 15px;
   }
</style>
