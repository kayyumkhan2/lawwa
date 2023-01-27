@extends('admin::layouts.master')
@section('title') link info @endsection
@section('content')
<div class="main-content">
   <div class="page-title col-sm-12">
      <div class="row align-items-center">
         <div class="col-md-6">
            <h4>Social link </h4>
         </div>
         <div class="col-md-6">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('sociallinks.index')}}">Social links</a></li>
               <li class="breadcrumb-item active" aria-current="page">social link info </li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
  <div class="card">
<div class="card-header"> 
<div class="d-flex justify-content-between">
      <div>
     {{ $data->name }}
      </div>
      <div>
       <a class="btn btn-sm btn-info float-right rounded-pill ml-5 ml-lg-2" href="{{ route('sociallinks.index') }}" > <i class="fas fa-share-alt rounded-pill"></i> Social links</a>
                    <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"> <i class="fas fa-arrow-circle-left rounded-pill"></i> Back</a>
      </div>
 </div>
</div>
      <div class="card-body">
         {!! $data->title !!}
      </div>
      <div class="card-body">
      <a href="{{$data->url}}"  target="_blank">
         <img src="{{ asset('public/images/sociallinks/'.$data->icon)}}" id="product_image_cls" width="120" height="120">
      </a>
      </div>

   </div>

@endsection

