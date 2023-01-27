@extends('front::layouts.master')
@section('title') Services-Category @endsection
@section('content')
<section class="lawwa-page-title style-two" style="background-image: url({{ asset('front/assets/images/backgrounds/bg-background.png')}}">
  <div class="container">
    <h2>Beauty Services</h2>
  </div>
</section>
<section class="breadcrumb-block">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item"><a href="{{route('services.servicescategory')}}">Services</a></li>
          @if(($Category->subcategory)->count()>0)
            <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
            <li class="breadcrumb-item"><a href="javascript:history.go(-1)">Services Subcategory</a></li>
          @endif
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item active" aria-current="page" style="text-transform: lowercase;">{{strtoupper($Category->name)}}</li>
        </ol>
      </nav>
    </div>
  </section>
<!-- Lawwa Beauty Services -->
<section class="services-two">
  <div class="container">
    <h2 class="section-title style-two">{{$Category->name}}</h2>
    <p>{{$Category->description}}</p>
    <div class="service-wrap style-two">
      <div class="row">
        <div class="col-lg-8">
          <div id="content" class="content">
            @if (count($services) > 0) 
            <div class="row">
              @foreach($services as $key=> $service)
               @if (($loop->last) && ($loop->odd)) 
               <div class="col-lg-12">
                  <a href="{{route('addservicecarttocart',[$service->id,'id'=>request()->id])}}" class="service-item">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                  <div class="img-block">
                    <div class="table-wrap">
                      <div class="align-wrap">
                        <img src="{{ asset('public/images/serviceimages/'.$service->service_image) }}" alt="image">
                      </div>
                    </div>
                  </div>
                  <div class="service-info">
                    <h6>{{$service->name}}</h6>
                    <span>
                      <img src="{{ asset('front/assets/images/icons/watch-icon.svg') }}" alt="Icon" width="18" class="mr-2">
                      @if($service->houre>0){{$service->houre}} H : @endif  {{$service->minute+5}} Min.
                    </span>
                    <span class="price">RM {{$service->amount}}</span>
                  </div>
                </a>
                
              </div>
              @else
              <div class="col-lg-6">
                  <a href="{{route('addservicecarttocart',[$service->id,'id'=>request()->id])}}" class="service-item">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                  <div class="img-block">
                    <div class="table-wrap">
                      <div class="align-wrap">
                        <img src="{{ asset('public/images/serviceimages/'.$service->service_image) }}" alt="image">
                      </div>
                    </div>
                  </div>
                  <div class="service-info">
                    <h6>{{$service->name}} </h6>
                    <span>
                      <img src="{{ asset('front/assets/images/icons/watch-icon.svg') }}" alt="Icon" width="18" class="mr-2">
                      @if($service->houre>0){{$service->houre}} H : @endif  {{$service->minute+5}} Min.
                    </span>
                    <span class="price">RM {{$service->amount}} </span>
                  </div>
                </a>
              </div>
              @endif
            @endforeach
            </div>
            @endif
          </div>
        </div>
        <div class="col-lg-4">
          <div class="right-siderbar">
          @if(GetServiceCart()->count()>0)
            <div class="sidebar">
              <div class="sidebar-header">
                <h6>Price Details <span class="service-price"><a href="{{route('emptycart')}}" class="text-danger">Remove all</a></span></h6> 
              </div>
              <ul class="sidebar-info">
                @php $amount=0; @endphp
                @foreach(GetServiceCart() as $cartdata) 
                  @php
                    $AmountService="Free";
                    if($cartdata->type=="Buy"){
                      $amount+= $cartdata->ServiceDetails->amount;
                      $AmountService= $cartdata->ServiceDetails->amount;
                    }
                  @endphp
                <li>
                  <span class="service-name">{{$cartdata->ServiceDetails->name}}</span>
                  <span class="service-price">RM {{$AmountService}}</span>
                  <span class="service-price"><a href="{{route('removeservicecarttocart',$cartdata->service_id)}}" class="text-danger">Remove</a></span>
                </li>
                @endforeach
              </ul>
              <ul class="full-amount">
                <li>
                  <span class="amount-title">Total Amount</span>
                  <span class="totle-price">RM {{$amount}}</span>
                </li>
              </ul>
              <div class="btn-block">
                <a href="{{route('booking.create')}}" class="lawwa-btn lawwa-pink-btn">Book Now</a>
              </div>
            </div>
            @else
            <div class="sidebar">
              
              <div class="btn-block">
                <a href="javascript:void(0);" class="lawwa-btn lawwa-pink-btn">Service cart is empty</a>
              </div>
            </div>
            @endif
            <div class="btn-block mt-4">
                  <a href="javascript:history.go(-1)" class="lawwa-btn">Back</a>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@jquery
@toastr_js
@toastr_render
@endsection

@section('js')
 
@endsection