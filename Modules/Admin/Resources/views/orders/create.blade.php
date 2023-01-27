@extends('layouts.admin.app')
@section('content')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
<div class="main-content">
    <div class="page-title col-sm-12">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 m-0">Add products</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">add products</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

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



<form  id="file-upload-form" class="uploader" action="{{ route('products.store') }}"  method="POST" >
          {{ csrf_field() }}

   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group"><label>Product name:</label><input type="text" name="name" class="form-control" placeholder="Enter product name"></div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group"><label>Price:</label><input type="text" name="price" class="form-control" placeholder="Enter price"></div>
      </div>
       <div class="col-xs-12 col-sm-12 col-md-12 imgeapn">
    <label class="form-col-form-label" >Select Images:</label>
<input type="file" id="file-input" class="form-control file-input" multiple name="image[]" />
@if ($errors->has('image'))
         <div class="invalid-feedback">
            {{ $errors->first('image') }}
        </div>
         @endif
</div>

         <div class="col-xs-12 col-sm-12 col-md-12">
<label>Category</label>
<select class="browser-default custom-select" name="category[]" id="category">
<option selected>Select category</option>
@foreach ($categories as $category)
<option value="{{ $category->id }}">{{ $category->name }}</option>
@endforeach
</select>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<label>Subcategory</label>
<select class="browser-default custom-select" name="category[]" id="subcategory">
</select>
</div>



      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group"><label>Description:</label><textarea class="form-control" style="height:150px" name="description" placeholder="description" id="description"></textarea></div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
   </div>
</form>


@endsection

@section('js')

<script type="text/javascript">

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



</script>.



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
//console.log(name )
                 $("#subcategory").append(option); 
               }

// var i=1;
// $.each(data, function(key, value) {
//             $('#subcategory').append("<option value='"+ key +"'>" + value[i].id + "</option>");
//             i++;
//         });


//    //console.log(data.subcategories[1].name);
// $('#subcategory').empty();
// $.each(data.subcategories.subcategories,function(index,subcategory){
//   console.log("asdasd");
// $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
// })
}
})
});
});
</script>

<script>
   CKEDITOR.replace( 'description' );
</script>

@endsection