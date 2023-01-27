@extends('admin::layouts.master')
@section('title') Add Brand @endsection
@section('content')
<div class="main-content">
    <div class="page-title col-sm-12">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3>Create Brand</h3>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('brands.index')}}">Brands</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header"> <strong>Add Brand</strong> 
   <a class="btn btn-sm btn-info float-right ml-5 ml-lg-2 rounded-pill" href="{{ route('brands.index') }}" > <i class="fab fa-delicious"></i> Brands</a>
         <a class="btn btn-sm btn-warning text-white float-right rounded-pill " href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-left"></i> Back </a>
  </div>
        <div class="card-body">
            <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" id="formvalidation">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Brand Name</label>
                            <input class="form-control" id="nf-name" name="name" value="{{ old('name') }}"  minlength="3" maxlength="60" type="text" title="Brand Name" placeholder="Enter Brand Name.." autocomplete="name">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback" style="display:block;">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="name">Brand Image</label>
                            <input type="file" name="brand_logo" id="brand_logo" class="form-control">
                            @if ($errors->has('brand_logo'))
                            <div class="invalid-feedback" style="display:block;">{{ $errors->first('brand_logo') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <img src="{{ asset('images/dummy.png')}}" id="brand_image_cls" width="100" height="100">
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea name="description" class="form-control" minlength="3" maxlength="160" placeholder="Please enter Description...">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                            <div class="invalid-feedback" style="display:block;">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
                    <button class="btn btn-sm btn-danger reset_form" type="reset"> Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(".reset_form").on("click", function () {
            location.reload();
        });

        $("#brand_logo").change(function () {
            ImgReadURL(this);
        });
    });
    function ImgReadURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#brand_image_cls').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script >
   $(function() {
         $("#formvalidation").validate({
         rules: {
           name: {
             required: true,
           },
           brand_logo: {
             required: true,
           },
           description: {
             required: true,
           }

         },

         messages: {
           name: {
             required: "Brand name is a required field !"
           },
           brand_logo: {
             required: "Brand logo is a required field !"
           },
           description: {
             required: "Description is a Required field !"
           }
         }
      });
   });
</script>

</script>
@endsection


