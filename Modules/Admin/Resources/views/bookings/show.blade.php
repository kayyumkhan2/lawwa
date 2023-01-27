@extends('admin::layouts.master')
@section('title') Booking details   @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1>Booking Details</h1>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('bookings.index')}}">Booking</a></li>
          <li class="breadcrumb-item active" aria-current="page">Booking details</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="card">
 <div class="card-header"> 
<div class="d-flex justify-content-between">
    <div>Booking id :  {{ $Booking->id }} </div>
      <div>
       <a class="btn btn-sm btn-warning text-white" href="{{ URL::previous() }}" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> <a class="btn btn-sm btn-info " href="{{ route('bookings.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Bookings</a>
      </div>
   </div>
</div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-6">
        <div class="card bBooking-text-dark mb-5" >
          <div class="card-header"><i class="fa fa-user" aria-hidden="true"></i> Booked By : <b class="badge badge-info" >{{ucfirst(@$Booking->get_user->full_name)}}</b></div>
          <div class="card-body text-primary">
            <h5 class="card-title">
            <table class="table table-responsive-sm table-striped">
              <thead>
                <tr>
                  <th scope="col">Full name</th>
                  <th scope="col">Email </th>
                  <th scope="col">Phone no</th>
                  <th scope="col">Temperature</th>
                  <th scope="col">Temperature image</th>
                </tr>
              </thead>
            <tbody>
              @foreach (@$Booking->BookingUsers as $key => $users )
              <tr>
                <th scope="col"><a class="badge badge-primary" href="{{ route('users.show',$users->id ) }}">{{ucfirst(@$users->full_name)}} </a></th>
                <th scope="col">{{ucfirst(@$users->email)}}</th>
                <th scope="col">{{ucfirst(@$users->phone_no)}}</th>
                <th scope="col">{{ucfirst(@$users->pivot->temperature)}}</th>
                <th scope="col">
                @if($users->pivot->Temperature_image!="")
                  <a href="{{asset('images/temperature/'.@$users->pivot->Temperature_image)}}" target="_blank"><img src="{{asset('images/temperature/'.$users->pivot->Temperature_image)}}"  width="50" ></a>
                @endif  
                </th>
              </tr> 
              @endforeach
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card bBooking-.text-dark mb-5">
          <div class="card-header"> 
          @if(!$Booking->GetAssiagnBeautician=='')  
          <i class="fa fa-user" aria-hidden="true"></i>  Beauticians : <span class="float-right text-danger">Total Commission: {{$Booking->BookingCommission()->sum('commission')}}</span>
          @else <b class="badge badge-danger"> Not Assign </b> @endif</div>
          <div class="card-body text-success">
            <table class="table">
              <table class="table table-responsive-sm table-striped">
                <tr>
                  <th scope="col">Full name</th>
                  <th scope="col">Email </th>
                  <th scope="col">Phone no</th>
                  <th scope="col">Temperature</th>
                  <th scope="col">Commission</th>
                  <th scope="col">Temperature image</th>
                </tr>
              </thead>
            <tbody>
            @foreach($Booking->BookingAssign as $key=> $user)
            <tr>
                <th scope="col"><a class="badge badge-danger" href="{{ route('users.show',$user->id ) }}">{{ucfirst($user->full_name)}} </a></th>
                <th scope="col">{{ucfirst($user->email)}}</th>
                <th scope="col">{{ucfirst($user->phone_no)}}</th>
                <th scope="col">{{ucfirst($user->pivot->temperature)}}</th>
                <th scope="col">{{ucfirst($user->pivot->commission)}}</th>
                  <th scope="col">
                    @if($users->pivot->Temperature_image!="")
                      <a href="{{asset('images/temperature/'.$users->pivot->Temperature_image)}}" target="_blank" ><img src="{{asset('images/temperature/'.$users->pivot->Temperature_image)}}" width="50"></a>
                    @endif
                </th>  
              </tr> 
            @endforeach
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      @if(!$Booking->BookingVideos->isEmpty())
         @foreach($Booking->BookingVideos as $Videos)
          <div class="col-lg-4 col-sm-6">
            <figure>
             <video width="320" height="240" class="w3-border w3-padding" controls>
                <source src="{{asset('videos/'.$Videos->file_name)}}" type="video/mp4">
                <source src="{{asset('videos/'.$Videos->file_name)}}" type="video/ogg">
                <source src="{{asset('videos/'.$Videos->file_name)}}" type="video/webm">
                 Your browser does not support the video tag.
            </video>
            </figure> 
          </div>
        @endforeach
      @endif  
    </div>
    <div class="row">
      <div class="col-lg-12">
        @if($Booking->current_status=='Cancel')
          <div class="card">
            <div class="card-header"><b class="text-danger">Cancel Reason</b> : {{$Booking->BookingCancelReason->reason}}</div> 
            <div class="card-body">
              {{$Booking->BookingCancelReason->comment}}
            </div>
          </div>
        @endif
        <table class="table table-responsive-sm table-striped">
          <thead>
            <tr class="table-primary">
              <th>Status</th>
              <th>Receipt</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td>
              @if($Booking->BookingStatusCurrentStatus!='') 
                  @if($Booking->BookingStatusCurrentStatus->status=="Booked")
                  <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                  @elseif($Booking->BookingStatusCurrentStatus->status=='Assigned')
                   <span class="badge badge-warning"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                  @elseif($Booking->BookingStatusCurrentStatus->status=='OnTheWay')
                   <span class="badge badge-danger"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span> 
                  @elseif($Booking->BookingStatusCurrentStatus->status=='Postponed')
                   <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }}</span>@elseif($Booking->BookingStatusCurrentStatus->status=='Cancel')
                    <span class="badge badge-danger"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                  @elseif($Booking->BookingStatusCurrentStatus->status=='Start')
                   <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                  @elseif($Booking->BookingStatusCurrentStatus->status=='Completed') 
                  <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                  @elseif($Booking->BookingStatusCurrentStatus->status=='Refunded')
                  <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
              @endif
            @endif
            </td>
              <td><a href="{{route('bookings.downloadinvoice',$Booking->id)}}">Download</a></td>
              <td>
                 {{--@php $length = strlen($Booking->location) @endphp
                  @if ($length > 80) 
                  <?php
                    $middle = floor(strlen($Booking->location) / 2)  ; 
                    [$address1, $address2] = preg_split("~.{{$middle}}[^,]*\K, ?~", $Booking->location, 2);
                  ?>
                {{$address1}},
                 <br>
                {{$address2}}
                @else
                {{$Booking->location}}
                @endif --}}
                {{$Booking->location}}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-12">
        <table class="table table-responsive-sm table-striped table-bBookinged ">
          <thead>
            <tr class="table-primary">
              <th>Booking id</th>
              <th>Name</th>
              <th>Service Type</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>   
          @foreach ($Booking->ServiceDetails as $key => $value)
            <tr>
              <td>{{$Booking->id}}</td>
              <td>{{ucfirst($value->name)}}</td>
              <td> <span class="price"> @if($value->pivot->type=="Free")<s class="text-danger">MYR {{$value->amount}} </s><span class="badge badge-danger">  {{$value->pivot->type}}  </span> @else <span class="badge badge-success">  {{$value->pivot->type}}  </span>  @endif </span></td>
              <td>{{$value->amount}}</td>
            </tr>
          @endforeach
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <td>Total Price : <b>{{ $Booking->amount }}</b></td>
            </tr>
          </tbody>          
        </table>
      </div>
    </div>
  </div>
</div>
@endsection 