@extends('front::layouts.master')
@section('title') Dashboard @endsection
@section('content')
<section class="dashboard">
  <div class="container">
    <div class="row">
       @include('beautician::includes.sidebar')
      <div class="col-lg-9">
        <div class="row">
          <div class="col-md-6">
            <a href="{{route('beautician.bookings.bookingfilter','upcoming')}}" class="dashboard-item">
              <div class="row align-items-center">
                <div class="col-3">
                  <div class="img-block">
                    <img src="{{ asset('front/assets/images/icons/icon1.svg') }}" alt="Icon">
                  </div>
                </div>
                <div class="col-9">
                  <span>{{$upcomingbooking}}</span>
                  <p>My Upcoming Bookings</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="{{route('beautician.bookings.bookingfilter','today')}}" class="dashboard-item">
              <div class="row align-items-center">
                <div class="col-3">
                  <div class="img-block">
                    <img src="{{ asset('front/assets/images/icons/icon2.svg') }}" alt="Icon">
                  </div>
                </div>
                <div class="col-9">
                  <span>{{$todaybooking}}</span>
                  <p>My Today Booking</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="{{route('beautician.Booking')}}" class="dashboard-item">
              <div class="row align-items-center">
                <div class="col-3">
                  <div class="img-block">
                    <img src="{{ asset('front/assets/images/icons/icon3.svg') }}" alt="Icon">
                  </div>
                </div>
                <div class="col-9">
                  <span>{{$totalbooking}}</span>
                  <p>My Bookings</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="{{route('beautician.bookings.bookingfilter','previous')}}" class="dashboard-item">
              <div class="row align-items-center">
                <div class="col-3">
                  <div class="img-block">
                    <img src="{{ asset('front/assets/images/icons/icon4.svg') }}" alt="Icon">
                  </div>
                </div>
                <div class="col-9">
                  <span>{{$previousbooking}}</span>
                  <p>Previous Bookings</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection