@extends('admin::layouts.master')
@section('title') Products @endsection
@section('content')
<div class="main-content">
   <div class="page-title col-sm-12">
      <div class="row align-items-center">
         <div class="col-md-6">
            <h1 class="h3 m-0">Product Details</h1>
         </div>
         <div class="col-md-6">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb m-0 p-0">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Product details</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <div class="card">
      <div class="card-header">
         <div class="d-flex justify-content-between">
            <div>
               {{ $product->name }}
            </div>
            <div>
               <a class="btn btn-sm btn-warning text-white" href="{{ URL::previous() }}" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> <a class="btn btn-sm btn-info " href="{{ route('products.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Products</a>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 mt-5">
         <div class="form-group row">
            <label class="col-md-6 col-form-label" for="text-input">
            <b class="text-secondary">Product Title : </b>
            </label>
            <div class="col-md-6">
               {{ $product->name }}
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 ">
         <div class="form-group row">
            <label class="col-md-6 col-form-label" for="text-input">
            <b class="text-secondary">Product Price : </b>
            </label>
            <div class="col-md-6">
               {{ $product->price }}
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 ">
         <div class="form-group row">
            <label class="col-md-6 col-form-label" for="text-input">
            <b class="text-secondary">Sale Price : </b>
            </label>
            <div class="col-md-6">
               {{ $product->sale_price }}
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 ">
         <div class="form-group row">
            <label class="col-md-6 col-form-label" for="text-input">
            <b class="text-secondary">Member Price : </b>
            </label>
            <div class="col-md-6">
               {{ $product->member_price }}
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 ">
         <div class="form-group row">
            <label class="col-md-6 col-form-label" for="text-input">
            <b class="text-secondary">Category : </b>
            </label>
            <div class="col-md-6">
           @foreach ($product->categoriesdata as $categorname)
              {{$categorname->name}}
               @php $coma="|"; @endphp 
               @if($loop->last)
               @php $coma=""; @endphp  
           @endif 
           <b class="text-primary" style="font-size: 18px;">{{$coma}}</b> 
          @endforeach
            </div>
         </div>
      </div>
     <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group row">
            <label class="col-md-6 col-form-label" for="text-input">
            <b class="text-secondary">Product Image : </b>
            </label>
            <div class="col-md-6">
               @foreach ($product->Productimages as $image)
               <img src="{{asset('images/productsimages/'.$image->image)}}" alt="Image Not Found" width="100" height="100"  class="img-thumbnail">
               @endforeach
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group row">
            <label class="col-md-6 col-form-label" for="text-input">
            <b class="text-secondary">Product Description : </b>
            </label>
            <div class="col-md-6">
               <p>{!! $product->description !!}</p>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group row">
            <label class="col-md-6 col-form-label" for="text-input">
            <b class="text-secondary">Status</b>
            </label>
            <div class="col-md-6">
               @if($product->status=="1") <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Deactivate</span> @endif
               <br>   
            </div>
         </div>
      </div>
   </div>
   @endsection
</div>
