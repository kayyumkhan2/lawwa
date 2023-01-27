@extends('front::layouts.master')
@section('title') News Details @endsection
@section('content')
<!-- Lawwa Page Title -->
<section class="lawwa-page-title style-two" style="background-image: url({{ asset('front/assets/images/backgrounds/bg-background.png')}})">
  <div class="container">
    <h2>News Details</h2>
  </div>
</section>
<section class="breadcrumb-block">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="https://lawwa.ezxdemo.com">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item"><a href="javascript:history.go(-1)">Gallery</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item active" aria-current="page">News Details</li>
        </ol>
      </nav>
    </div>
  </section>
<section class="course-details">
  <div class="container">
    <h2 class="section-title">{{ucfirst($GalleryNews->heading)}}</h2>
    <div class="row">
      <div class="">
      <div class="col-lg-12 col-md-12">
        <div class="courese-wrap">
          <div class="img-block">
            <img src="{{asset('images/frontpages/gallerynews/'.$GalleryNews->image)}}" alt="Team">
          </div>
          <p>{!!$GalleryNews->content!!}
        </div>
        </div>  
    </div>
  </div>
</section>
@endsection