@extends('front::layouts.master')
@section('title') Privacy policy @endsection
@section('content')
<!-- Lawwa Page Title -->
<section class="lawwa-page-title style-two" style="background-image: url({{asset('front/assets/images/backgrounds/bg-background.png')}})">
  <div class="container">
    <h2>Privacy Policy</h2>
    <!-- <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
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
           <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
        </ol>
      </nav>
    </div>
  </section>

<!-- Privacy Policy -->
<section class="privacy-policy">
  <div class="container">
    <div class="inner-wrap">
      <h2 class="section-title text-center">Privacy Policy</h2>
      @if ($PrivacyPolicy =='')
      <h6>Your privacy is important to us ?</h6>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
      <ul>
        <li>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
        <li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially It was popularised sheets.</li>
        <li>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical.</li>
        <li>The standard chunk of Lorem Ipsum used since the reproduced.</li>
      </ul>
      <h6>There are many variations of passages of Lorem Ipsum</h6>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
      <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over old Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscur.</p>
      <h6>The standard chunk is reproduced ?</h6>
      <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from more obscur.</p>
      <ul>
        <li>Latin professor at Hampden-Sydney College in Virginia.</li>
        <li>looked up one of the more obscure Latin words, consectetur,</li>
      </ul>
      <h6>The standard chunk of used since the is reproduced ?</h6>
      <p>Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source lorem ipsum comes from sections Finibus Bonorum et Malorum by Cicero, written this book is a treatise on the theory of ethics.</p>
      @else
      {!! $PrivacyPolicy->content !!}
      @endif
    </div>
  </div>
</section>


@endsection