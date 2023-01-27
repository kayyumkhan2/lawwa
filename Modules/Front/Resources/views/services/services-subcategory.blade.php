@extends('front::layouts.master')
@section('title') Services-Category @endsection
@section('content')
<!-- Lawwa Page Title -->
<section class="lawwa-page-title" style="background-image: url({{ asset('front/assets/images/backgrounds/services.png')}}">
  <div class="container">
    <h2>Services</h2>
    <h6>Lawwa.Asia, Your Personal Beauty Therapist</h6>
    <h4>Your Beauty Treatments, Lawwa is within you</h4>
  </div>
</section>

<!-- Lawwa Services -->
<section class="breadcrumb-block">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item"><a href="{{route('services.servicescategory')}}">Services</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item active" aria-current="page">Services Subcategory</li>
        </ol>
      </nav>
    </div>
  </section>
<section class="services">
  <!-- <div class="tabs-background" style="background-image: url(front/assets/images/backgrounds/bg-background.png);">
  </div> -->
  <div class="container">    
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
        <div class="service-wrap">
          <div class="row">
             @if (count($ServiceCategories) > 0)
               @foreach($ServiceCategories as $ServiceCategory)
              <div class="col-lg-4 col-sm-6">
              <a href="{{route('services',$ServiceCategory->id)}}" class="service-item">
                <i class="fa fa-eye" aria-hidden="true"></i>
                <div class="img-block">
                  <div class="table-wrap">
                    <div class="align-wrap">
                      <img src="{{ asset('public/images/categoriesimages/'.$ServiceCategory->image) }}" alt="service">
                    </div>
                  </div>
                </div>
                <div class="service-info">
                  <span>{{$ServiceCategory->name}} </span>
                </div>
              </a>
            </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@jquery
@toastr_js
@toastr_render
@endsection
