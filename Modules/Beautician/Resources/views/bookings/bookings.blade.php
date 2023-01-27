@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
<!-- Lawwa My Account -->
<section class="my-order">
  <div class="container">
    <div class="row">
      @include('beautician::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="right-header">
            <div class="row align-items-center">
              <div class="col-sm-7">
                <h6>{{$pagename}}</h6>
              </div>
              <div class="col-sm-5">
                <div class="form-group m-0">
                  <select class="form-control" id="order-filter">
                    <option value="All"  {{request()->get('filter')  == 'All' ? 'selected' : ''}} >All</option>
                    <option value="UPCOMING" {{request()->get('filter')  == 'UPCOMING' ? 'selected' : ''}}>UPCOMING BOOKING</option>
                    <option value="Completed" {{request()->get('filter')  == 'Completed' ? 'selected' : ''}}>{{strtoupper("Completed")}} BOOKING</option>
                    <option value="Assigned" {{request()->get('filter')  == 'Assigned' ? 'selected' : ''}}>{{strtoupper("Assigned")}} BOOKING</option>
                    <option value="Postponed" {{request()->get('filter')  == 'Postponed' ? 'selected' : ''}}>{{strtoupper("Postponed")}} BOOKING</option>
                    <option value="Refunded" {{request()->get('filter')  == 'Refunded' ? 'selected' : ''}}>{{strtoupper("Refunded")}} BOOKING</option>
                    <option value="OnTheWay" {{request()->get('filter')  == 'OnTheWay' ? 'selected' : ''}}>ON THE WAY BOOKING</option>
                    <option value="Cancel" {{request()->get('filter')  == 'Cancel' ? 'selected' : ''}}>CANCEL BOOKING</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="order-info">
            @foreach($Bookings as $Booking)
            <div class="singal-order">
              <div class="table-responsive">
                <table class="table m-0">
                  <tr>
                    <td>
                      <table class="table m-0">
                        <tr>
                          <td>
                            <div class="order-detail">
                              <h6><strong>Booking Id :</strong> <span>{{$Booking->pivot->booking_id}}</span></h6>
                              <h6><strong>Services :</strong> <span>@foreach($Booking->ServiceDetails as $value) {{$value->name}}  @endforeach</span></h6>
                              <h6><strong>Price :</strong> <span>RM {{$Booking->amount}}</span></h6>
                              <h6><strong>Address :</strong> <span>{{$Booking->location}}</span></h6>
                            </div>
                          </td>
                          <td align="center">
                            <div class="img-block">
                              <div class="lawwa-table-wrap">
                                <div class="lawwa-align-wrap">
                                  @foreach($Booking->ServiceDetails as $value)
                                  <img src="{{ asset('public/images/serviceimages/'.$value->service_image) }}">
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="btn-block">
                              <a href="{{route('beautician.Booking.Details',$Booking->id)}}" class="lawwa-btn">View</a>
                              <br>
                              <b class="text-success">{{$Booking->current_status}}</b>
                              <br>
                              @if ($Booking->current_status!="PaymentFailed" && $Booking->current_status!="Pending" && $Booking->current_status!="Cancel" &&  $Booking->current_status!="Completed" && $Booking->current_status!="Refunded")
                                <a href="javascript:void(0)" class="link" data-toggle="modal" data-booking_id="{{$Booking->id}}" data-target="#exampleModalCenter">Cancel</a>
                              @endif
                            </div>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
           @endforeach
           <div class="mt-1 float-right" style="color: #2B3990;"> 
                {{ $Bookings->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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
                  <input type="text" name="booking_id" hidden="" required="" value="" id="booking_id" class="booking_id">
                  <input type="text" name="status" hidden="" required="" value="Cancel">
                  <div class="col-md-12">
                     <select class="form-control" required="" name="reason" >
                     <option value="">Please select cancel reason</option>
                     <option value="Bad Location.">Bad Location.</option> 
                     <option value="Some personal issue comes up with the customer.">Some personal issue comes up with the customer.</option> 
                     <option value="The customer is unreachable or is not read.">The customer is unreachable or is not read.</option> 
                     <option value="Bad review from friends/relatives after servicing the customer.">Bad review from friends/relatives after servicing the customer.</option> 
                     <option value="Distance factor and rush hour.">Distance factor and rush hour.</option> 
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
</div>
@endsection
@section('js')
<script type="text/javascript">
   $('#order-filter').change(function(){
     var filtertype = $(this).val();
     var url = "{{route('beautician.Booking')}}"+"/"+'?filter='+filtertype;
     window.location = url ;
  });
</script>
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
        var booking_id = $(this).data("booking_id");
        $("#booking_id").val(booking_id);
     });
  });
</script>
@endsection