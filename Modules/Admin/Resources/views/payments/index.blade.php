@extends('admin::layouts.master')
@section('title') {{ app('request')->input('filterrevenue') }} Payment history @endsection
@section('content')
<div class="main-content">
    <div class="page-title col-sm-12">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 m-0"> {{ app('request')->input('filterrevenue') }} Payment history</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ app('request')->input('filterrevenue') }} Payment history</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<div class="col-sm-12 mb-4">
    <form  action="{{ route('payments',['id'=>'id']) }}"  method="get" class="box bg-white">
        <!-- <div class="box-title pb-0">
            <h5>Filter</h5>
        </div> -->                    
        <div class="d-flex flex-wrap align-items-end py-4">
          {{-- <div class="col-md-3">
                <div class="form-group mb-0">
                    <label>From</label>
                    <div class="input-group">
                         <input type="date" name="from"  value="{{request('from', 1)}}" required="" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
             <div class="col-md-3">
                <div class="form-group mb-0">
                    <label>To</label>
                    <div class="input-group">
                      <input type="date" name="to" required=""  max="{{date('Y-m-d')}}"  value="{{request('to', date('Y-m-d'))}}" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-md-1 text-right">
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-info w-100"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <a class="btn btn-success" href="{{ route('payments') }}"> <i class="fas fa-sync"></i></a>--}}
            <div class="col-md-6">
                <div class="form-group mb-0">
                    <label>Customer</label>
                 <div class="input-group" id="selectTriggerFilter">     
                 </div>
               </div>
              </div>
            <div class="col-md-6">
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
                  <table id="dataTable" class="table table-striped table-bordered table-hover">
                      <thead>
                                <tr>
                                    <th scope="col" class="sr-no">S.No</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Txn</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Charges</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Time</th>
                                    <th scope="col" class="action">Actions</th>

                              </thead>
                            <tbody>
                                @php $i=1 @endphp
                                   @foreach ($Payments  as $Payment)
                                   <tr>
                                      <td scope="row" class="sr-no">
                                      {{ $i++ }}</td>
                                      <td><span class="badge badge-danger text-white " >@if(@!$Payment->PaymentUser==""){{@ucfirst(@$Payment->PaymentUser->full_name)}} @endif</span></td>
                                      <td>{{ $Payment->txn_id  }}  </td>
                                      <td>{{ $Payment->amount  }}  </td>
                                      <td>
                                        @if(@$Payment->type=="Order")
                                                {{ucfirst(@$Payment->type)}}
                                            @elseif(@$Payment->type=="Booking")
                                            @if(@!$Payment->PaymentBooking=="")
                                                {{@$Payment->type}}
                                            @endif
                                            @elseif(@$Payment->type=="Certification")
                                             @if(@!$Payment->PaymentCertificate=="")
                                                   {{@$Payment->type}}
                                             @endif
                                             @elseif(@$Payment->type=="Course")
                                             @if(@!$Payment->PaymentCourse=="")
                                                  {{@$Payment->type}}
                                             @endif
                                            @else
                                            {{ucfirst(@$Payment->type)}}
                                        @endif
                                      </td>
                                      <td>{{ $Payment->ShippingCharges  }}  </td>
                                      <td><span class="badge @if($Payment->status=='Successed') badge-success @else badge-danger @endif ">{{ucfirst($Payment->status)}}</span> </td>
                                      <td>{{$Payment->created_at->format('d-m-Y h:i A ')}} </td>
                                       <td>
                                        @if((@$Payment->type=="Order") && (!$Payment->PaymentOrder=="") )
                                            <a class="badge badge-primary icon-btn preview" title="View" href="{{ route('orders.show',@$Payment->PaymentOrder->id ) }}"><i class="fal fa-eye" id="show-btn"></i>
                                                {{ucfirst($Payment->type)}}
                                            </a>
                                            @elseif(($Payment->type=="Booking") && (!$Payment->PaymentOrder==""))
                                            @if(!$Payment->PaymentBooking=="")
                                            <a class="badge badge-primary icon-btn preview" title="View" href="{{ route('bookings.show',@$Payment->PaymentBooking->id ) }}"><i class="fal fa-eye" id="show-btn"></i>
                                                {{ucfirst($Payment->type)}}
                                            </a>
                                            @endif
                                            @elseif(($Payment->type=="Certification") && (!$Payment->PaymentOrder==""))
                                             @if(!$Payment->PaymentCertificate=="")
                                                <a class="badge badge-primary icon-btn preview" title="View" href="{{ route('certificates.index',['id'=>@$Payment->PaymentCertificate->txn_id] ) }}"><i class="fal fa-eye" id="show-btn"></i>
                                                    {{ucfirst($Payment->type)}}
                                                </a>
                                             @endif
                                             @elseif(($Payment->type=="Course") && (!$Payment->PaymentOrder==""))
                                             @if(!$Payment->PaymentCourse=="")
                                                <a class="badge badge-primary icon-btn preview" title="View" href="{{ route('courses.index',['id'=>@$Payment->PaymentCourse->txn_id] ) }}"><i class="fal fa-eye" id="show-btn"></i>
                                                    {{ucfirst($Payment->type)}}
                                                </a>
                                             @endif
                                            @else
                                            <span class="badge badge-primary icon-btn preview">
                                                <i class="fal fa-eye" id="show-btn"></i> {{ucfirst($Payment->type)}}
                                            </span>
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
<script>
   $(document).ready(function() {
     $('#dataTable').DataTable({
        responsive: true,
        initComplete: function() {
         var column = this.api().column(1);
         var column1 = this.api().column(4);
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



