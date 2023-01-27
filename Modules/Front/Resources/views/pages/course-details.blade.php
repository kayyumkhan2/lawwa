@extends('front::layouts.master')
@section('title') Course details @endsection
@section('content')
<!-- Lawwa Page Title -->
<section class="lawwa-page-title style-two" style="background-image: url({{ asset('front/assets/images/backgrounds/bg-background.png')}})">
  <div class="container">
    <h2>Course Details</h2>
  </div>
</section>
<section class="breadcrumb-block">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="https://lawwa.ezxdemo.com">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item"><a href="javascript:history.go(-1)">Academy</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item active" aria-current="page">Course Details</li>
        </ol>
      </nav>
    </div>
  </section>
<section class="course-details">
  <div class="container">
    <h2 class="section-title">{{$AcademyCourse->details_page_heading}}</h2>
    <div class="row">
      <div class="col-md-8">
        <div class="about-course">
          <ul>
            @php $i=1 @endphp
            @foreach($AcademyCourse->CourseFeature as $key=>$features)
              <li><span class="info">{{$i++}}</span> {{$features->feature}} </li>
           @endforeach
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="corse-price">
          <h3>Price : </h3>
          <h4>RM {{$AcademyCourse->price}}</h4>
          <div class="btn-block">
            <!-- <a href="javascript:void(0);" class="lawwa-btn d-block w-100"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</a> -->
            <form action="{{route('selected.course.plans')}}" method="post">
              @csrf
              <input type="text" name="course_id" hidden="" class="course_id" value="{{$AcademyCourse->id}}">
              <input type="text" name="course" hidden="" class="course" value="{{$AcademyCourse->heading}}">
              <input type="text" name="price" hidden="" value="{{$AcademyCourse->price}}">
              <button type="submit" class="lawwa-btn d-block w-100"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</button>
              <!-- <a href="javascript:void(0);" class="lawwa-btn d-block w-100"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</a> -->
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="courese-wrap">
          <img src="{{asset('images/frontpages/academycourses/'.$AcademyCourse->image)}}" alt="Team">
        </div>  
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="courese-wrap">
          {!!$AcademyCourse->description !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection