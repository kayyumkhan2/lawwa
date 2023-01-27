@extends('front::layouts.master')
@section('title') Product cart @endsection
@section('content')
<section class="cart">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="cart-block content">
        @if(((Auth::user()->ProductCarts)->count())>0)
          <div class="cart-header">
            <div class="row align-items-end">
              <div class="col-7">
                <h2>Cart items (<span class="ProductCartCount"></span>) </h2>
              </div>
              <div class="col-5 text-right">
                <a href="javascript:void(0)" class="link" id="emptyproductcart">All Items Clear</a>
              </div>
            </div>
          </div>
          @endif
          @if(((Auth::user()->ProductCarts)->count())>0)
          <div id='GetProductCart'>
          </div>
            <div class="btn-block">
              <a href="{{route('products.productscategory')}}" class="lawwa-btn">Continue Shopping</a>
            </div>
            @else
            <div class="container-fluid mt-100">
              <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                              <h5>Cart</h5>
                          </div>
                          <div class="card-body cart">
                              <div class="col-sm-12 empty-cart-cls text-center"> <img src="{{asset('images/carticon.png')}}" width="130" height="130" class="img-fluid mb-4 mr-3">
                                  <h3><strong>Your Cart is Empty</strong></h3>
                                  <h4>Add something to make me happy :)</h4> <a href="{{route('products.productscategory')}}" class="btn btn-primary cart-btn-transform m-3 lawwa-btn" data-abc="true">Continue Shopping</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          @endif  
        </div>
      </div>
    @if(((Auth::user()->ProductCarts)->count())>0)
      <div class="col-lg-4">
        <div class="right-siderbar">
          <div class="sidebar">
            <div class="sidebar-header">
              <h6>Price Details</h6>
            </div>
            <ul class="sidebar-info">
              <li>
                <span class="service-name">Subtotal (<span id="producttotalquantity"> </span> item)</span>
                <span class="service-price">RM <span id="sub_total"></span></span>
              </li>
              <li>
                <span class="service-name">Discount</span>
                <span class="service-price link"> RM <span id="totaldiscount"></span></span>
              </li>
              <li>
                <span class="service-name">Shipping</span>
                <span class="service-price link"> RM <span id="ShippingCharges"></span></span>
              </li>
            </ul>
            <ul class="full-amount">
              <li>
                <span class="amount-title">Order Total</span>
                <span class="totle-price">RM <span id="totalsaleprice"></span> </span>
              </li>
            </ul>
            <div class="btn-block">
              <a href="{{route('cart.Checkout')}}" class="lawwa-btn lawwa-pink-btn">Proceed to Checkout</a>
            </div>
          </div>
          <div class="btn-block mt-4">
            <a href="javascript:history.go(-1)" class="lawwa-btn">Back</a>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</section>
@endsection
@section('js')
<script>
    function CheckOutCart() {
      $.ajax({
        url:"{{ route('CheckOutCart') }}",
        type: 'get', 
        dataType: 'json',
        success: function(response){
          if(response.totalquantity<=0){
            swal({
                  title:"error!",
                  text: "Your cart is empty please select item before checkout!",
                  icon: "info",
              }).then(function() {
                  window.location.href = "{{route('products.productscategory')}}";
              });
           }
          $('#CheckOutCart').html(response.data);
          $('#producttotalquantity').html(response.totalquantity);
          $('#totalsaleprice').html(response.totalsaleprice);
          $('#totaldiscount').html(response.totaldiscount); 
          $('#sub_total').html(response.sub_total);
          $('#ShippingCharges').html(response.ShippingCharges);
        }
      });
    }
</script>
<script>
function AddToCartProduct(product_id,type="simple",cartquantity=1) {
$.ajax({
      url:"{{ route('AddToCartProduct') }}",
      type: "POST",
      dataType: 'json',
      data:{
          product_id: product_id,cartquantity,type:type,_token: '{{csrf_token()}}' 
        },
      success: function(response){
        Get_Cart_Product_Count();
        GetProductCart();
        CheckOutCart();
        if (type=="up") {
          toastr.success('Product add successfully to cart!', "", options);  
        }
        else if(type=="down"){
          toastr.success('Product remove successfully to cart!', "", options);  
        }
        else{
            toastr.success('Product add successfully to cart!', "", options);  
        }
      }
  });
}
</script>
@endsection