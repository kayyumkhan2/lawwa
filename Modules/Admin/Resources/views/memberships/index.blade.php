@extends('admin::layouts.master')
@section('title') {{$pagename}} @endsection
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
<div class="row">
<div class="col-md-12 bg-muted text-right">
   <!-- <a class="btn btn-sm btn-warning rounded-pill text-white" href="javascript:history.go(-1)">  <i class="fas fa-arrow-circle-left"></i> Back</a> -->
   <a class="btn btn-sm btn-info rounded-pill " href="{{ route('membershipplan.create') }}" > <i class="fa fa-plus-circle"></i> {{$pagename}}</a>
</div>
<div class="col-sm-12 mb-4 mt-3" >
   <div class="box bg-white">
      <div class="box-row">
         <div class="box-content">
            <table id="dataTable" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr>
                     <th scope="col" class="sr-no">S.No</th>
                     <th scope="col" >Name</th>
                     <th scope="col" >Price</th>
                     <th scope="col" class="action">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php $i=1 @endphp
                  @foreach ($memberships as $key => $value)
                  <tr>
                     <td>{{ $i++ }}</td>
                     <td>{{ $value->name }} </td>
                     <td>{{ $value->price }} </td>
                     <td class="action ">
                        <form method="post" action="{{route('membershipplan.destroy',$value->id)}}" id="add-product-form{{$i}}">
                           {!! method_field('delete') !!}
                           {!! csrf_field() !!}              
                        </form>
                        @if(Auth::user()->hasPermissionTo('users.update'))<a class="icon-btn edit" href="{{ route('membershipplan.edit',$value->id) }}"><i class="fal fa-trash-alt" id="delete-btn"></i></a>
                        @endif 
                        <a class="icon-btn preview" href="{{ route('membershipplan.show',$value->id) }}"><i class="fal fa-eye" id="show-btn"></i></a>  
                        <a class="icon-btn edit" href="{{ route('membershipplan.edit',$value->id) }}"><i class="fal fa-edit" id="show-edit"></i></a>
                        <a href="javascript:document.getElementById('add-product-form{{$i}}').submit();"  onclick="return confirm('Are you sure you want to delete this item?');" class="icon-btn delete"><i class="fal fa-trash-alt" id="delete-btn"></i></a>
                     </td>
                  </tr>
                  @endforeach 
               </tbody>
            </table>
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
