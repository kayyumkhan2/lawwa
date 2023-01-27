@extends('front::layouts.master')
@section('title') Home @endsection
@section('content')
<!-- Lawwa Page Title -->                                                         
<section class="lawwa-page-title style-two" style="background-image: url({{asset('images/backgrounds/bg-background.png')}})">
  <div class="container">                                           
    <h2>Courses Details</h2>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Courses Details</li>
      </ol>
    </nav>
  </div>
</section>

<section class="course-details">
  <div class="container">
    <h2 class="section-title">About this Course</h2>
    <div class="row">
      <div class="col-md-8">
        <div class="about-course">
          <ul>
            <li><span class="info">U1</span> Introduction</li>
            <li><span class="info">U2</span> Proto-drawing</li>
            <li><span class="info">U4</span> Now, let’s draw!</li>
            <li><span class="info">U5</span> Final Project</li>
            <li><span class="info">U3</span> Basic notions: the sketch artist’s ABCs</li>
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="corse-price">
          <h3>Trending</h3>
          <h4>RM 50.00</h4>
          <div class="btn-block">
            <a href="javascript:void(0);" class="lawwa-btn d-block w-100"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="courese-wrap">
          <img src="{{asset('front/assets/images/about-img.png')}}" alt="Team">

        </div>  
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="courese-wrap">
        <p>Lorem ipsum dolor sittem ametamngcing elit, per sed do eiusmoad teimpor sittem elit inuning ut sed sittem do eiusmod.</p>
          <p>Academy Team Our training development team handle the learning and professional development of Lawwa.Asia's workforce. It is our duty to equip our organisation with the knowledge, practical skills and motivation to carry out our work activities effectively..</p>
          <p>Product Development We are always in the process of bringing new products to our clients. Our top priority is to make sure all products are safe to use and at the highest quality. Find out more about our products here.</p>
          <p>Research Development Our research development team develop research programs incorporating current developments to improve existing products and study potential of new products.</p>
          <p>Marketing Team Our marketing team promotes our business and drives sales of Lawwa.Asia’s products and services at the same time provides necessary research to identify our target customers and other potential markets.</p>
          <p>Technology Team Being the heart of Lawwa.Asia, the technology team is the heart-beat of the whole system. Headed by Tuan HjZamZam, the team ensures all applications and equipment are running smoothly and efficiently.</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection