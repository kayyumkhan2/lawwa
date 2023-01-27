@extends('admin::layouts.master')
@section('title') Add Banner @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h4>Create banner</h4>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Create Banner</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header"><strong>Fill Content</strong>    <a class="btn btn-sm btn-info float-right  rounded-pill ml-5 ml-lg-2" href="{{ route('banners.index') }}" >Banners</a>
      <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a>
   </div>
   <div class="card-body">
      <form action="{{ route('banners.store') }}" id="formid" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="form-group">
            <label for="nf-name" >Title</label>
            <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  id="nf-title" name="title" type="text" placeholder="Enter page title.." value="{{ old('title') }}"    autocomplete="title">
            @if ($errors->has('title'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('title') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group ">
            <label for="exampleInputImage" class="starlabel">Image </label>
            <input type="file" name="banner" id="exampleInputImage" class="form-control image {{ $errors->has('banner') ? ' is-invalid' : '' }}" >
            <input type="hidden" name="x1" value="" />
            <input type="hidden" name="y1" value="" />
            <input type="hidden" name="w" value="" />
            <input type="hidden" name="h" value="" />
            @if ($errors->has('banner')) 
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('banner') }}.</strong> 
            </span> 
            @endif 
         </div>
         <div class="row mt-5">
            <p><img id="previewimage" style="display:none; " ></p>
            @if(session('path'))
            <img src="{{ session('path') }}" />
            @endif
         </div>
   </div>
   <div class="card-footer">
   <button class="btn btn-sm btn-primary" type="submit" id="submit">Save</button>
   <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
   </div> </form>
</div>
@jquery
@toastr_js
@toastr_render
@endsection
@section('js')
<script type="text/javascript">
   $('#croptarget').imgAreaSelect({
       aspectRatio: "1:1",
       handles: true,
       fadeSpeed: 200,
       onSelectChange: preview
   });
   
</script>
<script>
   jQuery(function($) {
       var p = $("#previewimage");
       $("body").on("change", ".image", function(){
           var imageReader = new FileReader();
           imageReader.readAsDataURL(document.querySelector(".image").files[0]);
           imageReader.onload = function (oFREvent) {
               p.attr('src', oFREvent.target.result).fadeIn();
           };
       });
   });
</script>

<script type="text/javascript">
$(function() {
  ignore: [],
      $("#formid").validate({
      rules: {
         'banner': {
         required: true,
         accept: "jpg|jpeg|png|ico|bmp"
         },
         'title': {
         required: true,
         }
       
      },
      });
});
</script>
@endsection
