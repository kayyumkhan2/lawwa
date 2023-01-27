@extends('admin::layouts.master')
@section('title') Add Brand @endsection
@section('content')
<div class="main-content">
   <div class="page-title col-sm-12">
      <div class="row align-items-center">
         <div class="col-md-6">
            <h1>Banner info </h1>
         </div>
         <div class="col-md-6">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb m-0 p-0">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('banners.index')}}">Banners</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Banner info</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <div class="card">
       <div class="card-header"> 
<div class="d-flex justify-content-between">
   {{$banner->title}}
      <div>
                           <a class="btn btn-sm btn-warning rounded-pill text-white" href="javascript:history.go(-1)"> Back</a>
<a class="btn btn-sm btn-info rounded-pill " href="{{ route('banners.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Banners</a>
      </div>
 </div>

</div>
      
      <div class="card-body">
   <div class="row"> 
              <div class="col-md-6">
<a href="{{ asset('public/images/banner_images/'.$banner->banner) }}" class="btn btn-primary">Open</a>

</div>
         <div class="col-md-6">
         <span class="badge @if($banner->status=='0') badge-danger @else badge badge-success @endif" >    @if($banner->status=="0") Deactive @else Active @endif 
</span>
</div>
</div>
<br>
         
  <br><br>
       <img src="{{ asset('public/images/banner_images/'.$banner->banner) }}">
         <br>
         <br>
         <br>
         <p>
         Created At :   {{$banner->created_at }}
        </p>
         Last Updated :  {{$banner->updated_at }}
      </div>
   </div>

@endsection

