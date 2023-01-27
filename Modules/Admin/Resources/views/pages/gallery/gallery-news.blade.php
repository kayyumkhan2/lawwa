@extends('admin::layouts.master')
@section('title') {{$pagename }} @endsection
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
      <strong>Fill {{ucfirst($pagename)}} Details</strong>
      <a class="btn btn-sm btn-info float-right rounded-pill ml-5 ml-lg-2" href="{{ route('admin.page.gallery.pages') }}" > <i class="fas fa-file-alt"></i> Gallery pages</a>
      <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"> <i class="fas fa-arrow-circle-left"></i> Back</a>
   </div>
   <div class="card-body">
      <form action="{{ route('admin.pages.gallery.gallery-news.update',$id) }}" enctype="multipart/form-data" method="POST" id="formid" name="formid">
         {{ csrf_field() }}
         <div class="form-group">
            <label for="nf-heading">Heading </label>
            <input class="form-control {{ $errors->has('heading') ? ' is-invalid' : '' }}"  autocomplete="random" value="@if($updatedata!=''){{old('heading', $updatedata->heading)}} @else {{old('heading')}} @endif"  id="nf-heading" name="heading" type="text" placeholder="Enter {{$pagename}} heading.." autocomplete="heading">
            @if ($errors->has('heading'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('heading') }}.</strong> 
            </span>
            @endif 
         </div>
         <div class="form-group">
         <label for="nf-content">Content</label>
         <textarea class="form-control" autocomplete="random"  id="content" required="" name="content">@if($updatedata!=''){{old('content',$updatedata->content)}}@else{{old('content')}}@endif </textarea>
         @if ($errors->has('content'))
         <span class="invalid feedback" role="alert"> 
         <strong class="text-danger">{{ $errors->first('content') }}.</strong> 
         </span>
         @endif
       </div>
     <div class="form-group row">
            <div class="col-md-8">
            <label for="nf-name">Image</label>
            <input type="file" name="image" class="form-control" @if($updatedata =='') required="" @endif>
            @if ($errors->has('image'))
            <span class="invalid feedback" role="alert"> 
            <strong class="text-danger">{{ $errors->first('image') }}.</strong> 
            </span>
            @endif
            </div> 
            <div class="col-md-4">
            <label></label>
            @if($updatedata!='')
            <img src="{{asset('images/frontpages/gallerynews/'.$updatedata->image)}}" class="img-thumbnail" width="80">
            @endif
            </div> 
         </div>
   <div class="card-footer">
   <button class="btn btn-sm btn-primary" type="submit">Save</button>
   <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
   </div> </form>
</div>
<div class="col-sm-12">
   <div class="row">
      <div class="col-sm-12 mb-4 mt-3">
         <div class="box bg-white">
            <div class="box-row">
               <div class="box-content">
                  <table id="dataTable" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col" class="sr-no">S.No</th>
                           <th scope="col">Heading</th>
                           <th scope="col">Image </th>
                           <th scope="col">Content</th>
                           <th scope="col">Status</th>
                           <th scope="col" class="action">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php  $i=1; @endphp
                        @foreach($data as $value)
                        <tr class="notification{{$value->id}}">
                           <th scope="row" class="sr-no"> {{$i++}}</th>
                           <td>{{$value->heading }}</td>
                           <td><img src="{{asset('images/frontpages/gallerynews/'.$value->image)}}" class="img-thumbnail" width="80"></td>
                           <td> {!! $value->content  !!}</td>
                           <td>
                              <span class="Statuschange badge @if($value->status=='0') badge-danger @else badge badge-success @endif" data-id="{{$value->id}}"  data-model="GalleryNews" id="Statuschange{{$value->id}}">
                              @if($value->status=="0") Deactive @else Active @endif 
                              </span>
                           </td>
                           <td class="action ">
                              <a class="icon-btn edit" href="{{route('admin.page.gallery.pages',['pagename'=>'gallery-news','id'=>$value->id])}}"><i class="fal fa-edit" id="show-edit"></i></a>
                              <a class="icon-btn delete universaldelete" href="javascript:void(0);" data-status="0" data-id="{{ $value->id}}"  data-model="GalleryNews" id="notification{{$value->id}}" > <i class="fal fa-trash-alt" id="delete-btn"></i></a> 
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@jquery
@toastr_js
@toastr_render
@endsection
@section('js')
<script type="text/javascript">
   CKEDITOR.replace('content',{
   toolbar: [
   ['Bold', 'Italic', 'PasteText', 'SpellCheck', 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_CAS','Styles','BGColor','Link','Unlink', 'Smiley']],
         height:['60px']

   }); 
</script>
<script>
   $(document).ready( function () {
    $('#dataTable').DataTable();
   });
   
</script>
<script >
   $(function() {
         $("#formid").validate({
         ignore: [],
         debug: false,
         rules: {
           heading: {
             required: true,
           },
            content:{
               required: function() 
               {
                CKEDITOR.instances.content.updateElement();
               },
            minlength:10
           }
         },
      });
   });
</script>
@endsection
