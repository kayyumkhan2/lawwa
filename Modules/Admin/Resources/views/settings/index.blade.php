@extends('admin::layouts.master')
@section('title') Settings @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">Settings</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Settings</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="row">
      <div class="col-md-12 bg-muted text-right">
         <a class="btn btn-sm btn-warning text-white" href="javascript:history.go(-1)"> Back</a>
         <a class="btn btn-sm btn-info " href="{{route('settings.edit',1)}}"> <i class="fas fa-cog"></i> Update</a>
      </div>
      <div class="col-sm-12 mb-4 mt-3" >
         <div class="box bg-white">
            <div class="box-row">
               <div class="box-content">
                  <table id="dataTable" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col">Beautician Commission</th>
                           <th scope="col">Shipping Charges</th>
                           <th scope="col">Charge Condition</th>
                           <th scope="col" class="action">Action</th>
                     </thead>
                     <tbody>
                        </tr>
                        @php $i=1 @endphp
                        @foreach ($data  as $Setting)
                        <tr>
                           <td>{{ $Setting->BeauticianCommission }}</td>
                           <td>{{ $Setting->ShippingCharges }}</td>
                           <td>{{ $Setting->ChargeCondition }} </td>
                           <td class="action float-center">
                              <a class="icon-btn edit" href="{{ route('settings.edit',$Setting->id) }}" style="margin-right: 80px;"><i class="fal fa-edit" id="show-edit"></i></a> 
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  @jquery
                  @toastr_js
                  @toastr_render
                  </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection 
@section('js')
<script>
   $(document).ready( function () {
    $('#dataTable').DataTable();
   });
   
</script>
@endsection
