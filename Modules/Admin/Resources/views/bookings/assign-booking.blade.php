@extends('admin::layouts.master')
@section('title') Booking assign   @endsection
@section('content')
<style>
.card-title
{
  font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
}
</style>
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h3>Booking assign</h3>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('bookings.index')}}">Booking</a></li>
          <li class="breadcrumb-item active" aria-current="page">Booking assign</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="card">
 <div class="card-header"> 
<div class="d-flex justify-content-between">
      <div>Booking id :  {{ $Booking->id }}
        <br>
      <td class="text-dark"> Start Time  : {{$Booking->date}} 
        {{$Booking->start_time}} <b class="text-primary">{{ strtoupper(parseDateTime($Booking->date)->format('l'))}}</b></td>
        <br>
      <td class="text-dark">End Time : {{$Booking->date}} 
         {{$Booking->end_time}} <b class="text-primary">{{ strtoupper(parseDateTime($Booking->date)->format('l'))}}</b></td>
      <td>
      </div>
      <div>
       <a class="btn btn-sm btn-warning text-white" href="{{ URL::previous() }}" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> <a class="btn btn-sm btn-info " href="{{ route('bookings.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Bookings</a>
      </div>
   </div>
</div>
@if ($Booking->current_status!="PaymentFailed" && $Booking->current_status!="Pending" && $Booking->current_status!="Cancel" && $Booking->current_status!="Completed" && $Booking->current_status!="Refunded") 
  <form action="{{ route('bookings.booking.assign.tobeautician',$Booking->id  ) }}" method="post">
      @csrf
      <div class="card-body">
         <div class="row">
          <div class="col-xs-4 col-sm-4 col-md-4">
          <label>Assign to PBTLA</label>
          <select name="employee_id" class="form-control" id="booking-assign">
          <option> Please select PBTLA</option>  
          @foreach ($Beauticians as $beauticianinfo)
            <option value="{{$beauticianinfo->id}}" @if(request()->has('filter') ) 
                @if($beauticianinfo->full_name==$beautician->full_name) 
                selected=""
                @endif 
              @endif>{{$beauticianinfo->full_name}}  
              </option>
          @endforeach
          </select>
        </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
              <label>Selected Address</label>
              <textarea class="form-control" name="location" placeholder="Provide location">{{$Booking->location}}</textarea>
          </div>
          <div class="col-xs-2 col-sm-2 col-md-2" style="margin-top: 32px;">
            <label></label>
           <button type="submit" class="btn btn-sm btn-primary"> Save</button>
        </div>
      </div>
    </div>
  </form>
  @endif
 @if(request()->has('filter') ) 
  <div class="card-body">
    <h4>{{ucfirst($beautician->full_name)}} time schedule</h4>
   <div class="col-sm-12 mb-4 mt-3" >
      <div class="table-responsive">
        <table class="table calender table-bordered">
            <tr>
              @foreach (getDaysOfWeek() as $day)
                  <th class="table__day">{{ $day }}</th>
              @endforeach
            </tr>
            <tr>
              @foreach (getDaysOfWeek(true) as $day)
                <td class="table__day table__right-dotted">
                    @if ($bTime = $bTimes->where('day', $day)->first())
                      <div class="item">
                          <section class="item__block item__block--no-margin">
                              <div class="item__message">{{ toTime($bTime->start_time, false) }} - {{ toTime($bTime->end_time, false) }}</div>
                              <a title="Edit this business time" href="{{route('beautician.workingtime.edit',$bTime->id)}}" class="item__edit"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                          </section>
                      </div>
                    @else
                        <div class="table__message">N/A</div>
                    @endif
                </td>
              @endforeach
            </tr>
        </table>
      </div>
    </div>
  @if(!$Bookings->isEmpty())
   <div class="col-sm-12 mb-4 mt-3" >
      <div class="box bg-white">
        <h4>{{ucfirst($beautician->full_name)}} Bookings</h4>
          <div class="box-row">
              <div class="box-content">
                <table id="dataTable" class="table table-striped table-bBookinged table-hover ">
                    <thead>
                      <tr>
                        <th scope="col" class="sr-no">S.No</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Price</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col" class="action">Status</th>
                           <!-- <th scope="col">Details</th>-->
                        <th scope="col" class="action">Actions</th>
                     </thead>
                     <tbody>
                        @php $i=1 @endphp
                        @foreach ($Bookings  as $Booking)
                        <tr>
                           <td scope="row" class="sr-no">
                              {{ $i++ }}
                           </td>
                           <td>
                            @if($Booking->get_user!="")
                              <a class="badge badge-info" href="{{ route('users.show',$Booking->get_user->id ) }}">
                                {{ucfirst($Booking->get_user->full_name)}}
                              </a>
                            @endif
                          </td>
                           <td>{{ $Booking->amount  }}   </td>
                           <td class="text-dark">{{$Booking->date}} 
                               {{$Booking->start_time}} <b class="text-primary">{{ strtoupper(parseDateTime($Booking->date)->format('l'))}}</b></td>
                           <td class="text-dark">{{$Booking->date}} 
                               {{$Booking->end_time}} <b class="text-primary">{{ strtoupper(parseDateTime($Booking->date)->format('l'))}}</b></td>
                           <td>
                            @if($Booking->BookingStatusCurrentStatus!='') 
                              @if($Booking->BookingStatusCurrentStatus->status=="Scanned")
                              <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span> 
                              @elseif($Booking->BookingStatusCurrentStatus->status=="Temperature uploaded")
                              <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=="Booked")
                              <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=='Assigned')
                               <span class="badge badge-info"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                               @elseif($Booking->BookingStatusCurrentStatus->status=='Reached')
                               <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                               @elseif($Booking->BookingStatusCurrentStatus->status=='Accepted')
                               <span class="badge badge-warning"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=='OnTheWay')
                               <span class="badge badge-danger"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span> 
                              @elseif($Booking->BookingStatusCurrentStatus->status=='PaymentFailed')
                              <span class="badge badge-danger"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span> 
                              @elseif($Booking->BookingStatusCurrentStatus->status=='Postponed')
                               <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }}</span>
                               @elseif($Booking->BookingStatusCurrentStatus->status=='Cancel')
                                <span class="badge badge-info"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=='Start')
                               <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=='Completed') 
                              <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=='Refunded')
                              <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=='Pending')
                              <span class="badge badge-warning"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                            @endif
                            @endif
                           </td>
                           <td class="action float-left">
                              <a class="icon-btn preview" href="{{ route('bookings.show',$Booking->id) }}">
                              <i class="fal fa-eye" id="show-btn"></i></a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
    @endif
  </div>
  @endif
  <div class="card-body">
    <div class="row">
      <div class="col-sm-6">
        <div class="card bBooking-text-dark mb-5">
          <div class="card-header"><i class="fa fa-user" aria-hidden="true"></i> Customer : <a class="badge badge-warning" href="{{ route('users.show',$Booking->get_user->id ) }}">{{ucfirst($Booking->get_user->full_name)}}</a></div>
          <div class="card-body text-success">
            <h5 class="card-title">{{ucfirst($Booking->get_user->phone_no)}}</h5>
            <h5 class="card-title">{{ucfirst($Booking->get_user->email)}}</h5>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card bBooking-.text-dark mb-5">
          <div class="card-header"> 
          @if(!$Booking->GetAssiagnBeautician=='')  
          <i class="fa fa-user" aria-hidden="true"></i>  PBTLA : <a class="badge badge-success" href="{{ route('users.show',$Booking->get_user->id ) }}"> {{ucfirst($Booking->GetAssiagnBeautician->full_name)}}</a>
          @else <b class="badge badge-danger"> Not Assign </b> @endif</div>
          <div class="card-body text-success">
            <h5 class="card-title">@if(!$Booking->GetAssiagnBeautician==''){{ucfirst($Booking->GetAssiagnBeautician->phone_no)}}  @endif</h5>
            <h5 class="card-title">@if(!$Booking->GetAssiagnBeautician==''){{ucfirst($Booking->GetAssiagnBeautician->email)}}  @endif</h5>
          </div>
        </div>
      </div>
    </div>     
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
   $('#booking-assign').change(function(){
     var filtertype = $(this).val();
     if (!filtertype=="") {
       var url = "{{route('bookings.booking.assign',request()->id)}}"+"/"+'?filter='+filtertype;
       window.location = url ;
     }
  });
</script>
@endsection 