@extends('admin::layouts.master')
@section('title') {{ucfirst($pagename)}} @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h4 m-0">
         {{ucfirst($pagename)}}</h4>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">{{$pagename}}</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <strong>Fill {{$pagename}} Page Content</strong>
      <a class="btn btn-sm btn-danger float-right rounded-pill ml-5 ml-lg-2" href="{{ route('admin.pages') }}" > <i class="fas fa-file-alt"></i> Pages</a>
      <a class="btn btn-sm btn-primary rounded-pill text-white float-right " href="{{ route('admin.page.update','academy-courses') }}"> <i class="fas fa-arrow-circle-right"></i> Academy Courses</a>
      <a class="btn btn-sm btn-primary rounded-pill text-white float-right " href="{{ route('admin.page.update','academy-facilities') }}"> <i class="fas fa-arrow-circle-right"></i> Academy Facilities</a>
      <a class="btn btn-sm btn-primary rounded-pill text-white float-right " href="{{ route('admin.page.update','certificates') }}"> <i class="fas fa-arrow-circle-right"></i> Certificates</a>
   </div>
   <div class="card-body">
      <form action="{{ route('admin.pages.academy-update',1) }}" method="POST" id="formid" enctype="multipart/form-data" name="formid">
         {{ csrf_field() }}
         <div class="form-group">
            <label for="nf-name">Section 1 Heading</label>
            <textarea class="form-control" autocomplete="random"  id="section_1_heading" name="section_1_heading">@if($updatedata!=''){{$updatedata->section_1_heading}}@endif</textarea>
            @if ($errors->has('section_1_heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_1_heading') }}.</strong> 
            </span>
            @endif 
         </div>

         <div class="form-group">
            <label for="nf-name">Section 1 Content</label>
            <textarea class="form-control" autocomplete="random"  id="section_1_content" name="section_1_content">@if($updatedata!=''){{$updatedata->section_1_content}}@endif</textarea>
            @if ($errors->has('section_1_content'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_1_content') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group row">
            <div class="col-md-8">
            <label for="nf-name">Section 1 Image</label>
            <input type="file" name="section_1_image" class="form-control">
            @if ($errors->has('section_1_image'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_1_image') }}.</strong> 
            </span>
            @endif
            </div>
            @if($updatedata!='') 
            <div class="col-md-4">
            <label></label>
            <img src="{{asset('images/frontpages/academy/'.$updatedata->section_1_image)}}" class="img-thumbnail" width="80">
            </div>
            @endif
         </div>
         <div class="form-group">
            <label for="nf-name">Section 2 Heading</label>
            <textarea class="form-control" autocomplete="random"  id="section_2_heading" name="section_2_heading">@if($updatedata!=''){{$updatedata->section_2_heading}}@endif</textarea>
            @if ($errors->has('section_2_heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_2_heading') }}.</strong> 
            </span>
            @endif 
         </div>

         <div class="form-group">
            <label for="nf-name">Section 2 Content</label>
            <textarea class="form-control" autocomplete="random"  id="section_2_content" name="section_2_content">@if($updatedata!=''){{$updatedata->section_2_content}}@endif</textarea>
            @if ($errors->has('section_2_content'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_2_content') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Section 3 Heading</label>
            <textarea class="form-control" autocomplete="random"  id="section_1_heading" name="section_3_heading">@if($updatedata!=''){{$updatedata->section_3_heading}}@endif</textarea>
            @if ($errors->has('section_3_heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_3_heading') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Section 3 Content</label>
            <textarea class="form-control" autocomplete="random"  id="section_3_content" name="section_3_content">@if($updatedata!=''){{$updatedata->section_3_content}}@endif</textarea>
            @if ($errors->has('section_3_content'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_3_content') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Section 4 Heading</label>
            <textarea class="form-control" autocomplete="random"  id="section_1_heading" name="section_4_heading">@if($updatedata!=''){{$updatedata->section_4_heading}}@endif</textarea>
            @if ($errors->has('section_4_heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_4_heading') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Section 4 Content</label>
            <textarea class="form-control" autocomplete="random"  id="section_4_content" name="section_4_content">@if($updatedata!=''){{$updatedata->section_4_content}}@endif</textarea>
            @if ($errors->has('section_4_content'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_4_content') }}.</strong> 
            </span>
            @endif 
         </div>

   </div>
   <div class="card-footer">
   <button class="btn btn-sm btn-primary" type="submit">Save</button>
   <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
   </div> 
</form>
</div>
@jquery
@toastr_js
@toastr_render
@endsection
@section('js')
<!-- <script type="text/javascript">
   CKEDITOR.replace('section_1_heading',{
      //uiColor: '#D83968',
      toolbar: [
      ['Bold', 'Italic','Format','Font','FontSize','PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley','colors']],
      height:['60px']
      }); 
</script> -->
<script type="text/javascript">
   CKEDITOR.replace('section_1_content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   height:['150px']

   }); 
</script>
<!-- <script type="text/javascript">
   CKEDITOR.replace('section_2_heading',{
      //uiColor: '#D83968',
      toolbar: [
      ['Bold', 'Italic','Format','Font','FontSize','PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley','colors']],
      height:['60px']
      }); 
</script> -->
<script type="text/javascript">
   CKEDITOR.replace('section_2_content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   height:['150px']

   }); 
</script>
<!-- <script type="text/javascript">
   CKEDITOR.replace('section_3_heading',{
      //uiColor: '#D83968',
      toolbar: [
      ['Bold', 'Italic','Format','Font','FontSize','PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley','colors']],
      height:['60px']
      }); 
</script> -->
<script type="text/javascript">
   CKEDITOR.replace('section_3_content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   height:['150px']

   }); 
</script>
<!-- <script type="text/javascript">
   CKEDITOR.replace('section_4_heading',{
      //uiColor: '#D83968',
      toolbar: [
      ['Bold', 'Italic','Format','Font','FontSize','PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley','colors']],
      height:['60px']
      }); 
</script> -->
<script type="text/javascript">
   CKEDITOR.replace('section_4_content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   height:['150px']

   }); 
</script>
@endsection
