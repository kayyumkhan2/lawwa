@extends('front::layouts.master')
@section('title') Order details @endsection
@section('content')
<!-- Lawwa My Account -->
<section class="my-order">
  <div class="container">
    <div class="row">
      @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="right-header">
            <div class="row align-items-center">
              <div class="col-sm-12">
                <h6>Order Details : <span class="link">{{$Order->id}}</span>
                  @if($Order->tracking_id !="")
                  <span class="float-sm-right">Tracking id : <span class="link">{{$Order->tracking_id}}</span>
                  </span>
                  @endif
                </h6>
              </div>
            </div>
          </div>
          <div class="order-info">
            <div class="upcoming-order">
              <h5>Delivery Address</h5>
              <div class="user-detail">
                <div class="img-block">
                  <img src="{{asset('front/assets/images/user-icon.png')}}" alt="User">
                </div>
                <h6>{{$Order->user_name}}</h6>
              </div>
              <span class="add-edit-type">Home</span>
              <p>{{$Order->address}}</p>
              <div class="phone-number">
                <span class="label">Phone Number</span>
                <span>{{$Order->get_user->phone_no}}</span>
              </div>
              @if(!$Order->OrderCancelReason=="") 
              <div class="phone-number">
                <span class="label">Cancel Reason</span>
                <span class="text-justify">
                    Reason  : {{$Order->OrderCancelReason->reason}} 
                    <br>
                    Comment : {{$Order->OrderCancelReason->comment}} 
              </span>
              </div>
              @endif 
            </div>
            <div class="order-status">
              <ul class="progressbar">
               @foreach($Order->OrderStatus as $data)
               <li class="active">
                  <span>{{$data->status}}</span>
                  <span>{{date('D , M Y', strtotime($data->created_at))}}</span>
                </li>
               @endforeach
              </ul>
            </div>
            <div class="order-item-info">
              <div class="row">
                @foreach ($Order->OrderProducts as $key => $value)
                <div class="col-xl-6 col-md-6 ">
                  <div class="order-left-info">
                    <div class="img-block">
                      <div class="lawwa-table-wrap">
                        <div class="lawwa-align-wrap">
                           <img src="{{ asset('images/productsimages/'.$value->product_image)}}" width="82">
                        </div>
                      </div>
                    </div>
                    <div class="order-right-info">
                      <h6>{{$value->product_name}}</h6>
                      <p>ID : <span>{{$value->product_id}}</span></p>
                      <p>Size : <span>{{ $value->size ? $value->size : 'Default' }}{{$value->size}}</span></p>
                      <p>Color : <span>{{ $value->size ? $value->color : 'Default' }}{{$value->color}}</span></p>
                      <p>Weight : <span>{{ $value->unit ? $value->unit : 'Default' }}{{$value->color}}</span></p>
                      <span class="price">RM {{$value->product_price}}</span>
                    </div>
                  </div>
                </div>
                @endforeach
               <div class="col-xl-6 col-md-6 ">
                <span>@if($Order->OrderCurrentStatus!="")
                  {{$Order->OrderCurrentStatus->status}} on {{date('D, M Y', strtotime($Order->created_at))}} @endif</span>
                @if($Order->OrderCurrentStatus!="") @if($Order->OrderCurrentStatus->status=="DELIVERED")
                  <a href="{{route('customer.product.rating.create',['id'=>$Order->id])}}"><i class="fa fa-star" aria-hidden="true"></i> Rate & Review Product</a>
                  <!-- <a href="#0"><i class="fa fa-question-circle" aria-hidden="true"></i> Need Help?</a> -->
                @endif
                @endif
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