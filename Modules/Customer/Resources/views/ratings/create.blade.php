@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')

<!-- Lawwa My Account -->
<section class="my-account">
  <div class="container">
    <div class="row">
      @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="feedback-header">
            <h6>{{$pagename}}</h6>
        </div>
        <div class="right-content content">
           <div class="reviews-ratings">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active recive-text" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
               <form action="{{route('customer.ratings.store')}}" method="post">
                @csrf
                <input type="text" name="booking_id" value="{{ request()->get('id') }}" hidden="">
                @foreach($Booking->BookingAssign as $key=> $user)
                   <div class="ratings-details">
                  <div class="img-block">
                    <img src="{{ asset('public/images/profilepics/'.$user->profile_pic) }}" onerror="this.src='/images/usericon.png'" width="50" alt="aloe-vera" class="rounded-circle">
                  </div>
                  <div class="ratings-wrap">
                    <h4>{{$user->full_name ? $user->full_name : "Guest" }}</h4>
                    <input type="number" class="form-control" name="ratings[]" min="1" max="5" placeholder="1-5" style="border-radius:3px ;">
                    {{--<div class="star-rating">
                      <input type="radio" id="5-stars" name="ratings[]" value="5" />
                      <label for="5-stars" class="star">&#9733;</label>
                      <input type="radio" id="4-stars" name="ratings[]" value="4" />
                      <label for="4-stars" class="star">&#9733;</label>
                      <input type="radio" id="3-stars" name="ratings[]" value="3" />
                      <label for="3-stars" class="star">&#9733;</label>
                      <input type="radio" id="2-stars" name="ratings[]" value="2" />
                      <label for="2-stars" class="star">&#9733;</label>
                      <input type="radio" id="1-star" name="ratings[]" value="1" />
                      <label for="1-star" class="star">&#9733;</label>
                    </div>--}}
                  </div>
                </div>
                  <div class="reviews-detail">
                    <div class="form-group">
                      <input type="text" placeholder="user_id" value="{{$user->id}}"  class="form-control" name="beautician[]" hidden="">
                      <textarea class="form-control" name="comments[]" placeholder="Description"></textarea>
                    </div>
                  </div>
              @endforeach
              <div class="btn-block">
                <button type="submit" href="#0" class="lawwa-btn">Submit</button>
              </div>
              <form>
              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="beautician-review-block">  
                <div class="beautician-review-inner">
                  <ul>
                    <li>
                      <i class="fa fa-star" aria-hidden="true"></i>
                    </li>
                    <li>
                      <i class="fa fa-star" aria-hidden="true"></i>
                    </li>
                    <li>
                      <i class="fa fa-star" aria-hidden="true"></i>
                    </li>
                    <li>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </li>
                    <li>
                      <i class="fa fa-star-o" aria-hidden="true"></i>
                    </li>
                  </ul>
                  <span>4.5</span>
                </div>  
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection