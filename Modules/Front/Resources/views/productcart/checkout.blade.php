@extends('front::layouts.master')
@section('title') Checkout @endsection
@section('content')
<!-- Cart -->
<section class="cart-detail">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="cart-block content">
          <div class="cart-header">
            <h2 class="section-title">Cart Detail</h2>
          </div>          
          <div class="detail-block">
            <div class="detail-header">
              <h3>Login</h3>
            </div>
            <div class="detail-info">
              <ul>
                <li>Name :<span>{{{ isset(Auth::user()->full_name) ? Auth::user()->full_name : 'Guest' }}}</span></li>
                <li>Phone :<span>{{{ isset(Auth::user()->phone_no) ? Auth::user()->phone_no : "Not update" }}}</span></li>
                <li>Email :<span>{{{ isset(Auth::user()->email) ? Auth::user()->email : "Not update" }}}</span></li>
              </ul>
            </div>
          </div>
          <div class="detail-block delivery-block mt-4">
            <div class="detail-header">
              <h3>Delivery Address</h3>
              <a href="javascript:void(0);" class="lawwa-btn float-right" id="card-new-address">Add a new address</a>
            </div>
              <form id="address_select" action="{{route('cart.CheckoutStore')}}" method="post">
                @csrf
                <span>Delivery Option </label>
                <select name="shipping_option" class="form-control">
                  <option value="Gdexpress">Gdexpress</option>
                  <option value="Skypostpaid">Skypostpaid</option>
                </select>
                <div id="user_addressess"></div>
            </form>            
          </div>         
           <div class="new-address-add" style="display: none;" >
            <div class="form-title">
              <h3>Add New Address</h3>
            </div>
          <form method="post" id="address_form">
          	 @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="Name">Name</label>
                  <input type="text" name="Name" id="Name" placeholder="Name.." class="form-control">
                </div>
              </div>
              <input type="text"  name="address_id" id="address_id" hidden="" value="null">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="mobile-no">Mobile No</label>
                  <input type="text" name="MobileNumber" id="MobileNumber" placeholder="Mobile Number" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="city">Country</label>
                  <select class="form-control" name="Country" id="country-dropdown">
                    @foreach ($countries as $country) 
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="state">State</label>
                  <select class="form-control" name="State_Province_Region" id="state-dropdown">
                    
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">City</label>
                  <select class="form-control" name="Town_City" id="city-dropdown">
                    
                  </select>
                </div>
              </div> 
              <div class="col-md-6">
                <div class="form-group">
                  <label for="Postcode">Postcode</label>
                  <input type="text" name="Zip_Postcode" id="Zip_Postcode" minlength="5" maxlength="5" placeholder="Postcode" class="form-control">
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea id="Address_line1" name="Address_line1" placeholder="Address" class="form-control"></textarea>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group radio-block">
                  <label>Address Type</label>
                  <label class="form-check" for="home">
                    <input class="form-check-input" id="home" type="radio" name="Type" value="Home">
                    <span class="radio-check">
                      <div class="radio-content">
                        <div class="img-block">
                          <img src="{{ asset('front/assets/images/icons/home-icon.svg') }}" class="defalut-img" alt="Home Icon">
                          <img src="{{ asset('front/assets/images/icons/home-icon-hover.svg') }}" class="active-img" alt="Home Icon">
                        </div>
                        <h6>Default</h6>
                      </div>
                    </span>
                  </label>
                  <label class="form-check" for="work">
                    <input class="form-check-input" id="work" type="radio" name="Type" value="Work">
                    <span class="radio-check">
                      <div class="radio-content">
                        <div class="img-block">
                          <img src="{{ asset('front/assets/images/icons/work-icon.svg') }}" class="defalut-img" alt="Work Icon">
                          <img src="{{ asset('front/assets/images/icons/work-icon-hover.svg') }}" class="active-img" alt="Work Icon">
                        </div>
                        <h6>Work</h6>
                      </div>
                    </span>
                  </label>
                  <label class="form-check" for="other">
                    <input class="form-check-input" id="other" type="radio" name="Type" value="Other">
                    <span class="radio-check">
                      <div class="radio-content">
                        <div class="img-block">
                          <img src="{{ asset('front/assets/images/icons/other-icon.svg') }}" class="defalut-img" alt="other Icon">
                          <img src="{{ asset('front/assets/images/icons/other-icon-hover.svg') }}" class="active-img" alt="other Icon">
                        </div>
                        <h6>Other</h6>
                      </div>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="btn-block">
                  <input type="submit" name="submit" id="saveaddress" value="Add" class="lawwa-btn" />
                  <a href="#0" id="canceladdress" class="lawwa-btn gray-btn">Cancel</a>
                </div>
              </div>
            </div>
          </form>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="Terms" name="Terms">
                <label class="custom-control-label" for="Terms">I Accept the <a href="{{route('pages.terms-condition')}}" target="_blank" class="link">Terms and Conditions</a></label>
              </div>
            </div>
          </div>
          {{--
            <div class="detail-block payment-block">
            <div class="detail-header">
              <h3>Payment Options</h3>
            </div>
            <div class="payment-info">
              <div class="payment_options_block">
                  <ul class="payments_li">
                      <li>
                        <label class="custom_radios">Credit / Debit / ATM Card
                            <input type="radio" name="payment_mode" value="credit_debit_card">
                            <small class="checkmark_rad"></small>
                        </label>
                        <div class="row st_card_details" style="display: none;">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="number">Enter Card Number</label>
                                <input type="text" name="number" id="number" placeholder="Enter Card Number" class="form-control card-img w-50 d-block">
                              </div>
                		<div class="detail-info">
                      <label>
                        <input type="radio" name="radio-btn" id="address">
                        <span class="radio-info"></span>
                      </label>
                      <ul>
                        <li>Name :<span>John White</span></li>
                        <li>Phone :<span>+ 44 45152451</span></li>
                        <li>Address :<span>No 2-1, Tingkat 1, Jalan Oasis 1, Pusat Periagaan Oasis 70200 Seremban, N.Sembilan</span> <a href="#0" class="float-right link">Change?</a></li>
                      </ul>              
                    </div>         
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="expiry-date">Expiry Date</label>
                      <input type="text" name="expiry-date" id="expiry-date" placeholder="Expiry Date" class="form-control card-expiry">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cvv-code">CVV Code</label>
                      <input type="text" name="cvv code" id="cvv-code" placeholder="CVV Code" class="form-control card-cvv">
                    </div>
                  </div>
                </div>
                      </li>
                      <li>
                        <label class="custom_radios">Net Banking
                            <input type="radio" name="payment_mode" value="net_banking">
                            <small class="checkmark_rad"></small>
                        </label>
                      </li>
                  </ul>
              </div>
            </div>
            </div> 
          --}}
        </div>
      </div>
      <div class="col-lg-4">
        <div class="right-siderbar">
          <div class="sidebar">
            <div class="sidebar-header">
              <h6>Order Summary</h6>
            </div>
            <div id="CheckOutCart">
            </div>
            <ul class="sidebar-info">
              <li>
                 <span class="service-name">Subtotal (<span id="producttotalquantity"> </span> item)</span>
                <span class="service-price">RM <span id="sub_total"></span></span>
              </li>
              <li>
                <span class="service-name">Discount</span>
                <span class="float-right link">RM <span id="totaldiscount"></span></span>
              </li>
              <li>
                <span class="service-name">Shipping</span>
                <span class="float-right link">RM <span id="ShippingCharges"></span></span>
              </li>
            </ul>
            <ul class="full-amount">
              <li>
                <span class="amount-title">Order Total</span>
                <span class="totle-price">RM <span id="totalsaleprice"></span> </span>
              </li>
            </ul>
            <div class="btn-block">
              <a href="" id="Checkout"  onclick="return false;" class="lawwa-btn lawwa-pink-btn">Checkout</a>
            </div>
          </div>
          <div class="btn-block mt-4">
            <a href="javascript:history.go(-1)" class="lawwa-btn">Back</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>  
@endsection
@section('js')
	@include('front::externaljs.city-country-statejs');
	@include('front::externaljs.productcartcheckoutjs');
	@include('front::externaljs.addressaddupdatejs');
@endsection