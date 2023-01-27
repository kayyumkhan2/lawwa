@extends('admin::layouts.master')
@section('title') Orders   @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">Orders</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="col-sm-12 mb-4">
   <form  action="{{ route('orderdatefilter') }}"  method="get" class="box bg-white">
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
         <a class="btn btn-success" href="{{ route('orders.index') }}"> <i class="fas fa-sync"></i></a>
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
      <div class="col-sm-12 mb-4 mt-3" >
         <div class="box bg-white">
            <div class="box-row">
               <div class="box-content">
                  <table id="dataTable" class="table table-striped table-bordered table-hover ">
                     <thead>
                        <tr>
                           <th scope="col" class="sr-no">S.No</th>
                           <th scope="col" class="sr-no tdwidth">Order ID</th>
                           <th scope="col">Customer</th>
                           <th scope="col">Shipping option</th>
                           <th scope="col">Tracking id</th>
                           <th scope="col">Txn id</th>
                           <th scope="col">Price</th>
                           <th scope="col">Order At</th>
                           <th scope="col" class="action">Status</th>
                           <!-- <th scope="col">Details</th>-->
                           <th scope="col" class="action">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $i=1 @endphp
                        @foreach ($orders  as $order)
                        <tr>
                           <td scope="row" class="sr-no">
                              {{ $i++ }}
                           </td>
                           <td>{{ $order->id }}</td>
                           <td>@if(!$order->get_user=="") <a class="badge badge-info" href="{{ route('users.show',$order->get_user->id ) }}">{{ucfirst($order->user_name)}}</a> @else {{ucfirst($order->user_name)}} @endif</td>
                           <td>
                              @if($order->shipping_option=="Skypostpaid")
                                 <b class="text-primary">{{$order->shipping_option}}</b>
                                 <br>
                                 <input type="text" name="tracking_id" id="tracking_id" data-order_id="{{ $order->id}}" value="{{ $order->tracking_id  }}">
                              @else
                                 <b class="text-danger">{{$order->shipping_option}}</b>   
                              @endif   
                           </td>
                           <td>{{ $order->tracking_id  }}  </td>
                           <td>{{ $order->txn_id  }}  </td>
                           <td>{{ $order->total_price }}  </td>
                           <td>{{$order->created_at}} </td>
                           <td class="font-weight-bold @if($order->current_status=='DELIVERED') text-success @elseif($order->current_status=='PENDING') text-warning @elseif($order->current_status=='PAYMENTFAILED') text-warning @elseif($order->current_status=='CANCEL') text-danger @elseif($order->current_status=='ORDERED') text-secondary @elseif($order->current_status=='DISPATCH') text-info @elseif($order->current_status=='ONTHEWAY') text-secondary @elseif($order->current_status=='REFUNDED') text-secondary @endif status{{$order->id}}">{{$order->current_status}}</td>
                           <td class="action float-left">
                              <a class="icon-btn preview" href="{{ route('orders.show',$order->id) }}">
                              <i class="fal fa-eye" id="show-btn"></i></a>
                              @if($order->current_status != 'CANCEL' && $order->current_status != 'PAYMENTFAILED' && $order->current_status != 'PENDING' && $order->current_status != 'DELIVERED' && $order->current_status != 'REFUNDED' )
                                 <select id="order-status-change"  data-id="{{$order->id}}" >
                                   <option value="{{$order->current_status  == 'ORDERED' ? 'selected' : ''}}">Update Status</option> 
                                   <option value="DISPATCH"  {{$order->current_status  == 'DISPATCH' ? 'selected' : ''}}>  DISPATCH  </option>
                                   <option value="ONTHEWAY"  {{$order->current_status == 'ONTHEWAY' ? 'selected' : ''}}>   ONTHEWAY  </option>
                                   <option value="DELIVERED" {{$order->current_status  == 'DELIVERED' ? 'selected' : ''}}> DELIVERED </option>
                                   <option value="CANCEL"    {{$order->current_status  == 'CANCEL' ? 'selected' : ''}}>    CANCEL    </option>
                                   <option value="REFUNDED"  {{$order->current_status  == 'REFUNDED' ? 'selected' : ''}}>  REFUNDED  </option>
                                 </select>
                             @endif
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
    $(document).on('change','#tracking_id',function(){
      var tracking_id = $("#tracking_id").val();
      var order_id = $(this).data('order_id');
      $.ajax({
               type: "POST",
               dataType: "json",
               url: "{{ route('order-tracking-id-update') }}",
               data: {'order_id':order_id ,'tracking_id':tracking_id, "_token": "{{ csrf_token() }}"},
               success: function (data) {
                 if(data.status=='ok')
                 {
                  swal({
                         title: "Success!",
                         text: data.message,
                         icon: "success",
                         button: "Ok!",
                         timer: 2000,
                       });    
                 }
               },
               error: function (request, status, error) {
               swal({
                     title: "error!",
                     text: "Something is wrong",
                     icon: "error",
                     button: "Ok!",
                     timer: 3000,
               });  
             } 
          });
       });
</script>
<script>
   $(document).on('change','#from,#to',function(){
         var from = $("#from").val();
         var to = $("#to").val();
         if(Date.parse(from) > Date.parse(to)){
            swal("error", "Invalid Date Range!", "error");
            $("#submit").prop('disabled', true);
            $('input[name=from').val('');
            $('input[name=to').val('');
         }
         else{
            $("#submit").prop('disabled', false);
         }
    });
   $(document).ready(function(){
       $(document).on('change','#order-status-change',function(){
           var order_id = $(this).data('id');
           var status = $(this).val();
           if (status !="") {
            swal({
               title: "Are you sure?",
               text: "Once change, you will not be able to recover this imaginary!",
               icon: "warning",
               buttons: true,
               dangerMode: true,
            })
       .then((willDelete) => {
     if (willDelete) {
            swal({
                   icon: "{{ asset('images/lawwaloder.gif' ) }}",
                   buttons: false,      
                   closeOnClickOutside: false,
               });
           $.ajax({
               type: "POST",
               dataType: "json",
               url: "{{ route('statuschange') }}",
               data: {'order_id': order_id,'status':status,"_token": "{{ csrf_token() }}"},
               success: function (data) {
                 if(data.status=='ok')
                 {
                
                  $('.status'+order_id+'').text(status);
                  swal({
                         title: "Success!",
                         text: data.message,
                         icon: "success",
                         button: "Ok!",
                         timer: 2000,
                       });    
                 }
                 if(data.status=='error')
                 {
                   swal({
                     title: "error!",
                     text: data.message,
                     icon: "error",
                     button: "Ok!",
                     timer: 2000,
                   });    
                 }
               },
               error: function (request, status, error) {
               swal({
                     title: "error!",
                     text: "Something is wrong",
                     icon: "error",
                     button: "Ok!",
                     timer: 3000,
               });  
             }
           });
            } 
          });
       }
    });
   });
</script>

<script>
   $(document).ready(function() {
     $('#dataTable').DataTable({
        responsive: true,
        initComplete: function() {
         var column = this.api().column(2);
         var column1 = this.api().column(6);
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
