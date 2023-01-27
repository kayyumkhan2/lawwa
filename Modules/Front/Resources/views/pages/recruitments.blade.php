@extends('front::layouts.master')
@section('title') Recruitments @endsection
@section('content')
<!-- Lawwa Recruitments -->
<section class="lawwa-recruitments">
  <div class="container">
    <div class="recruitments-wrap">
      @foreach($Recruitments as $Recruitments)
      <div class="recruitment-block">
        <div class="heading-left">
          <h2>{{$Recruitments->heading}}</h2>
          <span>{{date("d-m-Y", strtotime($Recruitments->created_at))}}</span>
        </div>
        <a href="{{route('pages.recruitments-details',['id'=>$Recruitments->id])}}" class="lawwa-btn apply-btn">Apply Now</a>
        <p>{!!$Recruitments->content!!}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection