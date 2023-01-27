@extends('front::layouts.master')
@section('title') Recruitments @endsection
@section('content')
<!-- Lawwa Page Title -->
<section class="lawwa-page-title style-two" style="background-image: url({{ asset('front/assets/images/backgrounds/bg-background.png')}})">
  <div class="container">
    <h2>Recruitments Details</h2>
  </div>
</section>
<section class="breadcrumb-block">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="https://lawwa.ezxdemo.com">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item"><a href="javascript:history.go(-1)">Recruitments</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item active" aria-current="page">Recruitments Details</li>
        </ol>
      </nav>
    </div>
  </section>
<section class="course-details">
  <div class="container">
    <h2 class="section-title">{{$Recruitment->heading}}</h2>
    <div class="row">
      <div class="col-md-8">
        <div class="about-course">
          <ul>
            @php $i=1 @endphp
            @foreach($Recruitment->RecruitmentFeature as $key=>$features)
              <li><span class="info">{{$i++}}</span> {{$features->feature}} </li>
           @endforeach
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="corse-price">
          <div class="btn-block">
            <a href="{{route('pages.recruitmentapply.create',$Recruitment->id)}}" class="lawwa-btn d-block w-100">Apply now</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="courese-wrap">
          {!!$Recruitment->content !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection