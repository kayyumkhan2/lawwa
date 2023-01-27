@extends('front::layouts.master')
@section('title') Book-Services @endsection
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
          <li class="breadcrumb-item"><a href="javascript:history.go(-2)">Services</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item"><a href="javascript:history.go(-1)">Category Services</a></li>
           <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item active" aria-current="page" style="text-transform: lowercase;">Book Services</li>
        </ol>
      </nav>
    </div>
  </section>

<!-- Lawwa Book Beautician Service -->
<section class="book-service">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="right-content content">
         
           <div class="row">
            <span class="booking-type-error error" style="display: none;">Select booking type</span>
          </div>
          <div class="book-service-form individual-booking">
            <div class="form-title">
              <h3 style="text-transform: capitalize;">Please Fill the booking details</h3>
            </div>
            <form class="request" name='validation' id="singlebookingvalidation" method="POST" action="{{route('booking.store')}}">
              {{ csrf_field() }}
              <input type="text"  name="type" value="{{ old('type','Individual') }}" class="form-control booking-type" required="" placeholder="Plase select Booking type above.." readonly="" >
              <div class="row ml-1  mt-3"><h5 class="link" >You cannot book services before 7 days </h5></div>
              <div class="row mt-3">
              <div class="col-md-6 "> 
                <div class="form-group">
                    <input type="date" name="date" value="{{ old('date') }}"  min="<?= date('Y-m-d',strtotime('+7 days')); ?>" class="form-control" required="">
                </div>
              </div>
                <div class="col-md-6">
                  <div class="form-group">
                  <input type="text" name="time" id="timepicker" class="form-control"  value="{{ old('time') }}" required="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="tel" class="form-control" name="customer[]" required="" readonly="" value="{{{ isset(Auth::user()->phone_no) ? Auth::user()->phone_no : 'Guest' }}}"  id="phone_no" placeholder="Mobile No">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <input type="text" class="form-control"  placeholder="Name" required="" readonly=""  value="{{{ isset(Auth::user()->full_name) ? Auth::user()->full_name : 'Guest' }}}" name="name">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input  class="form-control location" hidden="" name="location" value="{{ old('location') }}" id="location"  placeholder="Provide location"></input>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea class="form-control" name="note" placeholder="Notes" minlength="10" maxlength="200">{{ old('note') }}</textarea>
                  </div>
                </div>
              </form>
              <div class="detail-block delivery-block mt-4 col-md-12">
              <div class="detail-header d-inline-block w-100">
                <h3>Service Location</h3>
                <a href="javascript:void(0);" class="lawwa-btn float-right" id="card-new-address">Add a new address</a>
              </div>
              <form id="address_select" action="{{route('booking.create')}}" method="post">
                @csrf
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
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="right-siderbar">
          <div class="sidebar">
            <div class="sidebar-header">
              <h6>Price Details</h6>
            </div>
            <ul class="sidebar-info">
            @php $amount=0; @endphp
              @if(GetServiceCart()->count()>0)
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
                <span class="service-price">RM {{round($AmountService)}}</span>
              </li>
              @endforeach
            @else
              <div class="sidebar">
                <div class="btn-block">
                  <a href="javascript:void(0);" class="lawwa-btn lawwa-pink-btn">Service cart is empty</a>
                </div>
              </div>
            @endif
            </ul>
            <ul class="full-amount">
              <li>
                <span class="amount-title">Total Amount</span>
                <span class="totle-price">RM <span class="price">{{$amount}}</span></span>
              </li>
            </ul>
            <div class="btn-block">
              <a href="javascript:void(0);" class="lawwa-btn lawwa-pink-btn" id="Confirm_Booking">Confirm Booking</a>
            </div>
          </div>
          <div class="btn-block mt-3">
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
  @include('front::externaljs.addressaddupdatejs');
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.selected_address',function(){
    var location_id=$(this).val();
    $('input[name=location]').val(location_id);
  })    
</script>
<script type="text/javascript">
  var d = new Date($.now());
  var time= d.getHours();
  $('#timepicker').timepicker({
      timeFormat: 'h:mm p',
      interval: 60,
      minTime: '8',
      maxTime: '10:00pm',
      defaultTime: '8',
      startTime: '08:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true,

  });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 @if($errors->any())
     <script type="text/javascript">
      Swal.fire("", " {!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}", "info");
    </script>
@endif
<script type="text/javascript">
  $('#Confirm_Booking').on('click',function(){
    var cutomers = $(".name").length;
    var error="false" ;
    $('.mobile').each(function() {
         if($(this).val()==""){
            $(this).addClass("is-invalid");
            error ="true";
        }
    });
    $('.name').each(function() {
         if($(this).val()==""){
            $(this).addClass("is-invalid");
            error ="true";
        }
    });
    if (error=="true") {
        Swal.fire({
          text: "Please fill the valid customers details",
          icon: "info",
          button: "Ok",
        });
      // preventDefault();
    }
    var bookingtype= $(".booking-type").val();
    if (bookingtype=="") 
      {
        $(".booking-type-error").css("display", "block");
        preventDefault();
      }
      else
        {
          $(".booking-type-error").css("display", "none");
       }
    if(bookingtype=="Individual"){
      if (cutomers>4) {
          Swal.fire({
            text: "You can not add more then 5 customers for Individual booking",
            icon: "warning",
            button: "Ok",
          });
        return false;
      }
    }
    if(bookingtype=="Group"){
      if (cutomers<4) {
          Swal.fire({
            text: "You can not add less then 5 customers for Group booking",
            icon: "warning",
            button: "Ok",
          });
        return false;
      }
      $('#singlebookingvalidation').submit();
    }
 });
$(function() {
  ignore: [],
      $("#singlebookingvalidation").validate({
      rules: {
         'location': {
          required: true,
         },
         'name': {
          required: true,
         },
         "customer[0]": {
          required: true,
         },
         'type': {
          required: true,
         },
        },
      });
});
</script>
<script type="text/javascript">
  $('#Confirm_Booking').on('click',function(){
    var location = $('.location').val();
        if(!location){
          alert("Please select to address before checkout!");
        }
        else{
          $('#singlebookingvalidation').submit();
      }
  });
</script>
<script type="text/javascript">
  $("#Confirm_Booking").click(function(event) {  
    if(!$("input:checkbox[name='Terms']").is(":checked"))
      {
        event.preventDefault();
        $('#singlebookingvalidation').attr('onsubmit','return false;');
        alert("Please accept the terms and conditions");
      }
      else{
        $('#singlebookingvalidation').attr('onsubmit','return true;');
      }
    });
</script>
@endsection