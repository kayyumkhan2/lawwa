@extends('admin::layouts.master')
@section('title') Product Edit @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h3>Edit Product</h3>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
      <strong>Edit Product</strong>
      <a class="btn btn-sm btn-info float-right ml-5 ml-lg-2" href="{{ route('products.index') }}" >Products</a>
      <a class="btn btn-sm btn-warning text-white float-right " href="{{ URL::previous() }}">Back</a>
   </div>
   <div class="card-body">
      <form  id="formid" class="uploader" action="{{ route('products.update',$product->id) }}"  method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
           <div class="form-row">
            <div class="col">
              <label class="starlabel">Product Name </label>
              <input type="text" name="name" value="{{ old('name',$product->name)}}" class="form-control {{ $errors->has('name') ? ' is-invalid' : ' ' }}"   autocomplete="random" placeholder="Enter product name">
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
                  <input type="number" name="price"  value="{{$product->price}}" value="{{ old($product->price,'price') }}" class="form-control form {{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Enter price">
                  @if ($errors->has('price'))
                    <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('price') }}.</strong> 
                    </span>
                  @endif  
            </div>
            <div class="col-md-4">
                  <label class="starlabel">Sale Price </label>
                  <input type="number" name="sale_price" value="{{$product->sale_price}}"  value="{{ old('sale_price') }}" class="form-control form {{ $errors->has('sale_price') ? ' is-invalid' : '' }}" placeholder="Enter sale price">
                  @if ($errors->has('sale_price'))
                      <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('sale_price') }}.</strong> 
                      </span>
                  @endif  
            </div>
            <div class="col-md-4">
                  <label class="starlabel">Member Price </label>
                  <input type="number" name="member_price"  value="{{$product->member_price}}" value="{{ old('member_price') }}" class="form-control form {{ $errors->has('member_price') ? ' is-invalid' : '' }}" placeholder="Enter sale price">
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
                    <option value="Simple" {{$product->product_type == 'Simple' ? 'selected="selected"' : "" }} >Simple</option>
                    <option value="Variable" {{$product->product_type == 'Variable' ? 'selected="selected"' : "" }}>Variable</option>
                </select>
            @if ($errors->has('product_type'))
                <div class="invalid-feedback" style="display:block;">{{ $errors->first('product_type') }}</div>
            @endif
        </div>
         <div class="form-row unit mt-4 ">
            <div class="col">
                <label >Unit</label>
                <input type="number" name="unit"  value="{{$product->unit}}" class="form-control form {{ $errors->has('unit') ? ' is-invalid' : '' }}" placeholder="Enter product unit">
                @if ($errors->has('unit'))
                    <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('unit') }}.</strong> 
                    </span>
                @endif
            </div>
            <div class="col">
                <label>Unit Type</label>
                 <select name="unit_type"  class="form-control"  style="width: 100%;" >
                      <option value="cm" {{$product->unit_type == 'cm' ? 'selected="selected"' : "" }}>Centimeter (Cm) </option>
                      <option value="mm" {{$product->unit_type == 'mm' ? 'selected="selected"' : "" }}>Millimeters (Mm) </option>
                      <option value="km" {{$product->unit_type == 'km' ? 'selected="selected"' : "" }}>Kilometer (Km)</option>
                      <option value="m"  {{$product->unit_type == 'm' ? 'selected="selected"' : "" }}>Meters (M)</option>
                      <option value="kg" {{$product->unit_type == 'kg' ? 'selected="selected"' : "" }}>Kilogram (Kg)</option>
                      <option value="g"  {{$product->unit_type == 'g' ? 'selected="selected"' : "" }}>Gram (G)</option>
                      <option value="L"  {{$product->unit_type == 'L' ? 'selected="selected"' : "" }}>Litre (L)</option>
                      <option value="ML" {{$product->unit_type == 'ML' ? 'selected="selected"' : "" }}>Millilitre (ML)</option>
                 </select>
            </div>
        </div>
        <div class="form-row unit mt-4 "> 
         <div class="col-xs-6 col-sm-6 col-md-6" >
             <label class="col-form-label" >Size   </label>
             <select name="size[]"  class="form-control attribute_id"  multiple="multiple" style="width: 100%;" >
                <option value="S" @if (in_array('S', $product->ProductSize->pluck('size')->toarray())) selected="selected"  @endif >(S) Small</option>
                <option value="M" @if (in_array('M', $product->ProductSize->pluck('size')->toarray())) selected="selected"  @endif >(M) Medium </option>
                <option value="L" @if (in_array('L', $product->ProductSize->pluck('size')->toarray())) selected="selected"  @endif >(L) Large</option>
                <option value="XL" @if (in_array('XL', $product->ProductSize->pluck('size')->toarray())) selected="selected"  @endif >(XL) Extra Large</option>
                <option value="XXL" @if (in_array('XXL', $product->ProductSize->pluck('size')->toarray())) selected="selected"  @endif >(XXL)Extra Large</option>
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
                <option value="White" @if (in_array('White', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif>White</option>
                <option value="Yellow" @if (in_array('Yellow', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif>Yellow</option>
                <option @if (in_array('Blue', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Blue">Blue</option>
                <option @if (in_array('Red', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Red">Red</option>
                <option @if (in_array('Green', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Green">Green</option>
                <option @if (in_array('Black', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Black">Black</option>
                <option @if (in_array('Brown', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Brown">Brown</option>
                <option @if (in_array('Azure', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Azure">Azure</option>
                <option @if (in_array('Ivory', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Ivory">Ivory</option>
                <option @if (in_array('Teal', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Teal">Teal</option>
                <option @if (in_array('Silver', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Silver">Silver</option>
                <option @if (in_array('Purple', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Purple">Purple</option>
                <option @if (in_array('Navy blue', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Navy blue">Navy blue</option>
                <option @if (in_array('Pea green', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Pea green">Pea green</option>
                <option @if (in_array('Gray', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Gray">Gray</option>
                <option @if (in_array('Orange', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Orange">Orange</option>
                <option @if (in_array('Maroon', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Maroon">Maroon</option>
                <option @if (in_array('Charcoal', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Charcoal">Charcoal</option>
                <option @if (in_array('Aquamarine', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Aquamarine">Aquamarine</option>
                <option @if (in_array('Coral', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Coral">Coral</option>
                <option @if (in_array('Fuchsia', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Fuchsia">Fuchsia</option>
                <option @if (in_array('Wheat', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Wheat">Wheat</option>
                <option @if (in_array('Lime', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Lime">Lime</option>
                <option @if (in_array('Crimson', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Crimson">Crimson</option>
                <option @if (in_array('Khaki', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Khaki">Khaki</option>
                <option @if (in_array('Hot pink', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Hot pink">Hot pink</option>
                <option @if (in_array('Magenta', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Magenta">Magenta</option>
                <option @if (in_array('Olden', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Olden">Olden</option>
                <option @if (in_array('Plum', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Plum">Plum</option>
                <option @if (in_array('Olive', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Olive">Olive</option>
                <option @if (in_array('Cyan', $product->ProductColor->pluck('color')->toarray())) selected="selected"  @endif value="Cyan">Cyan</option>
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
             <!--    <option selected="">Hi</option>
                <option selected="">Hlo</option> -->
                  @foreach($categories as $category)
                    <option  value="{{$category->id}}" @if (in_array($category->id, $product->ProductCategory->pluck('category_id')->toarray())) selected=""  @endif  data-show="parent">{{ucfirst($category->name)}} </option>
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
            <div class="col-xs-4 col-sm-4 col-md-4" >
               <label class="form-col-form-label starlabel" >Product Thumbnail  </label>
               <input type="file" id="file-input" class="form-control file-input {{ $errors->has('product_thumbnail') ? ' is-invalid' : '' }}" multiple name="product_thumbnail" >
               @if ($errors->has('product_thumbnail'))
               <span class="invalid feedback" role="alert"> 
                    <strong class="text-danger">{{ $errors->first('product_thumbnail') }}.</strong> 
               </span>
               @endif
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8" >
               <label class="form-col-form-label starlabel" >Select Images  </label>
               <input type="file" id="file-input" class="form-control file-input {{ $errors->has('image') ? ' is-invalid' : '' }}" multiple name="image[]" >
               @if ($errors->has('image'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('image') }}.</strong> 
               </span>
               @endif
                 
            </div>
        </div>
        <div class="form-row mt-4">
            <div class="col-xs-4 col-sm-4 col-md-4" >
             <div class="img-blocks">   
            <img src="{{asset('images/productsimages/'.$product->product_thumbnail)}}" alt="Product" class="mt-4 img-thumbnail" width="100">
        </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8" >
            <div class="row">
                @foreach($product->Productimages as $image)
                    <div class="col">
                        <div class="img-blocks">
                        <img src="{{asset('images/productsimages/'.$image->image)}}" alt="Product" class="mt-4 img-thumbnail" width="100">
                        <span> <i class="fa fa-trash danger deleteRecord " aria-hidden="true" data-id="{{ $image->id }}" style="cursor: pointer; "></i> </span>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
         <div class="form-group mt-4">
            <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group"><label class="starlabel">Description : </label><textarea class="form-control" style="height:150px" name="description"   placeholder="Description" >{{ old('description',$product->description) }}</textarea>
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
<script>
   $(document).ready(function(){
       $('.deleteRecord').click(function () {
       let id = $(this).data('id');
       $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('products.productimagedelete') }}',
            data: {'id': id},
            success: function (data) {     
                var message = data.message;
                location.reload();
            }
       });
    });
   });
</script> 
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
         accept: "jpg|jpeg|png|ico|bmp"
        },
        product_thumbnail: {
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
