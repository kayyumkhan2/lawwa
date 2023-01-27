@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')

<!-- Lawwa My Account -->
<section class="my-account">
  <div class="container">
    <div class="row">
     @include('beautician::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
           <div class="my-account-header">
            <h6>Body Temperature</h6>
            <!-- <a href="#0" class="link float-right">Cancel Booking</a> -->
            @if ($Booking->current_status!="PaymentFailed" && $Booking->current_status!="Pending" && $Booking->current_status!="Cancel" && $Booking->current_status!="Completed" && $Booking->current_status!="Refunded")
               <a href="javascript:void(0)" class="link float-right" data-toggle="modal" data-orderid="{{$booking_id}}" data-target="#exampleModalCenter"> Cancel Booking
              </a>
            @endif
            <form action="{{route('beautician.bookings.temperature.store')}}" method="post" enctype="multipart/form-data">
             @csrf
              @foreach($Booking->BookingUsers as $key=> $user)
                <div class="body-temp show-block" style="">
                  <div class="form-group row">
                  <div class="col-md-6">
                    <label for="{{$key}}">Customer </label>
                    <input type="text" placeholder="{{ucfirst($user->full_name)}}" readonly=""  value="{{ucfirst($user->full_name)}}" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label for="{{$key}}">Temperature</label>
                    <input type="file" name="Temperature_image[]" class="form-control" required="">
                    <input type="text" placeholder="user_id" value="{{$user->pivot->id}}"  class="form-control" name="customer[]" hidden="">
                    <input type="number" placeholder="Enter temperature..." pattern= "[0-9]"  value="{{$user->pivot->temperature}}" required="" class="form-control" name="temperature[]">
                  </div>  
                  </div>
              @endforeach
                <div class="btn-block">
                  <button type="submit" class="lawwa-btn">Submit</button>
                </div>
              </div>
            </form>
            <form action="{{route('beautician.bookings.temperature.store.beauticians')}}" name="form" method="post" enctype="multipart/form-data">
             @csrf
              @foreach($Booking->BookingAssign as $key=> $user)
                <div class="body-temp show-block" style="">
                  <div class="form-group row">
                  <div class="col-md-6">
                    <label for="{{$key}}">Beautician </label>
                    <input type="text" placeholder="{{ucfirst($user->full_name)}}" readonly=""  value="{{ucfirst($user->full_name)}}" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label for="{{$key}}">Temperature</label>
                    <input type="text" placeholder="user_id" value="{{$user->pivot->id}}"  class="form-control" name="beautician[]" hidden="">
                    <input type="file" name="Temperature_image[]" class="form-control" required="">
                    <input type="number" placeholder="Enter temperature..." pattern= "[0-9]"  value="{{$user->pivot->temperature}}" required="" class="form-control" name="temperature[]">
                  </div>  
                  </div>
              @endforeach
                <div class="btn-block">
                  <button type="submit" class="lawwa-btn">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Reason cancel to Booking </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form method="post" action="{{route('beautician.bookings.cancel')}}" id="gallery_upload_image_form" enctype="multipart/form-data"  >
          <div class="modal-body">
           <span id="gallery_form_output"></span>
              @csrf  
              @method('PUT')
              <div class="row">
                <input type="text" name="booking_id" hidden="" required="" value="">
                <input type="text" name="status" hidden="" required="" value="Cancel">
                <div class="col-md-12">
                   <select class="form-control" required="" name="reason" >
                   <option value="">Please select cancel reason</option>
                   <option value="Bad Location.">Bad Location.</option> 
                   <option value="Some personal issue comes up with the customer.">Some personal issue comes up with the customer.</option> 
                   <option value="The customer is unreachable or is not read.">The customer is unreachable or is not read.</option> 
                   <option value="Bad review from friends/relatives after servicing the customer.">Bad review from friends/relatives after servicing the customer.</option> 
                   <option value="Distance factor and rush hour.">Distance factor and rush hour.</option> 
                   <option value="If you are not going to be available in town due to some urgent travel.">If you are not going to be available in town due to some urgent travel.</option>
                   <option value="Other.">Other.</option> 
                  </select>
                </div>
                <div class="col-md-12 mt-2">
                  <textarea name="comment" class="form-control" placeholder="Comment.."></textarea>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn lawwa-pink-btn text-white"  data-dismiss="modal">Close</button>
            <button type="submit" class="btn lawwa-pink-btn text-white" onclick="return confirm('Are you sure you want to cancel this order?');" value="Change">Save</button> 
          </div>
          </form>
        </div>
</div>
</section>
@endsection
@section('js')
<script>
  $("form").submit(function (e) {
    let value = $('.booking_id').val();
    if (value=="") 
      {
        e.preventDefault();
      }
  });
</script>
<script>
  $(document).ready(function(){ 
    $('.link').click(function(){
        var orderid = $(this).data("orderid");
        $('input[name="booking_id"]').val(orderid);
     });
  });
</script>
@endsection