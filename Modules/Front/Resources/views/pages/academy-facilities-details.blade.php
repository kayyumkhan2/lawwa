@extends('front::layouts.master')
@section('title') Academy facilities details @endsection
@section('content')
<!-- Lawwa Page Title -->
<section class="lawwa-page-title style-two" style="background-image: url({{ asset('front/assets/images/backgrounds/bg-background.png')}})">
  <div class="container">
    <h2>Facilities Details</h2>
  </div>
</section>
<section class="breadcrumb-block">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item"><a href="{{route('pages.academy')}}">Academy</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item active" aria-current="page">Facilities Details</li>
        </ol>
      </nav>
    </div>
  </section>
<section class="course-details">
  <div class="container">
    <h2 class="section-title">{{ucfirst($AcademyFacility->heading)}}</h2>
    <div class="row">
      <div class="col-lg-12 col-md-12">
         <div class="courese-wrap">
        <div class="img-block">
          <img src="{{asset('images/frontpages/academyfaculty/'.$AcademyFacility->image)}}" alt="IMAGE">
        </div>  
        {!!$AcademyFacility->content!!}
      </div>  
    </div>
  </div>
</div>
</section>
@endsection