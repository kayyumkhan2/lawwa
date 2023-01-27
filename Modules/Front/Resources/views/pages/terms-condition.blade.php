@extends('front::layouts.master')
@section('title') Terms-condition @endsection
@section('content')

<!-- Lawwa Page Title -->
<section class="lawwa-page-title style-two" style="background-image: url({{asset('front/assets/images/backgrounds/bg-background.png')}})">
  <div class="container">                                           
    <h2>Terms &amp; Condition</h2>        
    <!-- <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Terms &amp; Condition</li>
      </ol>
    </nav> -->
  </div>
</section>
<section class="breadcrumb-block">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="https://lawwa.ezxdemo.com">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
           <li class="breadcrumb-item active" aria-current="page">Terms &amp; Condition</li>
        </ol>
      </nav>
    </div>
  </section>

<!-- Terms & Condition -->
<section class="terms">
  <div class="container">
    <div class="terms-block">
    <div class="terms-header">
      <div class="img-block">
        <img src="{{asset('front/assets/images/terms-img.png')}}" alt="Terms">
      </div>
      <div class="heading-block">
        <h2>Terms &amp; Conditions</h2>
        <p>Updated May 06, 2021</p>
      </div>
    </div>
    <div class="terms-info">
      <div class="row">
        <div class="col-md-3">
          <div class="left-side-bar">
            <ul class="side-bar">
            @foreach($TermCondition as $key=>$Condition)
              <li>
                <a href="#{{$Condition->term}}" class="active sidebrcls">{{$Condition->term}}</a>
              </li>
            @endforeach  
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="all-terms-block">
            @foreach($TermCondition as $key=>$Condition)
              <div class="trems-wrap" id="{{$Condition->term}}">
                <p>{!!$Condition->condition!!}</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
@endsection

<script>
  $('a').click(function (e) {
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, 1500);
    });
</script>
<script>
  $(document).ready(function(){
    $('.side-bar li a').click(function(){
      $('li a').removeClass("active");
    $(this).addClass("active");
  });
});
</script>



