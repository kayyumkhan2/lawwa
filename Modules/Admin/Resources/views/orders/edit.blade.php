

@extends('layouts.admin.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection


@section('links')
 
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>

@endsection
@section('content')
<div class="main-content">
    <div class="page-title col-sm-12">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 m-0">Edit product</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">product edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<!--<div class="row">
   <div class="col-lg-12 margin-tb">
      <div class="pull-left">
         <h2>Edit Product</h2>
      </div>
      <div class="pull-right"><a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a></div>
   </div>
</div>-->
@if ($errors->any())
<div class="alert alert-danger">
   <strong>Whoops!</strong> There were some problems with your input.<br><br>
   <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </ul>
</div>
@endif
<!--
 <form method="POST" action="{{ route('categorydelete') }}">
  @csrf
    <input type="text" name="category_id">
    <input type="submit"  value="Remove">

  </form>-->

<form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
   @csrf @method('PUT')
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <input type="text" name="product_id" value="{{$product->id}}" hidden="">
         <div class="form-group"><label>Product name</label><input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name"></div>
      </div>
     <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group"><label>Price </label><input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="Price"></div>
      </div>

<dir class="row">
 
  
@foreach ($product->category as $categorname)
<i class="fa fa-trash  deletecategory" aria-hidden="true" data-id="{{ $categorname->id }}" style="margin-left: 140px; color: red; cursor: pointer; "></i>
{{$categorname->name}} | {{$categorname->id}}

@endforeach


</dir>

  <div class="col-xs-12 col-sm-12 col-md-12">
<label>Category</label>


<select class="browser-default custom-select" name="category[]" id="category">
<option selected>Select category</option>
@foreach ($categories as $category)
<option value="{{ $category->id }}" >{{ $category->name }}</option>


@endforeach
</select>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<label>Subcategory</label>
<select class="browser-default custom-select" name="category[]" id="subcategory">
</select>
</div>

<!--
 <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
 <div class="form-group" style="height: 40px;">
 
      <label class="form-col-form-label" >Select Category:</label>
<select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select form-control" name="category[]">
   
    @foreach ($categories as $category)
        <option value="{{$category->id}}" >{{ $category->name }}</option>
        @php   $i=1; @endphp

        @foreach ($category->childrenCategories as $childCategory)
            @include('admin.products.child_category', ['child_category' => $childCategory])
        @endforeach
        
    @endforeach
</select>
</div>

</div-->




     
       <div class="col-xs-12 col-sm-12 col-md-12 imgeapn">
    <label class="form-col-form-label" >Select Images:</label>
<input type="file" id="file-input" class="form-control file-input" multiple name="image[]" />
@if ($errors->has('image'))
         <div class="invalid-feedback">
            {{ $errors->first('image') }}
        </div>
         @endif
</div>

<div class="row">

 @foreach ($product->allforeditproductiamge as $image)


 <div class="col-md-2 mt-3" style="margin-left: 10px;">
         
 <img src="{{$image->src}}" class="rounded mx-auto d-block" alt="{{ $image->src }}"  >

<i class="fa fa-trash  deleteRecord" aria-hidden="true" data-id="{{ $image->id }}" style="margin-left: 140px; color: red; cursor: pointer; "></i>

       
      </div>


        @endforeach
</div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group"><strong>Description:</strong><textarea class="form-control" id="description" style="height:150px" name="description" placeholder="description">{{ $product->description }}</textarea></div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
         <button type="submit" class="btn btn-primary">Submit</button></div>
   </div>
</form>
@endsection

@section('js')

<script type="text/javascript">
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$(document).ready(function () {
$('#category').on('change',function(e) {
var cat_id = e.target.value;
//alert(cat_id);

$.ajax({
url:"{{ route('subcat') }}",
type:"POST",
data: {
cat_id: cat_id

},
success:function (response) {
   len = response['subcategories'].length;
  $('#subcategory').empty();
for(var i=0; i<len; i++){

                 var id = response['subcategories'][i].id;
                 var name = response['subcategories'][i].name;

                 var option = "<option value='"+id+"'>"+name+"</option>"; 
                 $("#subcategory").append(option); 
               }


}
})
});
});
</script>

<script>
$(document).ready(function(){
  $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
    $('.deleteRecord').click(function () {
       
        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('productimagedelete') }}',
            data: {'id': id},
            success: function (data) {
               
var message = data.message;
//alert(message);
               
     location.reload();
               // console.log(data.message);
            }
        });
    });
});

</script>
<script>
$(document).ready(function(){
  $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
    $('.deletecategory').click(function () {

        let id = $(this).data('id');
        alert(id);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('categorydelete') }}',
            data: {'id': id},
            success: function (data) {
               
var message = data.message;
//alert(message);
               
     location.reload();
               // console.log(data.message);
            }
        });
    });
});

</script>




<script >

$(document).on("change", ".file-input" , function() {
   

 if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    {
        
        var data = $(this)[0].files; //this file data
        
        $.each(data, function(index, file){ //loop though each file
            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                var fRead = new FileReader(); //new filereader
                fRead.onload = (function(file){ //trigger function on successful read
                return function(e) {
                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                    $('#thumb-output').append(img); 
                     $('.imgeapn').append('<br><input type="file" id="file-input" class="form-control file-input" multiple name="image[]" />'); 

                    //append image to output element
                };
                })(file);
                fRead.readAsDataURL(file); //URL representing the file's data.
            }
        });
        
    }else{
        alert("Your browser doesn't support File API!"); //if File API is absent
    }
 });



$('select').val(['Fruits','Apple']);
$('select').trigger('change');


</script>.


<script>

   CKEDITOR.replace( 'description' );
</script>


@endsection