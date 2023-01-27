@extends('front::layouts.master')
@section('title') {{$pagename}} info @endsection
@section('content')

<!-- Lawwa My Account -->
<section class="my-account">
  <div class="container">
    <div class="row">
     @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="feedback-header">
            <h6>{{$pagename}} info</h6>
          </div>
           <div class="notification-info">
            <div class="membership-body">
              <ul>
              @foreach ($UserCurrentMemberShip->MembershipInfo->MembershipFeatures as $Features)
                <li><span>{{$Features->name}}</span></li>
              @endforeach
              @foreach ($UserCurrentMemberShip->MembershipInfo->MemberShipServices as $service)
                <li><span>{{$service->name}}</span></li>
              @endforeach  
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection