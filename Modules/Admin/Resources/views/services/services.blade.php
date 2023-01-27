@extends('admin::layouts.master')
@section('title') Services @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1 class="h3 m-0">Services</h1>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Services</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-12 text-right bg-muted"> 
      <a class="btn btn-sm btn-warning rounded-pill text-white" href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a>
       <a class="btn btn-sm btn-info rounded-pill " href="{{ route('service.create') }}" ><i class="fa fa-plus-circle"></i> Service </a>
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
                  <th scope="col" class="action">Image</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Time</th>
                  <th scope="col">Status</th>
                  <th scope="col" class="action"> Action</th>
                </tr>
              </thead>
              <tbody>
              
              @php $i=1 @endphp
              @foreach ($data as $key =>$service)
              <tr class="notification{{$service->id}}">
                <th scope="row" class="sr-no action">{{ $i++ }}</th>
                <td>{{ $service->name }}</td>
                <td>
                  <img src="{{ asset('public/images/serviceimages/'.$service->service_image) }}"  class="img-thumbnail" width="80">
                </td>
                <td>{{ $service->amount }}</td>
                <td>@if($service->houre){{ $service->houre }} Hour @endif @if($service->minute) {{ $service->minute }} Minute @endif</td>
                <td>
                <span class="Statuschange badge @if($service->status=='0') badge-danger @else badge badge-success @endif" data-id="{{$service->id}}"  data-model="Service" id="Statuschange{{$service->id}}"> @if($service->status=="0") Deactive @else Active @endif </span></td>
                <td class="action "> 
                <a class="icon-btn preview" href="{{ route('service.show',$service->id) }}"><i class="fal fa-eye" id="show-btn"></i></a><a class="icon-btn edit" href="{{ route('service.edit',$service->id) }}"><i class="fal fa-edit" id="show-edit"></i></a>
                <a class="icon-btn delete universaldelete" href="javascript:void(0);" data-status="0" data-id="{{ $service->id}}"  data-model="Service" id="notification{{$service->id}}"> <i class="fal fa-trash-alt" id="delete-btn"></i></a> 
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
@section('css')
<style type="text/css">
.img-thumbnail:hover {
  transition: transform .8s;
    zoom: 3; /* all browsers */
  transform: scale(3);
  cursor: zoom-out;
}   
</style>
@endsection
@section('js') 

<script>
    $('#dataTable').DataTable();
</script>
@endsection 