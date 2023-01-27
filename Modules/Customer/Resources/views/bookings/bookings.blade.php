@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
<!-- Lawwa My Account -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please select the booking time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="{{route('customer.bookings.postpone')}}"  enctype="multipart/form-data">
      @csrf  
      @method('PUT')
      <div class="modal-body">
        <div class="row">
        <div class="col-md-12">
          <span>Booking id </span>
          <input type="text" name="booking_id" id="bookingid" readonly=""  class="form-control mt-1" required="" value="">
      </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6">
          <span>Date </span>
          <div class="form-group">
              <input type="date" name="date"  min="<?= date('Y-m-d'); ?>" class="form-control mt-1" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
          <span>Time </span>
          <input type="time" name="time"  class="form-control mt-1" required="">
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn lawwa-pink-btn text-white"  data-dismiss="modal">Close</button>
      <button type="submit" class="btn lawwa-pink-btn text-white"  onclick="return confirm('Are you sure you want to Postpone this Booking?');" value="Save">Save</button> 
    </div>
    </form>
    </div>
  </div>
</div>
<section class="my-order">
  <div class="container">
    <div class="row">
      @include('customer::includes.sidebar')
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
                              <h6><strong>Booking Id :</strong> <span>{{$Booking->id}}</span></h6>
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
                              <a href="{{route('customer.Booking.Details',$Booking->id)}}" class="lawwa-btn">View</a>
                              <br>    
                              <b class="text-success">{{$Booking->current_status}}</b>
                              <br>
                              @if ($Booking->current_status!="PaymentFailed" && $Booking->current_status!="Pending" && $Booking->current_status!="Cancel" && $Booking->current_status!="Completed" && $Booking->current_status!="Refunded")
                                <a href="javascript:void(0)" class="link" data-toggle="modal" data-booking_id="{{$Booking->id}}" data-target="#exampleModalCenter">Cancel</a>
                              @endif
                              <br>
                              @if ($Booking->current_status!="PaymentFailed" && $Booking->current_status!="Pending" && $Booking->current_status!="Cancel" && $Booking->current_status!="Completed" && $Booking->current_status!="Refunded") 
                              <a type="button" class="btn btn-primary Postpone" data-bookingid="{{$Booking->id}}" data-toggle="modal" data-target="#exampleModal">
                                Postpone
                               @endif
                              </a>
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
           <div class="mt-1 float-right"> 
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
            <h5 class="modal-title" id="exampleModalLongTitle">Reason cancel to order </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form method="post" action="{{route('customer.bookings.cancel')}}"  enctype="multipart/form-data"  >
          <div class="modal-body">
           <span id="gallery_form_output"></span>
              @csrf  
              @method('PUT')
              <div class="row">
                <input type="text" name="booking_id" hidden="" required="" value="" id="booking_id">
                <input type="text" name="status" hidden="" required="" value="Cancel">
                <div class="col-md-12">
                   <select class="form-control" required="" name="reason" >
                   <option value="">Please select cancel reason</option>
                   <option value="Mind Change.">Mind Change.</option> 
                   <option value="Some personal issue comes up with the PBTLA.">Some personal issue comes up with the PBTLA.</option> 
                   <option value="The PBTLA is unreachable or is not read.">The PBTLA is unreachable</option> 
                   <option value="Bad review from friends/relatives after servicing the customer.">Bad review from friends/relatives after servicing the customer.</option> 
                   <option value="If you are not going to be available in town due to some urgent issues.">If you are not going to be available in town due to some urgent issues.</option>
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
            <button type="submit" class="btn lawwa-pink-btn text-white" onclick="return confirm('Are you sure you want to cancel this Booking?');" value="Change">Save</button> 
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
     var url = "{{route('customer.Booking')}}"+"/"+'?filter='+filtertype;
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
<script>
  $(document).ready(function(){ 
    $('.Postpone').click(function(){
        var bookingid = $(this).data("bookingid");
        $("#bookingid").val(bookingid);
     });
  });
</script>
@endsection