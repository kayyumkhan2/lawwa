@extends('admin::layouts.master')
@section('title') Update Settings @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1>Settings</h1>
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
<div class="card">
  <div class="card-header">
  <strong>Settings</strong>
    <a class="btn btn-sm btn-info float-right ml-5 ml-lg-2" href="{{ route('settings.index') }}" >Settings</a>
    <a class="btn btn-sm btn-warning text-white float-right " href="javascript:history.go(-1)">Back</a>
</div>
<div class="card-body">
<form action="{{ route('settings.update',$Setting->id) }}" method="POST" enctype="multipart/form-data">
   @csrf @method('PUT')
   <div class="row">
     
    <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group"><label class="starlabel">Beautician Commission  </label>
          <input type="number" min="0" max="100" name="BeauticianCommission" value="{{ $Setting->BeauticianCommission }}" class="form-control" placeholder="Beautician Commission ..">
         <small id="emailHelp" class="form-text text-muted">This will be considered as (%) percentage.</small>
         </div>
      </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group"><label class="starlabel">Shipping Charge </label><input type="text" min="0" name="ShippingCharges" value="{{ $Setting->ShippingCharges }}" class="form-control" placeholder="shipping Charge">
         <!-- <small id="emailHelp" class="form-text text-muted">This will be considered as (%) percentage</small> -->
         </div>
      </div>  
 
       <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group"><label class="starlabel">Shipping Charge Condition </label><input type="text" min="0" name="ChargeCondition" value="{{ $Setting->ChargeCondition }}" class="form-control" placeholder="Charge Condition">
         <!-- <small id="emailHelp" class="form-text text-muted">This will be considered as (%) percentage</small> -->
         </div>
      </div>  
   
</div>
</div>
     
  <div class="card-footer">
     <button class="btn btn-sm btn-primary" type="submit">Save</button>
   <!-- <button class="btn btn-sm btn-danger" type="reset"> Reset</button> -->
  </div>
  </form>   
</div>
</div>
@endsection
