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
      <a class="btn btn-sm btn-info float-right rounded-pill ml-5 ml-lg-2" href="{{ route('settings.contactussettings.address') }}" > <i class="fas fa-file-alt"></i> {{$pagename}}</a>
      <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"> <i class="fas fa-arrow-circle-left"></i> Back</a>
   </div>
   <div class="card-body">
      <form action="{{ route('admin.pages.about-us.update',1) }}" method="POST" id="formid" enctype="multipart/form-data" name="formid">
         {{ csrf_field() }}
         <div class="form-group">
            <label for="nf-name">Section 1 Heading</label>
            <textarea class="form-control" autocomplete="random"  id="section_1_heading" name="section_1_heading">@if($updatedata!=''){{old('section_1_heading', $updatedata->section_1_heading)}} @else {{old('section_1_heading')}} @endif</textarea>
            @if ($errors->has('section_1_heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_1_heading') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Section 1 Content</label>
            <textarea class="form-control" autocomplete="random"  id="section_1_content" name="section_1_content">@if($updatedata!=''){{old('section_1_content', $updatedata->section_1_content)}} @else {{old('section_1_content')}}@endif</textarea>
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
               <img src="{{asset('images/frontpages/aboutusimages/'.$updatedata->section_1_image)}}" class="img-thumbnail" width="80" onerror="this.src='/images/frontpages/aboutusimages/dummyimglawwa.jpg'">
            </div>
            @endif
         </div>
         <div class="form-group">
            <label for="nf-name">Section 2 Heading</label>
            <textarea class="form-control" autocomplete="random"  id="section_2_heading" name="section_2_heading">@if($updatedata!=''){{old('section_2_heading', $updatedata->section_2_heading)}} @else {{old('section_2_heading')}}@endif</textarea>
            @if ($errors->has('section_2_heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_2_heading') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Section 2 content</label>
            <textarea class="form-control" autocomplete="random"  id="section_2_content" name="section_2_content">@if($updatedata!=''){{old('section_2_content', $updatedata->section_2_content)}} @else {{old('section_2_content')}}@endif</textarea>
            @if ($errors->has('section_2_content'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_2_content') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group row">
            <div class="col-md-8">
               <label for="nf-name">Section 2 image 1</label>
               <input type="file" name="section_2_image_1" class="form-control">
               @if ($errors->has('section_2_image_1'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('section_2_image_1') }}.</strong> 
               </span>
               @endif
            </div>
            @if($updatedata!='')  
            <div class="col-md-2">
               <label></label>
               <img src="{{asset('images/frontpages/aboutusimages/'.$updatedata->section_2_image_1)}}" class="img-thumbnail" width="80" onerror="this.src='/images/frontpages/aboutusimages/dummyimglawwa.jpg'">
            </div>
            @endif 
           {{-- <div class="col-md-4">
               <label for="nf-name">Section 2 image 2</label>
               <input type="file" name="section_2_image_2" class="form-control">
               @if ($errors->has('section_2_image_2'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('section_2_image_2') }}.</strong> 
               </span>
               @endif
            </div>
            @if($updatedata!='')  
            <div class="col-md-2">
               <label></label>
               <img src="{{asset('images/frontpages/aboutusimages/'.$updatedata->section_2_image_2)}}" class="img-thumbnail" width="80" onerror="this.src='/images/frontpages/aboutusimages/dummyimglawwa.jpg'">
            </div>
            @endif --}}
         </div>
        {{-- <div class="form-group row">
            <div class="col-md-4">
               <label for="nf-name">Section 2 image 3</label>
               <input type="file" name="section_2_image_3" class="form-control">
               @if ($errors->has('section_2_image_3'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('section_2_image_3') }}.</strong> 
               </span>
               @endif
            </div>
            @if($updatedata!='') 
            <div class="col-md-2">
               <label></label>
               <img src="{{asset('images/frontpages/aboutusimages/'.$updatedata->section_2_image_3)}}" class="img-thumbnail" width="80" onerror="this.src='/images/frontpages/aboutusimages/dummyimglawwa.jpg'">
            </div>
            @endif 
            <div class="col-md-4">
               <label for="nf-name">Section 2 image 4</label>
               <input type="file" name="section_2_image_4" class="form-control">
               @if ($errors->has('section_2_image_4'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('section_2_image_4') }}.</strong> 
               </span>
               @endif
            </div>
            @if($updatedata!='') 
            <div class="col-md-2">
               <label></label>
               <img src="{{asset('images/frontpages/aboutusimages/'.$updatedata->section_2_image_4)}}" class="img-thumbnail" width="80" onerror="this.src='/images/frontpages/aboutusimages/dummyimglawwa.jpg'">
            </div>
            @endif 
         </div>--}}
         <div class="form-group">
            <label for="nf-name">Section 3 heading</label>
            <textarea class="form-control" autocomplete="random"  id="section_3_heading" name="section_3_heading">@if($updatedata!=''){{old('section_3_heading', $updatedata->section_3_heading)}} @else {{old('section_3_heading')}}@endif</textarea>
            @if ($errors->has('section_3_heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_3_heading') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Section 3 content</label>
            <textarea class="form-control" autocomplete="random"  id="section_3_content" name="section_3_content">@if($updatedata!=''){{old('section_3_content', $updatedata->section_3_content)}} @else {{old('section_3_content')}}@endif</textarea>
            @if ($errors->has('section_3_content'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_3_content') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group row">
            <div class="col-md-8">
               <label for="nf-name">Section 3 image</label>
               <input type="file" name="section_3_image" class="form-control">
               @if ($errors->has('section_3_image'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('section_3_image') }}.</strong> 
               </span>
               @endif
            </div>
            @if($updatedata!='') 
            <div class="col-md-4">
               <img src="{{asset('images/frontpages/aboutusimages/'.$updatedata->section_3_image)}}" class="img-thumbnail" width="80" onerror="this.src='/images/frontpages/aboutusimages/dummyimglawwa.jpg'">
            </div>
            @endif
         </div>
         <div class="form-group">
            <label for="nf-name">Section 4 heading</label>
            <textarea class="form-control" autocomplete="random"  id="section_4_heading" name="section_4_heading">@if($updatedata!=''){{old('section_4_heading', $updatedata->section_4_heading)}} @else {{old('section_4_heading')}}@endif</textarea>
            @if ($errors->has('section_4_heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_4_heading') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Section 4 content</label>
            <textarea class="form-control" autocomplete="random"  id="section_4_content" name="section_4_content">@if($updatedata!=''){{old('section_4_content', $updatedata->section_4_content)}} @else {{old('section_4_content')}}@endif</textarea>
            @if ($errors->has('section_4_content'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_4_content') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group row">
            <div class="col-md-8">
               <label for="nf-name">Section 4 image</label>
               <input type="file" name="section_4_image" class="form-control">
               @if ($errors->has('section_4_image'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('section_4_image') }}.</strong> 
               </span>
               @endif
            </div>
            @if($updatedata!='') 
            <div class="col-md-4">
               <img src="{{asset('images/frontpages/aboutusimages/'.$updatedata->section_4_image)}}" class="img-thumbnail" width="80" onerror="this.src='/images/frontpages/aboutusimages/dummyimglawwa.jpg'">
            </div>
            @endif
         </div>
         <div class="form-group">
            <label for="nf-name">Section 5 heading</label>
            <textarea class="form-control" autocomplete="random"  id="section_5_heading" name="section_5_heading">@if($updatedata!=''){{old('section_5_heading', $updatedata->section_5_heading)}} @else {{old('section_5_heading')}}@endif</textarea>
            @if ($errors->has('section_5_heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_5_heading') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
            <label for="nf-name">Section 5 content</label>
            <textarea class="form-control" autocomplete="random"  id="section_5_content" name="section_5_content">@if($updatedata!=''){{old('section_5_content', $updatedata->section_5_content)}} @else {{old('section_5_content')}}@endif</textarea>
            @if ($errors->has('section_5_content'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('section_5_content') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group row">
            <div class="col-md-8">
               <label for="nf-name">Section 5 image</label>
               <input type="file" name="section_5_image" class="form-control">
               @if ($errors->has('section_5_image'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('section_5_image') }}.</strong> 
               </span>
               @endif
            </div>
            @if($updatedata!='') 
            <div class="col-md-4">
               <img src="{{asset('images/frontpages/aboutusimages/'.$updatedata->section_5_image)}}" class="img-thumbnail" width="80" onerror="this.src='/images/frontpages/aboutusimages/dummyimglawwa.jpg'">
            </div>
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
<script type="text/javascript">
   CKEDITOR.replace('section_1_heading',{
      //uiColor: '#D83968',
      toolbar: [
      ['Bold', 'Italic','Format','Font','FontSize','PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley','colors']],
      height:['60px']
      }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('section_2_heading',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   height:['60px']
   
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('section_3_heading',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   height:['60px']
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('section_4_heading',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   height:['60px']
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('section_5_heading',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   height:['60px']
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('section_1_content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('section_2_content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('section_3_content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('section_4_content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   }); 
</script>
<script type="text/javascript">
   CKEDITOR.replace('section_5_content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
   }); 
</script>
@endsection
