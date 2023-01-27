@extends('admin::layouts.master')
@section('title') Bookings   @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">Bookings</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Bookings</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="col-sm-12 mb-4">
   <form  action="{{ route('bookings.bookingdatefilter') }}"  method="get" class="box bg-white">
      <!-- <div class="box-title pb-0">
         <h5>Filter</h5>
         </div> -->
      <div class="d-flex flex-wrap align-items-end py-4">
         <div class="col-md-3">
            <div class="form-group mb-0">
               <label>From </label>
               <div class="input-group">
                  <input type="date" name="from" id="from"  max="{{date('Y-m-d')}}" value="{{request('from', date('Y-m-d'))}}" required="" class="form-control" placeholder="">
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group mb-0">
               <label>To</label>
               <div class="input-group">
                  <input type="date" name="to" id="to" required=""  max="{{date('Y-m-d')}}"  value="{{request('to', date('Y-m-d'))}}" class="form-control" placeholder="">
               </div>
            </div>
         </div>
         <div class="col-md-1 text-right">
            <div class="form-group mb-0">
               <button type="submit" class="btn btn-info w-100" id="submit"><i class="fas fa-search"></i></button>
            </div>
         </div>
         <a class="btn btn-success" href="{{ route('bookings.index') }}"> <i class="fas fa-sync"></i></a>
         <div class="col-md-2">
            <div class="form-group mb-0">
               <label>Customers</label>
               <div class="input-group" id="selectTriggerFilter">     
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <div class="form-group mb-0">
               <label>Status</label>
               <div class="input-group" id="selectTriggerFilter1">
               </div>
            </div>
         </div>
      </div>
   </form>
</div>
<div class="col-sm-12">
   <div class="row">
   {{--
   <div class="col-md-12">
      <a class="btn btn-sm btn-info  ml-1" href="{{ route('Bookings.export','CSV') }}" >CSV</a>
      <a class="btn btn-sm btn-info  ml-1" href="{{ route('Bookings.export','XLSX') }}" >XLSX</a>
      <a class="btn btn-sm btn-info  ml-1" href="{{ route('Bookings.export','XLS') }}" >XLS</a>
   </div>
    --}}
      <div class="col-sm-12 mb-4 mt-3" >
         <div class="box bg-white">
            <div class="box-row">
               <div class="box-content">
                  <table id="dataTable" class="table table-striped table-bBookinged table-hover ">
                     <thead>
                        <tr>
                           <th scope="col" class="sr-no">S.No</th>
                           <th scope="col" class="sr-no tdwidth">Booking ID</th>
                           <th scope="col">Customer</th>
                           <th scope="col">Txn id</th>
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
                           <td>{{ $Booking->id }}</td>
                           <td>
                            @if($Booking->get_user!="")
                            <a class="badge badge-info" href="{{ route('users.show',$Booking->get_user->id ) }}">{{ucfirst($Booking->get_user->full_name)}}</a>
                            @endif
                          </td>
                           <td>{{ $Booking->txn_id  }}  </td>
                           <td>{{ $Booking->amount  }}   </td>
                           <td class="text-dark">{{$Booking->date}} 
                               {{ date('G:i', strtotime($Booking->start_time))}} <b class="text-primary">{{ strtoupper(parseDateTime($Booking->date)->format('l'))}}</b></td>
                           <td class="text-dark">{{$Booking->date}} 
                               {{ date('G:i', strtotime($Booking->end_time))}} <b class="text-primary">{{ strtoupper(parseDateTime($Booking->date)->format('l'))}}</b></td>
                           <td>
                            @if($Booking->BookingStatusCurrentStatus!='') 
                              @if($Booking->BookingStatusCurrentStatus->status=="Scanned")
                              <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span> 
                              @elseif($Booking->BookingStatusCurrentStatus->status=="Temperature uploaded")
                              <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=="Booked")
                              <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=='Assigned')
                               <span class="badge badge-info"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>@elseif($Booking->BookingStatusCurrentStatus->status=='Reached')
                               <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>@elseif($Booking->BookingStatusCurrentStatus->status=='Accepted')
                               <span class="badge badge-warning"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                              @elseif($Booking->BookingStatusCurrentStatus->status=='OnTheWay')
                               <span class="badge badge-danger"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span> 
                              @elseif($Booking->BookingStatusCurrentStatus->status=='PaymentFailed')
                              <span class="badge badge-danger"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span> 
                              @elseif($Booking->BookingStatusCurrentStatus->status=='Postponed')
                               <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }}</span>@elseif($Booking->BookingStatusCurrentStatus->status=='Cancel')
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
                              <a class="icon-btn edit" href="{{ route('bookings.booking.assign',$Booking->id) }}">
                              <i class="fal fa-edit" id="show-btn"></i></a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@jquery
@toastr_js
@toastr_render
@endsection
@section('js')
<script type="text/javascript">
   $(document).on('change','#from,#to',function(){
         var from = $("#from").val();
         var to = $("#to").val();
         if(Date.parse(from) > Date.parse(to)){
            swal("error", "Invalid Date Range!", "error");
            $('input[name=from').val('');
            $('input[name=to').val('');
            $("#submit").prop('disabled', true);
         }
         else{
            $("#submit").prop('disabled', false);
         }
    });
</script>
<script>
   $(document).ready(function() {
     $('#dataTable').DataTable({
             responsive: true,
        initComplete: function() {
         var column = this.api().column(2);
         var column1 = this.api().column(7);
         var select = $('<select class="filter js-example-basic-single form-control"><option value="">All</option></select>')
           .appendTo('#selectTriggerFilter')
           var select1 = $('<select class="filter1 js-example-basic-single form-control"><option value="">All</option></select>')
           .appendTo('#selectTriggerFilter1')
           .on('change', function() {
             var val1 = $(this).val();
             column1.search(val1 ? '^' + $(this).val() + '$' : val1, true, false).draw();
   
           });
   
            $(document).on('change','.filter',function(){
              var val = $(this).val();
             column.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
      });
         column1.data().unique().sort().each(function(d, j) {
           var k= d.replace(/(<([^>]+)>)/ig,"");
      if(!k==''){
           select1.append('<option value="' + k + '">' + k + '</option>');
         }
         });
         column.data().unique().sort().each(function(d, j) {
           var l= d.replace(/(<([^>]+)>)/ig,"");
      if(!l==''){
          //alert(l);
           select.append('<option value="' + l + '">' + l + '</option>');
      }
   
         });
       }
     });
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script> 
@endsection
