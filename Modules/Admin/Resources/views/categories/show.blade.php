@extends('admin::layouts.master')
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1>Category info</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Category show</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header"><a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a><strong>{{$categorydata->name}}</strong> </div>
   <div class="card-body">

    <div class="card" style="width: 28rem;">
      <img src="{{ asset('public/images/categoriesimages/'.$categorydata->image) }}" alt="icon" width="60"class="img-thumbnail card-img-top">
   <div class="card mt-1" style="width: 28rem;">
     <div class="card-header">
   {{$categorydata->title}}
   
  </div>
   <ul class="list-group list-group-flush">
         @foreach ($categories as $category)
         <li class="list-group-item"><b style="color: green;">{{ $category->name }}</b></li>
            @foreach ($category->subcategory as $childCategory)
            @include('admin.categories.child_category', ['child_category' => $childCategory])
            @endforeach
         @endforeach
      </ul>
</div>
  <div class="card-body">
    <p class="card-text">{{$categorydata->description}}</p>
  </div>
</div>
      
   </div>
</div>
@endsection
