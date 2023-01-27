@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')

<!-- Lawwa Page Title -->                             
<section class="lawwa-page-title style-two" style="background-image: url({{asset('front/assets/images/backgrounds/bg-background.png')}})">
  <div class="container">
    <h2>{{$pagename}}</h2>
    <!-- <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$pagename}}</li>
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
           <li class="breadcrumb-item active" aria-current="page">{{$pagename}}</li>
        </ol>
      </nav>
    </div>
  </section>

<!-- FAQ -->
<section class="faq">
  <div class="container">
    <div class="faq-block">
      <div class="accordion" id="faq">
        @if(count($FaqQuestions)>0)
        @foreach($FaqQuestions as $key=>$Questions)
        <div class="card">
          <div class="card-header" id="heading1">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">{{$Questions->question}} ?</button>
          </div>
          <div id="collapse1" class="collapse @if($key=='0') show @endif" aria-labelledby="heading1" data-parent="#faq">
            <div class="card-body">
              {!! $Questions->answer !!} 
            </div>
          </div>
        </div>
        @endforeach
        @endif
        
      </div>
    </div>    
  </div>
</section>

@endsection