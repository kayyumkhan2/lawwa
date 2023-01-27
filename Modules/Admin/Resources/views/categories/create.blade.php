@extends('admin::layouts.master')
@section('title') Add @if($categorey_type==0) Service Category @else  Product Category  @endif @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h3>Add @if($categorey_type==0) Service Category @else  Product Category  @endif</h3>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               @if($categorey_type==0)
               <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Services Categories</a></li>
               <li class="breadcrumb-item active" aria-current="page">Create Service Category</li>
               @else
               <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Products Categories</a></li>
               <li class="breadcrumb-item active" aria-current="page">Create Category</li>
               @endif
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   @if($categorey_type==0)
   <div class="card-header">  
      <a class="btn btn-sm btn-info rounded-pill float-right ml-5 ml-lg-2" href="{{ route('categories.servicecategories') }}" > <i class="far fa-tags"></i> Service Categories</a>
      <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a>
   </div>
   @else
   <div class="card-header"> <strong>Add Category</strong> 
      <a class="btn btn-sm btn-info rounded-pill float-right ml-5 ml-lg-2" href="{{ route('categories.index') }}" > <i class="far fa-tags"></i> Product Categories</a>
      <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-left"></i> Back </a>
   </div>
   @endif
   <div class="card-body">
      <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="form-group">
            <label>Category Name</label>
            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  value="{{ old('name') }}" autofocus id="nf-name" name="name" type="text" 
               placeholder="Enter Category name.." autocomplete="name">
            @if ($errors->has('name')) <span class="invalid feedback" role="alert"> <strong class="text-danger">{{ $errors->first('name') }}.</strong> </span> @endif 
         </div>
         <div class="form-group">
            <label>Title</label>
            <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  value="{{ old('title') }}" autofocus id="nf-title" name="title" type="text" 
               placeholder="Enter Category title.." autocomplete="title">
            @if ($errors->has('title')) <span class="invalid feedback" role="alert"> <strong class="text-danger">{{ $errors->first('title') }}.</strong> </span> @endif 
         </div>
         @if (count($categories) > 0)
          @if($categorey_type==0)
         <div class="form-group row ">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <label for="emp-id" class="form-input-label">Parent Category : </label>
               <select  name="parent_id" id="parent_id"  class="selectpicker form-control parent_id" >
                  <option value="">--Selecy Category--</option>
                  @foreach($categories as $categorie)
                  <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                  @endforeach                                         
               </select>
            </div>
         </div>
         @endif
         @endif
         <div class="form-group row">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <label class="form-col-form-label" >Select Icon</label>
               <input type="file" id="file-input" class="form-control file-input {{ $errors->has('image') ? ' is-invalid' : '' }}"  value="{{ old('image') }}" autofocus multiple name="image" />
               @if ($errors->has('image')) <span class="invalid feedback" role="alert"> <strong class="text-danger">{{ $errors->first('image') }}.</strong> </span> @endif 
            </div>
         </div>
         <div class="form-group row " @if($categorey_type==0)  style="display: none;" @endif >
            <label class="ml-3">Category for</label>
            <div class="col-sm-12">
               <select  name="categorey_type" class="selectpicker form-control">
                  @if($categorey_type==0)
                  <option value='0' selected="">Service-Category</option>
                  @else
                  <option value='1'>Product-Category</option>
                  <option value='2'>Product-Offer-Category</option>
                  @endif
               </select>
            </div>
            <div class="col-sm-2">
            </div>
         </div>
         <div class="form-group row ">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <label for="exampleFormControlTextarea1">Description</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ old('description') }}</textarea>
               @if ($errors->has('description'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('description') }}.</strong> 
               </span>
               @endif
            </div>
         </div>
   </div>
   <div class="card-footer">
   <button class="btn btn-sm btn-primary" type="submit">Save</button>
   <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
   </div>
   </form>
</div>
@endsection
@section('js') 
<script type="text/javascript">
   $(document).ready(function () {
     $(".parent_id").select2({
     });
   });
   
   
</script>
@endsection
