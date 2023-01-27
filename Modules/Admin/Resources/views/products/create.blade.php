@extends('admin::layouts.master')
@section('title') Product add @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h3>Add Product</h3>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Product</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
@if ($errors->any())
        @foreach ($errors->all() as $error)
          <div class="alert alert-danger">
        {{ $error }}
           </div>
        @endforeach
@endif
<div class="card">
   <div class="card-header">
      <!-- <strong class="add-product">Add Product</strong> -->
      <a class="btn btn-sm btn-info float-right ml-5 ml-lg-2" href="{{ route('products.index') }}" >Products</a>
      <a class="btn btn-sm btn-warning text-white float-right " href="{{ URL::previous() }}">Back</a>
   </div>
   <div class="card-body">
      <form  id="formid" class="uploader" action="{{ route('products.store') }}"  method="POST" enctype="multipart/form-data">
         @csrf
           <div class="form-row">
            <div class="col">
              <label class="starlabel">Product Name </label>
              <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : ' ' }}"  autocomplete="random" value="{{ old('name') }}"  placeholder="Enter product name">
              @if ($errors->has('name'))
                  <span class="invalid feedback" role="alert"> 
                     <strong class="text-danger">{{ $errors->first('name') }}.</strong> 
                  </span>
              @endif  
           </div>
         </div>
         <div class="form-row  mt-4 " >
            <div class="col-md-4">
                  <label class="starlabel">Price </label>
                  <input type="number" name="price" min="1"   value="{{ old('price') }}" class="form-control form {{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Enter price">
                  @if ($errors->has('price'))
                    <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('price') }}.</strong> 
                    </span>
                  @endif  
            </div>
            <div class="col-md-4">
                  <label class="starlabel">Sale Price </label>
                  <input type="number" name="sale_price" min="1"   value="{{ old('sale_price') }}" class="form-control form {{ $errors->has('sale_price') ? ' is-invalid' : '' }}" placeholder="Enter sale price">
                  @if ($errors->has('sale_price'))
                      <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('sale_price') }}.</strong> 
                      </span>
                  @endif  
            </div>
            <div class="col-md-4">
                  <label class="starlabel">Member Price </label>
                  <input type="number" name="member_price" min="1"  value="{{ old('member_price') }}" class="form-control form {{ $errors->has('member_price') ? ' is-invalid' : '' }}" placeholder="Enter sale price">
                  @if ($errors->has('member_price'))
                      <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('member_price') }}.</strong> 
                      </span>
                  @endif  
            </div>
        </div>
        

        <div class="form-row mt-4">
            <label class="col-form-label">Product Type</label>
                <select class="form-control" id="product_type" name="product_type">
                    <option value="Simple" <?php echo (old('product_type') == 'Simple') ? 'selected="selected"' : ""; ?> >Simple</option>
                    <option value="Variable" <?php echo (old('product_type') == 'Variable') ? 'selected="selected"' : ""; ?>>Variable</option>
                </select>
            @if ($errors->has('product_type'))
                <div class="invalid-feedback" style="display:block;">{{ $errors->first('product_type') }}</div>
            @endif
        </div>
         <div class="form-row unit mt-4 ">
            <div class="col">
                <label >Unit</label>
                <input type="number" name="unit" min="1" value="{{ old('unit') }}" class="form-control form {{ $errors->has('unit') ? ' is-invalid' : '' }}" placeholder="Enter product unit">
                @if ($errors->has('unit'))
                    <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('unit') }}.</strong> 
                    </span>
                @endif
            </div>
            <div class="col">
                <label>Unit Type</label>
                 <select name="unit_type"  class="form-control"  style="width: 100%;" >
                      <option value="" selected=""> Select unit </option>
                      <option value="cm">Centimeter (Cm) </option>
                      <option value="mm">Millimeters (Mm) </option>
                      <option value="km">Kilometer (Km)</option>
                      <option value="m">Meters (M)</option>
                      <option value="kg">Kilogram (Kg)</option>
                      <option value="g">Gram (G)</option>
                      <option value="L">Litre (L)</option>
                      <option value="ML">Millilitre (ML)</option>
                 </select>
            </div>
        </div>
        <div class="form-row unit mt-4 "> 
         <div class="col-xs-6 col-sm-6 col-md-6" >
             <label class="col-form-label" >Size   </label>
             <select name="size[]"  class="form-control attribute_id"  multiple="multiple" style="width: 100%;" >
                  <option value="S">(S) Small</option>
                  <option value="M">(M) Medium  </option>
                  <option value="L"> (L) Large </option>
                  <option value="XL">(XL) Extra Large</option>
                  <option value="XXL">(XXL)Extra Large</option>
             </select>
            <div class="attribute_error" style="color: red;"></div>    
              @if ($errors->has('attributes'))
                 <span class="invalid feedback" role="alert"> 
                      <strong class="text-danger">{{ $errors->first('attributes') }}.</strong> 
                 </span>
             @endif  
            </div> 
            <div class="col-xs-6 col-sm-6 col-md-6" >
                 <label class="col-form-label" >Color  </label>
                 <select name="color[]"  class="form-control attribute_id"  multiple="multiple" style="width: 100%;" >
                    <option value="White">White</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Blue">Blue</option>
                    <option value="Red">Red</option>
                    <option value="Green">Green</option>
                    <option value="Black">Black</option>
                    <option value="Brown">Brown</option>
                    <option value="Azure">Azure</option>
                    <option value="Ivory">Ivory</option>
                    <option value="Teal">Teal</option>
                    <option value="Silver">Silver</option>
                    <option value="Purple">Purple</option>
                    <option value="Navy blue">Navy blue</option>
                    <option value="Pea green">Pea green</option>
                    <option value="Gray">Gray</option>
                    <option value="Orange">Orange</option>
                    <option value="Maroon">Maroon</option>
                    <option value="Charcoal">Charcoal</option>
                    <option value="Aquamarine">Aquamarine</option>
                    <option value="Coral">Coral</option>
                    <option value="Fuchsia">Fuchsia</option>
                    <option value="Wheat">Wheat</option>
                    <option value="Lime">Lime</option>
                    <option value="Crimson">Crimson</option>
                    <option value="Khaki">Khaki</option>
                    <option value="Hot pink">Hot pink</option>
                    <option value="Magenta">Magenta</option>
                    <option value="Olden">Olden</option>
                    <option value="Plum">Plum</option>
                    <option value="Olive">Olive</option>
                    <option value="Cyan">Cyan</option>
                </select>
                <div class="attribute_error" style="color: red;"></div>    
                  @if ($errors->has('attributes'))
                     <span class="invalid feedback" role="alert"> 
                          <strong class="text-danger">{{ $errors->first('attributes') }}.</strong> 
                     </span>
                 @endif  
            </div>
        </div> 
        <div class="form-row mt-4">
            <div class="col-xs-12 col-sm-12 col-md-12" >
               <label class="col-form-label starlabel" >Product Categories :  </label>
               <select name="category[]"  class="form-control category" id="category">
                  @foreach($categories as $category)
                    <option value="{{$category->id}}"  data-show="parent">{{ucfirst($category->name)}}</option>
                  @endforeach    
               </select>
                @if ($errors->has('category'))
               <span class="invalid feedback" role="alert"> 
                    <strong class="text-danger">{{ $errors->first('category') }}.</strong> 
               </span>
               @endif  
            </div>
        </div>
        <div class="form-row mt-4">
            <div class="col">
               <label class="form-col-form-label starlabel" >Product Thumbnail  </label>
               <input type="file" id="file-input" class="form-control file-input {{ $errors->has('product_thumbnail') ? ' is-invalid' : '' }}" multiple name="product_thumbnail" >
               @if ($errors->has('product_thumbnail'))
               <span class="invalid feedback" role="alert"> 
                    <strong class="text-danger">{{ $errors->first('product_thumbnail') }}.</strong> 
               </span>
               @endif  
            </div>
            <div class="col">
               <label class="form-col-form-label starlabel" >Select Images  </label>
               <input type="file" id="file-input" class="form-control file-input {{ $errors->has('image') ? ' is-invalid' : '' }}" multiple name="image[]" >
               @if ($errors->has('image'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('image') }}.</strong> 
               </span>
               @endif  
            </div>
        </div>
         <div class="form-group mt-4">
            <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group"><label class="starlabel">Description : </label><textarea class="form-control" style="height:150px" name="description"   placeholder="Description" >{{ old('description') }}</textarea>
               @if ($errors->has('description'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('description') }}.</strong> 
               </span>
               @endif 
            </div>
          </div>
      </div>
         </div>
        </div>
       <div class="card-footer">
           <button class="btn btn-sm btn-primary" type="submit" id="save">Save</button>
           <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
       </div>
    </form>
</div>
@endsection
@section('js')
<script type="text/javascript">
        $(document).on("click", "#save", function(e) {
        $(".product_type").remove(); 
        var count = $(".attribute_id :selected").length;
        if (count =='1' ) {
                var product_type = jQuery("#product_type").val();
                if (product_type !="Simple") {
                    e.preventDefault();
                    $('.attribute_error').text("Please select at least one attribute");
                }
            }
            else{
                $('.attribute_error').text(""); 
            }
    });
</script>  
<script type="text/javascript">
$(function() {
  ignore: [],
      $("#formid").validate({
      rules: {
         'attribute[]': {
            required: function(element) {
                if ($('#product_type').val()== "Variable") {
                    return true;
                } else {
                    return false;
                }
            }
        },
        name: {
          required: true,
        },
        price: {
          required: true,
        },
        product_type: {
          required: true,
        },
        sale_price: {
          required: true,
        },
        member_price: {
          required: true,
        },
        stock: {
          required: true,
        },
        description: {
          required: true,
        },
        'category[]': {
         required: true
        },
        'image[]': {
         required: true,
         accept: "jpg|jpeg|png|ico|bmp"
        },
        product_thumbnail: {
         required: true,
         accept: "jpg|jpeg|png|ico|bmp"
        }
      },
    });
});
</script>
<script>
    CKEDITOR.replace('description');
    $(document).ready(function () {
        var product_type = jQuery("#product_type").val();
        if (product_type == 'Simple') {
            jQuery(".price_section").hide();
            jQuery(".unit").hide();

        }
        jQuery("#product_type").on("change", function () {
            var product_type = jQuery("#product_type").val();
            if (product_type == "Simple") {
                jQuery(".unit").hide();
            } else {
                jQuery(".unit").show();
            }
        });
        $(document).on("keyup", "#sale_price", function () {
            var price = $('#price').val();
            var sale_price = $('#sale_price').val();

            if (parseInt(sale_price) >= parseInt(price)) {
                $("#sale_price_span").show();
                $('#sale_price_span').html('<label for="user_name" class="error sale_price_error">Sale price should be not greater than to product price</label>');
            } else {
                $("#sale_price_span").hide();
            }
        });

        $(".reset_form").on("click", function () {
            location.reload();
        });
        $('.attribute_id').select2();
        $("#product_image").change(function () {
            proImgReadURL(this);
        });

        var i = 1;
        //     $(document).on("click", ".unit", function() {
        //     var row = '<div class="form-row"><div class="col"> <label class=""></label> <input type="number" name="units[]" placeholder="Unit" class="form-control"></div><div class="col"><label class=""> </label><input type="number" name="unit_price[]"  value="{{ old('price') }}" class="form-control form {{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Price"></div><div class="col"><label class=""> </label><input type="number" name="unit_sale_price[]"  value="{{ old('unit_sale_price') }}" class="form-control form {{ $errors->has('unit_sale_price') ? ' is-invalid' : '' }}" placeholder="Sale price">@if ($errors->has('unit_sale_price'))<span class="invalid feedback" role="alert"><strong class="text-danger">{{ $errors->first('unit_sale_price') }}.</strong> </span>@endif</div><div class="col"><label class=""> </label><input type="number" name="unit_member_price[]"  value="{{ old('unit_member_price') }}" class="form-control form {{ $errors->has('unit_member_price') ? ' is-invalid' : '' }}" placeholder="Sale price"></div><a href="javascript:void(0);" class="remove_row mt-4 btn btn-danger"><i class="fas fa-minus-square" style="font-size: 18px;"></i></a></div>';
        //     i++; 
        //     jQuery(this).after(row);
        // });

        jQuery(document).on("click", ".remove_row", function () {
            var tr = jQuery(this).closest('div');
            tr.remove();
            i--;
        });
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
                    if (height < 175 || width < 225) {
                        swal("Error deleting!", "Height and Width must be 225*175.", "error");
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
@endsection 
