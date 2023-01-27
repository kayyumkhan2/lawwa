@extends('admin::layouts.master')
@section('title') Add Mail Template @endsection
@section('content')
<div class="main-content">
   <div class="page-title col-sm-12">
      <div class="row align-items-center">
         <div class="col-md-6">
            <h1>Mail Templates</h1>
         </div>
         <div class="col-md-6">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb m-0 p-0">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('mailtemplates.index')}}">Mail Templates</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Create Mail Template</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
   @endif
   <div class="card">
      <div class="card-header flex-column h-100">
         <span>Fill Template Deatils</span>
         <a class="btn btn-sm btn-info float-right ml-5 ml-lg-2 rounded-pill" href="{{ route('mailtemplates.index') }}" > <i class="fas fa-mail-bulk"></i></i> Mail Templates</a>
         <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a>
      </div>
      <div class="card-body">
         <form method="POST" action="{{ route('mailtemplates.store') }}" id="formvalidation" autocomplete="off"  enctype="multipart/form-data" class="ml-5">
          {{ csrf_field() }}
            <div class="form-group row ">
               <div class="col-xs-5 col-sm-5 col-md-5">
                <label class="col-form-label starlabel" >Title   : </label>
                  <input type="text" name="title" placeholder = 'Enter Title..' value="{{ old('title') }}" class = "form-control  @error('title') is-invalid @enderror" >
                  @if ($errors->has('title'))
                  <span class="invalid feedback" role="alert"> 
                  <strong class="text-danger">{{ $errors->first('title') }}.</strong> 
                  </span>
                  @endif
            </div>
            <div class="form-group row ">
               <div class="col-xs-5 col-sm-5 col-md-5">
                <label class="col-form-label starlabel" >Template For   : </label>
                  <select name="template_for"> 
                    <option value="PAYMENTFAILE">Order Payment Failed </option>
                    <option value="ORDERED"> Order Success</option>
                    <option value="DISPATCH">Order Dispatch</option>
                    <option value="ONTHEWAY">Order On The Way</option>
                    <option value="DELIVERED">Order Deliver</option>
                    <option value="CANCEL">Order Cancel</option>
                    <option value="REFUNDED">Order Refund</option>
                    <option value="PaymentFailed">Booking Payment Failed </option>
                    <option value="Booked">Booking Success </option>
                    <option value="Assigned">Booking Assigned to PBTLA </option>
                    <option value="Accepted">Booking Accepted by PBTLA</option>
                    <option value="OnTheWay">PBTLA On The Way </option>
                    <option value="Postponed">Booking Postponed </option>
                    <option value="Cancel">Booking Cancel </option>
                    <option value="Reached">PBTLA  Reached On Destination</option>
                    <option value="Start">Service started by PBTLA</option>
                    <option value="Completed">Booking Cancel Complete </option>
                    <option value="Refunded">Booking Refund</option>
                    <option value="Membership">Membership Purchase  </option>
                  </select>
                  @if ($errors->has('template_for'))
                  <span class="invalid feedback" role="alert"> 
                  <strong class="text-danger">{{ $errors->first('template_for') }}.</strong> 
                  </span>
                  @endif
                </div>
            </div>
               <div class="col-xs-5 col-sm-5 col-md-5">
                  <label class="col-form-label starlabel" >Subject : </label>
                  <input type="text" name="subject" placeholder = 'Enter Subject..' value="{{ old('subject') }}" class = "form-control  @error('subject') is-invalid @enderror" >
                  @if ($errors->has('subject'))
                  <span class="invalid feedback" role="alert"> 
                  <strong class="text-danger">{{ $errors->first('subject') }}.</strong> 
                  </span>
                  @endif
            </div>
          </div>
        <div class="form-group row">
          <label class="col-md-2 col-form-label">Set as Default</label>
            <div class="col-md-8 col-form-label">
            <div class="form-check checkbox mb-2">
                <input class="form-check-input" name="default_status" id="default_status" type="checkbox" value='1'>
                <label class="form-check-label" for="default_status"></label>
                </div>
            </div>
        </div>
          <div class="form-group row ">
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <label for="exampleFormControlTextarea1">Html Template</label>
                       <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="html_template">{{ old('html_template') }}</textarea>
                        @if ($errors->has('html_template'))
                     <span class="invalid feedback" role="alert"> 
                     <strong class="text-danger">{{ $errors->first('html_template') }}.</strong> 
                     </span>
                     @endif
                  </div>
               </div>
              </div>
        <div class="card-footer ">
           <button class="btn btn-sm btn-primary" type="submit">Save</button>
           <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
        </div>
   </form>
</div>
@endsection

@section('js')

<script type="text/javascript">
      CKEDITOR.replace('html_template');
   $(function() {
         $("#formvalidation").validate({
         rules: {
           title: {
             required: true,
           },
           subject: {
             required: true,
           },
           html_template: {
             required: true,
           }

         },

         messages: {
           title: {
             required: "Title is a required field !"
           },
           subject: {
             required: "Subject is a required field !"
           },
           
         }
      });
   });
</script>
@endsection
