@extends('admin::layouts.master')
@section('title') Service info @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h4>Service info</h4>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('service.index')}}">Services</a></li>
               <li class="breadcrumb-item active" aria-current="page">Service info</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header flex-column h-100">
      <span>Service Details</span>
      <a class="btn btn-sm btn-info rounded-pill float-right ml-5 ml-lg-2" href="{{ route('service.index') }}" > <i class="fab fa-servicestack"></i> Services</a>
      <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <img class="card-img-top" data-src="holder.js/100px180/" alt="100%x180" style="height: 300px; width: 100%; display: block;" src="{{ asset('public/images/serviceimages/'.$data->service_image) }}" data-holder-rendered="true">   
               <div class="card-body">
                  <h4 class="card-title">{{$data->name}}</h4>
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item"><strong>Amount : </strong>{{$data->amount}}</li>
                     <li class="list-group-item">
                        <strong>
                           Categories :
                           @if(count($data->ServiceCategory) > 0)
                              @foreach($data->ServiceCategory as $key => $subCategory)
                                 {{$subCategory->categoryDetails->name}}@if(!$loop->last),@endif
                              @endforeach
                           @endif
                        </strong>
                     </li>
                     <li class="list-group-item"><strong>Status : </strong><span class="Statuschange badge @if($data->status=='0') badge-danger @else badge badge-success @endif" data-id="{{$data->id}}"  data-model="Service" id="Statuschange{{$data->id}}"> @if($data->status=="0") Deactive @else Active @endif </span></li>
                     <li class="list-group-item">
                        <p class="card-text text-justify">{{$data->brief_detail}}</p>
                     </li>
                  </ul>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
