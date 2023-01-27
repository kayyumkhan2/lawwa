@extends('admin::layouts.master')
@section('title') Home Page Content  @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h4 m-0">
         Home Page Content</h4>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Home page content</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <strong>Fill Home Page Content</strong>
      <a class="btn btn-sm btn-info float-right rounded-pill ml-5 ml-lg-2" href="{{ route('settings.contactussettings.address') }}" > <i class="fas fa-file-alt"></i> Home Page Content</a>
      <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"> <i class="fas fa-arrow-circle-left"></i> Back</a>
   </div>
   <div class="card-body">
      <form action="{{ route('settings.homepagecontent.store',$id) }}" method="POST" id="formid" name="formid" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="form-group">
            <label for="nf-name">About us Text</label>
            <textarea class="form-control" autocomplete="random"  id="about_us_text" name="about_us_text">@if($updatedata!=''){{$updatedata->about_us_text}}@endif</textarea>
            @if ($errors->has('about_us_text'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('about_us_text') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group ">
               <label class="form-col-form-label" >About us image</label>
               <input type="file" id="file-input" class="form-control file-input {{ $errors->has('about_us_image') ? ' is-invalid' : '' }}"  value="{{ old('about_us_image') }}" autofocus multiple name="about_us_image" />
               @if ($errors->has('about_us_image')) <span class="invalid feedback" role="alert"> <strong class="text-danger">{{ $errors->first('about_us_image') }}.</strong> </span> @endif 
         </div>
         @if($updatedata!='')
            <img src="{{asset('images/frontpages/aboutusimages/'.$updatedata->about_us_image)}}" class="img-thumbnail" width="80">
         @endif
         <div class="form-group ">
            <label class="form-col-form-label" >About us video</label>
            <input type="file" id="file-input" class="form-control file-input {{ $errors->has('about_us_video') ? ' is-invalid' : '' }}"  value="{{ old('about_us_video') }}" autofocus multiple name="about_us_video" />
            @if ($errors->has('about_us_video')) <span class="invalid feedback" role="alert"> <strong class="text-danger">{{ $errors->first('about_us_video') }}.</strong> </span> @endif 
         </div>
         @if($updatedata!='')
            <video width="120" height="140" controls>
               <source src="{{asset('images/frontpages/homepagevideos/'.$updatedata->about_us_video)}}" type="video/mp4">
               <source src="{{asset('images/frontpages/homepagevideos/'.$updatedata->about_us_video)}}" type="video/ogg">
               Your browser does not support the video tag.
             </video>
            @endif
         <div class="form-group"> 
            <label for="nf-name">Membership Text</label>
            <textarea class="form-control" autocomplete="random"  id="membership_text" name="membership_text">@if($updatedata!=''){{$updatedata->membership_text}}@endif</textarea>
            @if ($errors->has('membership_text'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('membership_text') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Contact us Text</label>
            <textarea class="form-control" autocomplete="random"  id="contact_us_text" name="contact_us_text">@if($updatedata!=''){{$updatedata->contact_us_text}}@endif</textarea>
            @if ($errors->has('contact_us_text'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('contact_us_text') }}.</strong> 
            </span>
            @endif 
         </div>
   </div>
   <div class="card-footer">
   <button class="btn btn-sm btn-primary" type="submit">Save</button>
   <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
   </div> </form>
</div>
@jquery
@toastr_js
@toastr_render
@endsection
@section('js')
<script type="text/javascript">
   CKEDITOR.replace('about_us_text',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('contact_us_text',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('membership_text',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   }); 
</script>
@endsection
