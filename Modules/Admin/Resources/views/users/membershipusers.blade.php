@extends('admin::layouts.master')
@section('title') {{$pagename}}
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">{{$pagename}}</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">{{$pagename}}</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="row">
      <div class="col-md-12 text-right">
         <a class="btn btn-sm btn-warning text-white rounded-pill" href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back</a>
         <a class="btn btn-sm btn-info rounded-pill" href="{{ route('users.customers') }}"> <i class="fa fa-users" aria-hidden="true"></i> Customers </a> 
      </div>
      <div class="col-sm-12 mb-4 mt-3" >
         <div class="box bg-white">
            <div class="box-row">
               <div class="box-content">
                  <table id="dataTable" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col" class="sr-no">S.No</th>
                           <th scope="col">Name</th>
                           <th scope="col">Phone Number</th>
                           <th scope="col">Email</th>
                           <th scope="col">From</th>
                           <th scope="col">To</th>
                           <th scope="col">Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $i=1;@endphp
                        @foreach ($data as $key => $user)
                        <tr class="notification{{$user->id}}">
                           <th scope="row" class="sr-no">{{ $i++ }}</th>
                           <td>{{ $user->full_name }} {{MemberShipStatusCheck($user)}}</td>
                           <td>{{ $user->phone_no }}</td>
                           <td>{{ $user->email }}</td>
                           <td>{{MemberShipStatusCheck($user,'membershipinfo')['from']}}</td>
                           <td>{{MemberShipStatusCheck($user,'membershipinfo')['to']}}</td> 
                           <td>
                              <span class="Statuschange badge @if(MemberShipStatusCheck($user)=='0') badge-danger @else badge badge-success @endif" data-id="{{$user->id}}"  data-model="User" id="Statuschange{{$user->id}}"> @if(MemberShipStatusCheck($user)=="0") inactive @else Active @endif </span>
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
@endsection
@section('js')
<script>
   $('#dataTable').DataTable();
</script>
@endsection
