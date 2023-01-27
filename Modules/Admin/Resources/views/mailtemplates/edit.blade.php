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
         <form method="POST" action="{{ route('mailtemplates.update',$data->id) }}" id="formvalidation" autocomplete="off"  enctype="multipart/form-data" class="ml-5">
                          {{ csrf_field() }}
   {{ method_field('PATCH') }}
          <div class="form-group row ">
               <div class="col-xs-5 col-sm-5 col-md-5">
                <label class="col-form-label starlabel" >Title   : </label>
                  <input type="text" name="title" placeholder = 'Enter Title..' value="{{ $data->title  }}" class = "form-control  @error('title') is-invalid @enderror" >
                  @if ($errors->has('title'))
                  <span class="invalid feedback" role="alert"> 
                  <strong class="text-danger">{{ $errors->first('title') }}.</strong> 
                  </span>
                  @endif
              </div> 
               <div class="col-xs-5 col-sm-5 col-md-5">
                  <label class="col-form-label starlabel" >Subject : </label>
                  <input type="text" name="subject" placeholder = 'Enter Subject..' value="{{ $data->subject  }}" class = "form-control  @error('subject') is-invalid @enderror" >
                  @if ($errors->has('subject'))
                  <span class="invalid feedback" role="alert"> 
                  <strong class="text-danger">{{ $errors->first('subject') }}.</strong> 
                  </span>
                  @endif
            </div>
          </div>
          <div class="form-group row ">
               <div class="col-xs-5 col-sm-5 col-md-5">
                <label class="col-form-label starlabel" >Template For   : </label>
                  <select name="template_for" class="form-control"> 
                    <option value="PAYMENTFAILE" {{ $data->template_for ==  "PAYMENTFAILE" ? "selected" : "" }}>  Order Payment Failed </option>
                    <option value="ORDERED" {{ $data->template_for ==  "ORDERED" ? "selected" : "" }}>   Order Success</option>
                    <option value="DISPATCH" {{ $data->template_for ==  "DISPATCH" ? "selected" : "" }}>  Order Dispatch</option>
                    <option value="ONTHEWAY" {{ $data->template_for ==  "ONTHEWAY" ? "selected" : "" }}>  Order On The Way</option>
                    <option value="DELIVERED" {{ $data->template_for == " DELIVERED" ? "selected" : "" }}>  Order Deliver</option>
                    <option value="CANCEL" {{ $data->template_for ==  "CANCEL" ? "selected" : "" }}>  Order Cancel</option>
                    <option value="REFUNDED" {{ $data->template_for ==  "REFUNDED" ? "selected" : "" }}>  Order Refund</option>
                    <option value="PaymentFailed" {{ $data->template_for ==  "PaymentFailed" ? "selected" : "" }}>  Booking Payment Failed </option>
                    <option value="Booked" {{ $data->template_for ==  "Booked" ? "selected" : "" }}>  Booking Success </option>
                    <option value="Assigned" {{ $data->template_for ==  "Assigned" ? "selected" : "" }}>  Booking Assigned to PBTLA </option>
                    <option value="Bookingassigntopbt" {{ $data->template_for ==  "Bookingassigntopbt" ? "selected" : "" }}>Booking assign pbt mail </option>
                    <option value="Accepted" {{ $data->template_for ==  "Accepted" ? "selected" : "" }}>  Booking Accepted by PBTLA</option>
                    <option value="OnTheWay" {{ $data->template_for ==  "OnTheWay" ? "selected" : "" }}>  PBTLA On The Way </option>
                    <option value="Postponed" {{ $data->template_for ==  "Postponed" ? "selected" : "" }}>  Booking Postponed </option>
                    <option value="Cancel" {{ $data->template_for ==  "Cancel" ? "selected" : "" }}>  Booking Cancel </option>
                    <option value="Reached" {{ $data->template_for ==  "Reached" ? "selected" : "" }}>  PBTLA Reached On Destination</option>
                    <option value="Start" {{ $data->template_for ==  "Start" ? "selected" : "" }}>  Service started by PBTLA</option>
                    <option value="Completed" {{ $data->template_for ==  "Completed" ? "selected" : "" }}>  Booking Complete </option>
                    <option value="Refunded" {{ $data->template_for ==  "Refunded" ? "selected" : "" }}>  Booking Refund</option>
                    <option value="Membership" {{ $data->template_for ==  "Membership" ? "selected" : "" }}>  Membership Purchase  </option>
                  </select>
                  @if ($errors->has('template_for'))
                  <span class="invalid feedback" role="alert"> 
                    <strong class="text-danger">{{ $errors->first('template_for') }}.</strong> 
                  </span>
                  @endif
                </div>
            </div>
            <select name="for" class="form-control" style="display:none;"> 
                    <option value="Booking Assign mail to PBTA" {{ $data->template_for ==  "Bookingassigntopbt" ? "selected" : "" }}>  Bookingassigntopbt </option>
                    <option value="Order Payment Failed" {{ $data->template_for ==  "PAYMENTFAILE" ? "selected" : "" }}>  Order Payment Failed </option>
                    <option value="Order Success" {{ $data->template_for ==  "ORDERED" ? "selected" : "" }}>   Order Success</option>
                    <option value="Order Dispatch" {{ $data->template_for ==  "DISPATCH" ? "selected" : "" }}>  Order Dispatch</option>
                    <option value="Order On The Way" {{ $data->template_for ==  "ONTHEWAY" ? "selected" : "" }}>  Order On The Way</option>
                    <option value="Order Delivery" {{ $data->template_for == " DELIVERED" ? "selected" : "" }}>  Order Delivery</option>
                    <option value="Order Cancel" {{ $data->template_for ==  "CANCEL" ? "selected" : "" }}>  Order Cancel</option>
                    <option value="Order Refund" {{ $data->template_for ==  "REFUNDED" ? "selected" : "" }}>  Order Refund</option>
                    <option value="Booking Payment Failed" {{ $data->template_for ==  "PaymentFailed" ? "selected" : "" }}>  Booking Payment Failed </option>
                    <option value="Booking Success" {{ $data->template_for ==  "Booked" ? "selected" : "" }}>  Booking Success </option>
                    <option value="Booking Assigned to PBTLA" {{ $data->template_for ==  "Assigned" ? "selected" : "" }}>  Booking Assigned to PBTLA </option>
                    <option value="Booking Accepted by PBTLA" {{ $data->template_for ==  "Accepted" ? "selected" : "" }}>  Booking Accepted by PBTLA</option>
                    <option value="PBTLA On The Way" {{ $data->template_for ==  "OnTheWay" ? "selected" : "" }}>  PBTLA On The Way </option>
                    <option value="Booking Postponed" {{ $data->template_for ==  "Postponed" ? "selected" : "" }}>  Booking Postponed </option>
                    <option value="Booking Cancel" {{ $data->template_for ==  "Cancel" ? "selected" : "" }}>  Booking Cancel </option>
                    <option value="PBTLA Reached On Destination" {{ $data->template_for ==  "Reached" ? "selected" : "" }}>  PBTLA Reached On Destination</option>
                    <option value="Service started by PBTLA" {{ $data->template_for ==  "Start" ? "selected" : "" }}>Service started by PBTLA</option>
                    <option value="Booking Cancel" {{ $data->template_for ==  "Completed" ? "selected" : "" }}>  Booking Complete </option>
                    <option value="Booking Refund" {{ $data->template_for ==  "Refunded" ? "selected" : "" }}>  Booking Refund</option>
                    <option value="Membership Purchase" {{ $data->template_for ==  "Membership" ? "selected" : "" }}>  Membership Purchase  </option>
                  </select>
        <div class="form-group row">
        <label class="col-md-2 col-form-label">Set as Default</label>
            <div class="col-md-8 col-form-label">
                <div class="form-check checkbox mb-2">
                <input class="form-check-input" name="default_status" @if($data->default_status==1) checked   @endif id="default_status"  type="checkbox" value="@if($data->default_status==0) 1 @else 0 @endif " >
                <label class="form-check-label" for="default_status"></label>
                </div>
            </div>
        </div>
          <div class="form-group row ">
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <label for="exampleFormControlTextarea1">Html Template</label>
                       <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="html_template">{{$data->html_template}} </textarea>
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
