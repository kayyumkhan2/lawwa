@extends('layouts.admin.app')
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0"> Revenue</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"> Revenue</li>
            </ol>
         </nav>
      </div>
   </div>
</div>


<div class="col-sm-12 mb-4">
   <form  action="{{ route('revenue.filter') }}"  method="get" class="box bg-white">
      <!-- <div class="box-title pb-0">
         <h5>Filter</h5>
         </div> -->
      <div class="d-flex flex-wrap align-items-end py-4">
         <div class="col-md-4">
            <div class="form-group mb-0">
               <label>From</label>
               <div class="input-group">
                  <input type="date" name="from"  value="{{request('from', 1)}}" required="" class="form-control" placeholder="">
               </div>
            </div>
         </div>
         <div class="col-md-4">
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
         <a class="btn btn-success" href="{{ route('totalrevenue') }}"> <i class="fas fa-sync"></i></a>
         
         <div class="col-md-1">
            <div class="form-group mb-0">
                <a class="btn btn btn-warning text-white " href="{{ URL::previous() }}">Back</a>
            </div>
         </div>
         <div class="col-md-1">
            <div class="form-group mb-0">
               <a class="btn btn btn-info float-right" href="{{ route('payments') }}" >Revenue</a>
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
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                      <tr style="background-color: #F37020; color: white;">
                        <th scope="col">Total Revenue</th>
                        <th scope="col">Spent Shopper</th>
                        <th scope="col">Shipping Charges</th>
                        <th scope="col">Service Charges</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="text-dark">
                        <td class="bg-warning"><b>{{$Totalpayment}}</b></td>
                        <td class="bg-warning"><b>{{$Total_amount_spent_shopper}}</b></td>
                        <td class="bg-warning"><b>{{$Total_Shipping_Charges}}</b></td>
                        <td class="bg-warning"><b>{{$Total_Service_Charge}}</b></td>
                      </tr>
                    </tbody>
                    </table>
                  </div>
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
      
       initComplete: function() {
         var column = this.api().column(2);
         var column1 = this.api().column(5);
         var select = $('<select class="filter form-control"><option value="">All</option></select>')
           .appendTo('#selectTriggerFilter')
           var select1 = $('<select class="filter1 form-control"><option value="">All</option></select>')
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
@endsection
