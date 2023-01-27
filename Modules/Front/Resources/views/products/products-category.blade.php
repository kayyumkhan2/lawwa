@extends('front::layouts.master')
@section('title') Products-Category @endsection
@section('content')                                     
<section class="lawwa-page-title" style="background-image: url({{asset('front/assets/images/backgrounds/product.png')}})">
  <div class="container">                               
    <h2>Product</h2>  
    <h6>Lawwa.Asia, Your Personal Beauty Therapist</h6>
    <h4>Be Lawwa, be Confident, be You</h4>
  </div>
</section>

<!-- Lawwa Product -->
<section class="product">
  <div class="container">
    <h2 class="section-title">Product</h2>
    <p>Our beauty products comprise a range of items that are used for the purpose of enhancing the physical attractiveness and care for your face and body. All of our products are formulated using natural sources and we are committed to only offering the best quality to our customers. </p>
    <div class="row">
      @if (count($ProductCategories) > 0)
         @foreach($ProductCategories as $key=>$ProductCategory)
      <div class="col-md-4">
        <figure>
          <div class="img-block">
            <div class="lawwa-table-wrap">
              <div class="lawwa-align-wrap">
                <img src="{{ asset('public/images/categoriesimages/'.$ProductCategory->image) }}" alt="Product">
              </div>
            </div>
          </div>
          <figcaption>
            <a href="{{route('products.productslisting',$ProductCategory->id)}}" class="stretched-link">{{$ProductCategory->name}}</a>
          </figcaption>
        </figure>
      </div>
       @endforeach
    @endif
     
    </div>
  </div>
</section>

@endsection