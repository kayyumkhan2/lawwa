@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
<!-- Lawwa My Account -->
<!-- Lawwa My Account -->
<section class="upcoming-service-detail">
  <div class="container">
    <div class="row">
      @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="order-info">
            <div class="upcoming-order">
              <h5>{{$pagename}}</h5>
              <div class="row">
                <div class="col-md-12">
                  <div class="user-detail">
                    <!-- <div class="img-block">
                      <img src="{{ asset('front/assets/images/user-icon.png')}}" alt="User">
                    </div> -->
                    <!-- <h6>
                        
                       CUSTOME
                        
                    </h6> -->
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Full Name</th>
                          <th scope="col">Phone No</th>
                          <th scope="col">Email </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($Booking->BookingUsers as $user)
                        <tr class="table-white">
                          <td>{{ucfirst($user->full_name)}}</td>
                          <td>{{ucfirst($user->phone_no)}}</td>
                          <td>{{ucfirst($user->email)}}</td>
                        </tr>
                      @endforeach    
                      </tbody>
                    </table>
                  </div>
                  <span class="add-edit-type">Address</span>              
                  <!-- <span class="add-edit-type">{{ucfirst($Booking->booking_at)}}</span> -->
                  <p>{{$Booking->location}}</p>
                  <div class="phone-number">
                    <span class="label">Booking Type</span>
                    <span>{{ucfirst($Booking->type)}}</span>
                  </div>
                  <!-- <div class="phone-number">
                    <span class="label">Required Services Name</span>
                    <span>Ala Carte Confinement Care</span>
                  </div> -->
                </div>

                <div class="col-md-12">
                  <div class="right-booking-info">
                  <label class="link">{{$Booking->current_status}}</label>	
                  <span>{{$Booking->date}} <b>{{ strtoupper(parseDateTime($Booking->date)->format('l'))}}</b></span>
                  <span>Start {{ date ('H:i',strtotime($Booking->start_time))}} End {{ date ('H:i',strtotime($Booking->end_time))}} </span>
                  @if($Booking->current_status=='Completed')
                  	<a href="{{route('customer.ratings.create',['id'=>$Booking->id])}}"><i class="fa fa-star" aria-hidden="true"></i> Rate &amp; Review</a>
                  @endif
                  </div>
                @if($Booking->current_status=='Cancel' && $Booking->BookingCancelReason!="" )
                  <div class="card">
                      <div class="card-header"><b class="text-danger">Cancel Reason</b> : {{$Booking->BookingCancelReason->reason}}</div> 
                      <div class="card-body">
                        {{$Booking->BookingCancelReason->comment}}
                      </div>
                    </div>
                  @endif
                  </div>
             
            <div class="col-md-12">
            <div class="schedule-service">
              <h3>Schedule Service</h3>
              <div class="row">
                @foreach($Booking->ServiceDetails as $services)
                <div class="col-xl-6 col-md-6 col-sm-6">
                  <span  class="service-item">
                    <div class="img-block">
                      <div class="table-wrap">
                        <div class="align-wrap">
                          <img src="{{ asset('public/images/serviceimages/'.$services->service_image) }}" alt="service">
                        </div>
                      </div>
                    </div>
                    <div class="service-info">
                      <h6>{{$services->name}}</h6>
                      <span><img src="{{ asset('front/assets/images/icons/watch-icon.svg')}}" alt="Icon" class="mr-2" width="18">@if($services->houre>0){{$services->houre}} H : @endif  {{$services->minute+5}} Min.</span>
                     <span class="price"> @if($services->pivot->type=="Free")<span class="text-danger">RM {{$services->amount}} </span><span class="badge badge-danger">  {{$services->pivot->type}}  </span> @else RM {{$services->amount}} <span class="badge badge-success">  {{$services->pivot->type}}  </span>  @endif 
                    </div>
                  </span>
                </div>
                @endforeach
              </div>
              <div class="notes">
                <h3>Customer Notes</h3>
                <p>{{$Booking->note}}</p>
              </div>
           <!--    <div class="sarvice-cost">
                <h3>Service Cost </h3>
                <p>Cash on arrival</p>
              </div> -->
              <div class="btn-block">
                <!-- <a href="#0" class="lawwa-btn lawwa-pink-btn"><img src="{{ asset('front/assets/images/icons/chat-icon.svg')}}" class="mr-2" alt="chat-icon">Chat</a> -->
                @if(!$Booking->BookingAssign->isEmpty())
                  @foreach($Booking->BookingAssign as $beautician)                
                    <a href="{{route('customer.assignedbeauticianprofile.index',$beautician->id)}}" class="lawwa-btn lawwa-pink-btn">
                      {{$beautician->full_name}}
                    </a>
                  @endforeach
                @endif  
                @if ($Booking->current_status!="PaymentFailed" && $Booking->current_status!="Pending" && $Booking->current_status!="Cancel" && $Booking->current_status!="Completed" && $Booking->current_status!="Refunded")
                  <a href="#"  class="lawwa-btn" data-toggle="modal" data-target="#exampleModalCenter">Scan Qr code</a>
                @endif
              </div>
            </div>
          </div>
           </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>   
@section('jslinkbottom')
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
@endsection

@section('js')
<script type="text/javascript">
          var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
          scanner.addListener('scan',function(assign_beautician_id){
            var booking_id="{{$Booking->id}}";
            var url= '{{url("myaccount/booking/start")}}' + '/' +assign_beautician_id +'/' + booking_id;
            //alert(content);
            window.location.href=url;
          });
          Instascan.Camera.getCameras().then(function (cameras){
            if(cameras.length>0){
              scanner.start(cameras[0]);
              $('[name="options"]').on('change',function(){
                if($(this).val()==1){
                  if(cameras[0]!=""){
                    scanner.start(cameras[0]);
                  }else{
                    alert('No Front camera found!');
                  }
                }else if($(this).val()==2){
                  if(cameras[1]!=""){
                    scanner.start(cameras[1]);
                  }else{
                    alert('No Back camera found!');
                  }
                }
              });
            }else{
              console.error('No cameras found.');
              alert('No cameras found.');
            }
          }).catch(function(e){
            console.error(e);
            alert(e);
          });
        </script>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Scan qr code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <video id="preview" class="p-1 border" style="width:100%;"></video>
            <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
              
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="lawwa-btn" data-dismiss="modal">Close</button> -->
        <label class="lawwa-btn">
              <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
        </label>
        <label class="lawwa-btn active">
              <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
        </label>
      </div>
    </div>
  </div>
</div>
@endsection
