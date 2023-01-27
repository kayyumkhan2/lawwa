@extends('front::layouts.master')
@section('title') Dashboard @endsection
@section('content')
<section class="dashboard">
  <div class="container">
    <div class="row">
           @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="row">
          <div class="col-md-6">
            <a href="{{route('customer.bookings.bookingfilter','upcoming')}}" class="dashboard-item">
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
            <a href="{{route('customer.bookings.bookingfilter','previous')}}" class="dashboard-item">
              <div class="row align-items-center">
                <div class="col-3">
                  <div class="img-block">
                    <img src="{{ asset('front/assets/images/icons/icon2.svg') }}" alt="Icon">
                  </div>
                </div>
                <div class="col-9">
                  <span>{{$previousbooking}}</span>
                  <p>Previous Bookings</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="{{route('customer.orders')}}" class="dashboard-item">
              <div class="row align-items-center">
                <div class="col-3">
                  <div class="img-block">
                    <img src="{{ asset('front/assets/images/icons/icon3.svg') }}" alt="Icon">
                  </div>
                </div>
                <div class="col-9">
                  <span>{{$totalorders}}</span>
                  <p>My Order</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="{{route('customer.Booking')}}" class="dashboard-item">
              <div class="row align-items-center">
                <div class="col-3">
                  <div class="img-block">
                    <img src="{{ asset('front/assets/images/icons/icon4.svg') }}" alt="Icon">
                  </div>
                </div>
                <div class="col-9">
                  <span>{{$totalbooking}}</span>
                  <p>Book for the service</p>
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