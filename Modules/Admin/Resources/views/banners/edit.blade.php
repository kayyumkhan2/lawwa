@extends('admin::layouts.master')
@section('title') Edit Brand @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1>Edit Banner</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                 <li class="breadcrumb-item"><a href="{{route('banners.index')}}">Banners</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Banner</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
 <div class="card-header"> 
<div class="d-flex justify-content-between">
   {{$Homepagebanner->title}}
      <div>
                           <a class="btn btn-sm btn-warning text-white rounded-pill" href="javascript:history.go(-1)"> Back</a>
 <a class="btn btn-sm btn-info rounded-pill " href="{{ route('banners.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Banners</a>
      </div>
 </div>

</div>
   <div class="card-body">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
         <strong>Whoops!</strong> There were some problems with your input.<br>
         <br>
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <form action="{{ route('banners.update', $Homepagebanner->id) }}" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}
         <input name="_method" type="hidden" value="PATCH">
         <div class="form-group">
            <label for="nf-name">Title</label>
            <input class="form-control" value="{{$Homepagebanner->title}}" id="nf-title" name="title" type="text" title="nf-title"
               placeholder="Enter page title.." autocomplete="title">
         </div>

      <div class="form-group">
          <input type="file" name="banner" id="exampleInputImage" class="form-control image {{ $errors->has('banner') ? ' is-invalid' : '' }}" >
          <img src="{{ asset('public/images/banner_images/'.$Homepagebanner->banner) }}" id="previewimage" class="mt-2">

         </div>


         
   </div>
   <div class="card-footer">
   <button class="btn btn-sm btn-primary" type="submit">Save</button>
   <!-- <button class="btn btn-sm btn-danger" type="reset"> Reset</button> -->
   </div> </form>
</div>
@endsection
@section('js')
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
@endsection

