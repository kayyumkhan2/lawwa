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
               <form action="{{route('customer.product.rating.store')}}" method="post">
                @csrf
                <input type="text" name="order_id" value="{{ request()->get('id') }}" hidden="">
                @foreach ($Order->OrderProducts as $key => $value)
                   <div class="ratings-details">
                  <div class="img-block">
                    <img src="{{asset('images/productsimages/'.$value->product_image)}}" onerror="this.src='/images/usericon.png'" width="50" alt="aloe-vera" class="rounded-circle">
                  </div>
                  <div class="ratings-wrap">
                    <h4>{{ucfirst($value->product_name)}}</h4>
                    <input type="number" class="form-control" name="ratings[]" min="1" max="5" placeholder="1-5" style="border-radius:3px ;">
                    {{--<div class="star-rating">
                      <input type="radio" id="{{$key}}-stars" name="ratings[]" value="5">
                      <label for="{{$key}}-stars" class="star">★</label>
                      <input type="radio" id="{{$key}}-stars" name="ratings[]" value="4">
                      <label for="{{$key}}-stars" class="star">★</label>
                      <input type="radio" id="{{$key}}-stars" name="ratings[]" value="3">
                      <label for="{{$key}}-stars" class="star">★</label>
                      <input type="radio" id="{{$key}}-stars" name="ratings[]" value="2">
                      <label for="{{$key}}-stars" class="star">★</label>
                      <input type="radio" id="{{$key}}-star" name="ratings[]" value="1">
                      <label for="{{$key}}-star" class="star">★</label>
                    </div>--}}
                  </div>
                </div>
                <div class="reviews-detail">
                    <div class="form-group">
                      <input type="text" class="form-control" name="titles[]" placeholder="Tilte">
                    </div>
                  </div>
                  <div class="reviews-detail">
                    <div class="form-group">
                      <input type="text" placeholder="user_id" value="{{$value->product_id}}"  class="form-control" name="products[]" hidden="">
                      <textarea class="form-control" name="comments[]" placeholder="Description"></textarea>
                    </div>
                  </div>
              @endforeach
              <div class="btn-block">
                <button type="submit" href="#0" class="lawwa-btn">Submit</button>
              </div>
              <form>
            </div>           
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection