@extends('front::layouts.master')
@section('title') My Favourite @endsection
@section('content')
<section class="my-favourite">
  <div class="container">
    <div class="row">
     @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="feedback-header">
            <h6>My Favourite {{--({{count($MyFavourite)}})--}}</h6>
          </div>
          <div class="favourite-content">
          @foreach($MyFavourite as $Favourite)
            <div class="favourite-signal notification{{$Favourite->id}}">
              <div class="row align-items-center">
                <div class="col-xl-2 col-sm-3">
                  <div class="img-block">
                    <div class="lawwa-table-wrap">
                      <div class="lawwa-align-wrap">
                        <img src="{{ asset('images/productsimages/'.$Favourite->productDetails->product_thumbnail)}}" alt="Product">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-sm-6">
                  <a href="{{route('product-details',$Favourite->product_id)}}" class="heading">{{$Favourite->productDetails->name}}</a>
                  <span><span> {{round(2*($Favourite->productDetails->ProductReviewRatings)->avg('rating') )/2}} <i class="fa fa-star" aria-hidden="true"></i></span> ({{($Favourite->productDetails->ProductReviewRatings)->count()}})</span>
                  <h6>{{$Favourite->productDetails->sale_price}}<span>{{$Favourite->productDetails->price}}</span></h6>
                  <span>{{ round((($Favourite->productDetails->price  - $Favourite->productDetails->sale_price )*100) /$Favourite->productDetails->price) }}% OFF</span>
                </div>
                <div class="col-xl-4 col-sm-3 text-left text-md-right">
                    <a class="icon-btn delete universaldelete" href="javascript:void(0);" data-status="0" data-id="{{ $Favourite->id}}"  data-model="MyFavourite" id="notification{{$Favourite->id}}" > <i class="fal fa-trash-alt" id="delete-btn"></i>Delete</a> 
                </div>
              </div>
            </div>
           @endforeach
          </div>
          <div class="mt-1 float-right"> 
            {{ $MyFavourite->links() }}
          </div>              
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
