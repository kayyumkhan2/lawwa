@extends('admin::layouts.master')
@section('title') Send Notifications  @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h4>Send notifications for @if($type==0) Beauticians @elseif($type==1)Customers @else All @endif </h4>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('notifications.index')}}">Notifications</a></li>
               <li class="breadcrumb-item active" aria-current="page">Send notifications</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <strong>Fill Notification Details</strong>
      <a class="btn btn-sm btn-info float-right ml-5 ml-lg-2 rounded-pill" href="{{ route('notifications.index') }}"> <i class="fas fa-paper-plane"></i> Notifications</a>
      <a class="btn btn-sm btn-warning text-white float-right rounded-pill " href="javascript:history.go(-1)"> <i class="fas fa-arrow-circle-left"></i>  Back </a>
   </div>
   <div class="card-body">
      <form action="{{ route('notifications.store') }}" method="POST" id="formid" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="form-group">
            <label for="nf-name">From : </label>
            <input class="form-control " value="{{env('MAIL_USERNAME')}}" disabled="" id="nf-title" name="from" type="text" 
               placeholder="Enter mail From...." autocomplete="title">
         </div>
         <div class="form-group row ">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <label for="emp-id" class="form-input-label"> To :  </label>
               <select   class="selectpicker form-control" data-live-search="true" name="users[]" data-actions-box="true"  multiple="multiple">
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->full_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('users'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('users') }}.</strong> 
               </span>
               @endif
            </div>
         </div>
         <div class="form-group">
            <label for="nf-name">Subject : </label>
            <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" maxlength="100" autocomplete="random" value="{{ old('title') }}"  id="nf-title" name="title" type="text" 
               placeholder="Enter mail subject.." autocomplete="title">
            @if ($errors->has('title'))
            <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('title') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Attachment : </label>
            <input class="form-control {{ $errors->has('attachment') ? ' is-invalid' : '' }}" maxlength="100" autocomplete="random" value="{{ old('attachment') }}"  id="nf-title" name="attachment" type="file" 
               placeholder="Enter mail subject.." autocomplete="attachment">
            @if ($errors->has('attachment'))
            <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('attachment') }}.</strong> 
            </span>
            @endif 
         </div>
         <label for="nf-name">Description</label>
         <textarea class="form-control" autocomplete="random" required="" id="description" name="description">{{ old('description') }}</textarea>
         @if ($errors->has('description'))
         <span class="invalid feedback" role="alert"> 
             <strong class="text-danger">{{ $errors->first('description') }}.</strong> 
         </span>
         @endif 
   </div>
   <div class="card-footer">
       <button class="btn btn-sm btn-primary" type="submit">Save</button>
       <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
   </div> 
</form>
</div>
@endsection
@section('csslink') 
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endsection
@section('js')
<script >
   $(document).ready(function(){
     $("#formid").validate(
     {
         ignore: [],
        debug: false,
        rules: { 
         description: {
              required: true,
             },
         title: {
             required: true,
             },
         "users[]": {
             required: true,
             },
         },
     });
   });
</script>
<script type="text/javascript">
   CKEDITOR.replace('description',{
   // toolbar: [
   // ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   // height:['160px']
   
   }); 
</script>
<script type="text/javascript">
   $('#to').select2();
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endsection
