@extends('admin::layouts.master')
@section('title') Edit Social link  @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h3>Edit Social link</h3>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('sociallinks.index')}}">Social links</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Social link</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
  <div class="card-header">
    <strong>Fill Details</strong>
                    <a class="btn btn-sm btn-info float-right rounded-pill ml-5 ml-lg-2" href="{{ route('sociallinks.index') }}" > <i class="fas fa-share-alt rounded-pill"></i> Social links</a>
                    <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"> <i class="fas fa-arrow-circle-left rounded-pill"></i> Back</a>
            </div>
   <div class="card-body">
      <form action="{{ route('sociallinks.update',$data->id) }}" method="POST" enctype="multipart/form-data" id="formid" name="formid">
         {{ csrf_field() }}
                      {{ method_field('PATCH') }}

         <div class="form-group col-md-8">
            <label for="nf-name">Name</label>
            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" autocomplete="random" value="{{$data->name}}" id="nf-name" name="name" type="text" 
               placeholder="Enter Social Site name.." autocomplete="name">
                @if ($errors->has('name'))
                    <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('name') }}.</strong> 
                    </span>
            @endif 
         </div>
         <div class="form-group col-md-8">
            <label for="nf-title">Title</label>
            <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="random" value="{{$data->title}}"  id="nf-title" name="title" type="text" 
               placeholder="Enter Social Site title.." autocomplete="title">
                @if ($errors->has('title'))
                    <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('title') }}.</strong> 
                    </span>
            @endif 
         </div>
         <div class="form-group col-md-8">
            <label for="nf-url">Link </label>
            <input class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" autocomplete="random" value="{{$data->url}}" id="nf-url" name="url" type="url" 
               placeholder="Enter Social Site link.." autocomplete="url">
                                       <span class="float-right"><a href="{{$data->url}}">Open</a></span>

                @if ($errors->has('url'))
                    <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('url') }}.</strong> 
                    </span>
            @endif 
         </div>
         <div class="form-group row ml-1">
                    <div class="col-md-8">
                        <label class="col-form-label" for="text-input">Icon </label>
                        <input type="file" name="icon" accept=".png, .jpg, .jpeg" id="icon"  class="form-control">
                        <span>Maximum icon size 225*175</span>
                        @if ($errors->has('icon'))
                        <div class="invalid-feedback" style="display:block;">{{ $errors->first('icon') }}</div>
                        @endif
                    </div>

                   <div class="col-md-4">
                     @if(!$data->icon=='')
                        <img src="{{ asset('public/images/sociallinks/'.$data->icon)}}" id="product_image_cls" width="120" height="120">
                    @else
                        <img src="{{ asset('images/dummy.png')}}" id="product_image_cls" width="120" height="120">
                    @endif
                    </div>
                </div>


         
         
        
         </div>
   <div class="card-footer">
   <button class="btn btn-sm btn-primary" type="submit">Save</button>
   <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
   </div> </form>
</div>
@endsection
@section('js')

 <script type="text/javascript">
      $("#icon").change(function () {
            proImgReadURL(this);
        });

    function proImgReadURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if (height > 175 || width > 225) {
                        swal("Error", "Height and Width must not be 225*175.", "error");
                        return false;
                    } else {
                        $('#product_image_cls').attr('src', e.target.result);
                        return true;
                    }
                };
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
   </script>

<script >
  $(document).ready(function(){

            $("#formid").validate(
            {
                ignore: [],
              debug: false,
                rules: { 

                    content:{
                         required: function() 
                        {
                         CKEDITOR.instances.content.updateElement();
                        },

                         minlength:10
                    },
                 name: {
                 required: true,
                        },
                  title: {
                  required: true,
                        },
                
                  url: {
                  required: true,
                        },

                    },
                
            });
        });

</script>

@endsection

