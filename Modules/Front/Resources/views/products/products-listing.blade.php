@extends('front::layouts.master')
@section('title') Products-listing @endsection
@section('content')
<!-- Lawwa Page Title -->
<section class="lawwa-page-title style-two" style="background-image: url({{ asset('front/assets/images/backgrounds/bg-background.png')}}">
  <div class="container">
    <h2>Products-listing</h2>
    <!-- <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product Search</li>
      </ol>
    </nav> -->
  </div>
</section>
<section class="breadcrumb-block">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('front.home')}}">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item"><a href="javascript:history.go(-1)">Products Categories</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item active" aria-current="page" style="text-transform: lowercase;">Products Listing</li>
        </ol>
      </nav>
    </div>
  </section>

<!-- Product Add -->
  <section class="add-banner">
    <div class="container">
      <div class="row">
        @if (count($ProductCategories) > 0)
         @foreach($ProductCategories as $key=>$ProductCategory)
        <div class="col-6">
          <div class="img-block">
            <div class="lawwa-table-wrap">
              <div class="lawwa-align-wrap">
                <a href="{{route('products.productslisting',$ProductCategory->id)}}"><img src="{{ asset('public/images/categoriesimages/'.$ProductCategory->image) }}" alt="Add"></a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
       @endif
      </div>
    </div>
  </section>

<!-- Product Listing -->
  <section class="product-listing">
    <div class="container">
      <div class="product-title-wrap">
        <div class="row align-items-center">
          <div class="col-xl-3 col-lg-4">
            <h3>Product Listing</h3>
            <span>Total : {{($Productlist)->count()}} Products</span>
          </div>
          <div class="col-xl-6 col-lg-5">
            <div class="form-group m-0">
              <form method="get" action="{{route('products.productslisting',['id'=>$id])}}">
              <input type="text" name="Search" class="form-control" placeholder="Search item...">
              <input type="text" value="{{request()->filter}}" name="filter" hidden="">
              <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
              </form>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3">
            <div class="form-group m-0">
              <select class="form-control" id="Product-filter">
                <option value="filters"  @if(request()->get('filter')=="All" || request()->get('filter')=="new" || request()->get('filter')=="price_desc" || request()->get('filter')=="price_asc" || request()->get('filter')=="Customer_Rating" ) style="display: none;" @endif selected="" >Products filter</option>
                <option value="All" {{request()->get('filter')  == 'All' ? 'selected' : ''}} > All</option>
                <option value="new" {{request()->get('filter')  == 'new' ? 'selected' : ''}}> New Arrival</option>
                <option value="price_desc" {{request()->get('filter')  == 'price_desc' ? 'selected' : ''}}> Price: High to Low</option>
                <option value="price_asc" {{request()->get('filter')  == 'price_asc' ? 'selected' : ''}}> Price: Low to High</option>
                <option value="Customer_Rating" {{request()->get('filter')  == 'Customer_Rating' ? 'selected' : ''}}> Customer Rating</option>
               {{-- <option value="discount" {{request()->get('filter')  == 'discount' ? 'selected' : ''}}> Better Discount</option> --}}
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        @if (($Productlist)->count() > 0)
        @foreach($Productlist as $Product)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <a class="heart-icon" href="{{route('customer.my-favourite.addtomyfavourite',$Product->id)}}">
                    <i class="fa fa-heart" aria-hidden="true" 
                      @auth
                        @if(Auth::user()->MyFavouriteList->contains('product_id',$Product->id))
                          style="color: #D83968;"
                        @endif
                      @endauth>
                    </i>
                  </a>
                  <a href="{{route('product-details',$Product->id)}}"><img src="{{asset('images/productsimages/'.$Product->product_thumbnail)}}" alt="Product"></a>
                </div>
              </div>
            </div>
            <figcaption>
              <ul class="review-block">
              <?php
              $totalRating = 5;
              $starRating = round(2*($Product->ProductReviewRatings)->avg('rating') )/2;
              for ($i = 1; $i <= $totalRating; $i++) {
                   if($starRating < $i ) {
                      if(is_float($starRating) && (round($starRating) == $i)){
                          echo '<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>';
                      }else{
                          echo '<li><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                      }
                   }else {
                      echo '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
                  }
              }
              ?>
              </ul>
              <h6>{{$Product->name}}</h6>
              <div class="cart-info">
                <h2>
                  RM {{$Product->sale_price }}
                  <span>RM {{$Product->price}}</span>
                </h2>
                <span class="link">
                  {{ round((($Product->price  - $Product->sale_price )*100) /$Product->price) }} % OFF 
                </span>
              </div>
                <a href="{{route('product-details',$Product->id)}}"  class="lawwa-btn" data-product_id="{{$Product->id}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</a> 
            </figcaption>
          </figure>
        </div> 
         @endforeach 
        @endif
      </div>
    </div>
    <div class="mt-1 mr-5 float-right"> 
        {{ $Productlist->links() }}
    </div>
  </section>
@endsection
@section('js')
<script type="text/javascript">
   $('#Product-filter').change(function(){
     var filtertype = $(this).val();
     if (filtertype != "filters") {
       var url = "{{route('products.productslisting',$id)}}"+"/"+'?filter='+filtertype;
       window.location = url ;
     }
  });
</script>
@endsection