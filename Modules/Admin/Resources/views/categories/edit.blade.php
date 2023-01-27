@extends('admin::layouts.master')
@section('title') Edit @if($categorydata->categorey_type==0) Service Category @else  Product Category  @endif @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h4>Edit @if($categorydata->categorey_type==0) Service @else Product @endif Category</h4>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categories</a></li>
               <li class="breadcrumb-item active" aria-current="page">Category Edit</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Update Category</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
         </div>
         <div class="modal-body">
            <div class="card">
               <div class="card-header"> <strong>Edit Category</strong>  </div>
               <div class="card-body">
                  <form class="card-body" method="POST"  method="POST" enctype="multipart/form-data">
                     {{ method_field('PATCH') }}
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  value="" autofocus id="nf-name" name="name" type="text" placeholder="Enter Category name.." autocomplete="name">
                        @if ($errors->has('name')) <span class="invalid feedback" role="alert"> <strong class="text-danger">{{ $errors->first('name') }}.</strong> </span> @endif 
                     </div>
                     <div class="form-group">
                        <label>Title</label>
                        <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  value="{{ old('title') }}" autofocus id="nf-title" name="title" type="text" 
                           placeholder="Enter Category title.." autocomplete="title">
                        @if ($errors->has('title')) <span class="invalid feedback" role="alert"> <strong class="text-danger">{{ $errors->first('title') }}.</strong> </span> @endif 
                     </div>
                     @if (count($parent_categories) > 0)
                     <div class="form-group row ">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <label for="emp-id" class="form-input-label">Parent Category : </label>
                           <select  name="parent_id" id="parent_id"  class="selectpicker form-control parent_id" >
                              <option value="">--Selecy Category--</option>
                              @foreach($parent_categories as $categorie)
                              <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                              @endforeach                                         
                           </select>
                        </div>
                     </div>
                     @endif
                     <div class="form-group row">
                        <div class="col-xs-9 col-sm-9 col-md-9">
                           <label class="form-col-form-label" >Select Icon</label>
                           <input type="file" id="file-input" class="form-control file-input {{ $errors->has('image') ? ' is-invalid' : '' }}"  autofocus  name="image" />
                           @if ($errors->has('image')) <span class="invalid feedback" role="alert"> <strong class="text-danger">{{ $errors->first('image') }}.</strong> </span> @endif 
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                           <label class="ml-5"></label>
                           <img src="" id="category_image" width="120" class="img-thumbnail">
                        </div>
                     </div>
                     <!-- <div class="form-group row " id="dynamic_field_row" >
                        <label class="ml-3">Category for</label>
                        <div class="col-sm-12">
                           <select  name="categorey_type" class="selectpicker form-control">
                              <option value="0">Service-Category</option>
                              <option value="1">Product-Category</option>
                           </select>
                        </div>
                     </div> -->
                     <div class="form-group row ">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <label for="exampleFormControlTextarea1">Description</label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ old('description') }}</textarea>
                           @if ($errors->has('description'))
                           <span class="invalid feedback" role="alert"> 
                           <strong class="text-danger">{{ $errors->first('description') }}.</strong> 
                           </span>
                           @endif
                        </div>
                     </div>
               </div>
               <div class="card-footer">
               <button class="btn btn-sm btn-primary" type="submit">Save</button>
               <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
               </div>
               </form>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header"><strong>{{$categorydata->name}}</strong> 
      @if($categorydata->categorey_type==0)
      <a class="btn  btn-info btn-sm rounded-pill float-right  ml-2 " href="{{ route('categories.servicecategories') }}" > <i class="fa fa-plus-circle"></i> Services Categories</a>
      @else
      <a class="btn  btn-info btn-sm rounded-pill float-right ml-2 " href="{{ route('categories.index') }}" > <i class="fa fa-plus-circle"></i> Product Categories</a>
      @endif
      <a class="btn btn-sm btn-warning text-white rounded-pill float-right ml-2   " href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a> 
   </div>
   <div class="card-body">
      <li class="notification{{$categorydata->id}}">
         <input type="" name="" data-id="{{$categorydata->id}}" value="{{$categorydata->name}}" class="mt-2 update" style="color:green;">
       <span class="icon-btn edit dataclass " data-toggle="modal"
            data-id="{{ $categorydata->id }}" 
            data-name="{{ $categorydata->name }}"  
            data-title="{{ $categorydata->title}}" 
            data-categorey_type="{{ $categorydata->categorey_type }}"   
            data-description="{{ $categorydata->description }}"   
            data-category_image="{{ asset('public/images/categoriesimages/'.$categorydata->image)}}" 
            data-target="#myModal"><i class="fal fa-edit btn btn-outline-primary btn-sm rounded-circle" id="show-edit" ></i></span><a class="icon-btn delete remove-category" href="javascript:void(0);" data-status="0" data-id="{{ $categorydata->id}}"  data-model="Category" id="notification{{$categorydata->id}}" > </a>
      </li>
      <ul>
         @foreach ($categories as $category)
         <li class="notification{{$category->id}}">
            <input type="" name="" data-id="{{$category->id}}" value="{{$category->name}}" class="mt-2 update" style="color: green;"> 
            <span class="icon-btn edit dataclass " data-toggle="modal" 
               data-id="{{ $category->id }}" 
               data-name="{{ $category->name }}"  
               data-title="{{ $category->title}}" 
               data-categorey_type="{{ $category->categorey_type }}"   
               data-description="{{ $category->description }}"   
               data-category_image="{{ asset('public/images/categoriesimages/'.$category->image)}}" 
               data-target="#myModal"><i class="fal fa-edit btn btn-outline-primary rounded-circle btn-sm" id="show-edit"></i></span>   <a class="icon-btn delete remove-category" href="javascript:void(0);" data-status="0" data-id="{{ $category->id}}"  data-model="Category" id="notification{{$category->id}}" > <i class="fal fa-trash-alt btn btn-outline-danger btn-sm rounded-circle" id="delete-btn"></i></a>
         </li>
         </li>  
         <ul>
           
         </ul>
         @endforeach
      </ul>
   </div>
</div>
<div id='loader' style='display: none;'>
   <img src='https://media4.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif' width='100px' height='100px'>
</div>
@endsection
@section('js')
<script >
   $(document).ready(function(){
   $(document).on('click', '.remove-category', function (e) {
    let id = $(this).data('id');
       var notifictionid= $(this).attr("id");
       let model = $(this).data('model');
       let status = $(this).data('status');
   
   swal({
         title: "Are you sure?",
         text: "Once deleted, you will not be able to recover this imaginary !",
         icon: "warning",
         buttons: true,
         dangerMode: true,
       })
   .then((willDelete) => {
   if (willDelete) {
      $.ajax({
           type: "POST",
           dataType: "json",
           url: '{{ route('universaldelete') }}',
           data: {'id': id,'model':model,'status':status,"_token": "{{ csrf_token() }}"},
           success: function (data) {
             if(data.status=='ok')
             {
              window.location.href = "{{url()->current()}}";
             }
             if(data.status=='error')
             {
             alert(data.message); 
             swal({
                   title: "Error!",
                   text: "SOMETHING WENT TO WRONG!",
                   icon: "error",
                 });   
             }
           },   
       });
   } 
   
   });
  });
});
   
   
</script>
<script>
   $(document).ready(function(){
       $(document).on('click','.remove-category1',function(){
           let id = $(this).data('id');
           var notifictionid= $(this).attr("id");
           let model = $(this).data('model');
           let status = $(this).data('status');
                // alert(model);
           $.ajax({
               type: "POST",
               dataType: "json",
               url: '{{ route('universaldelete') }}',
               data: {'id': id,'model':model,'status':status,"_token": "{{ csrf_token() }}"},
               success: function (data) {
                 if(data.status=='ok')
                 {
                  window.location.href = "{{url()->current()}}";  
                 }
                 if(data.status=='error')
                 {
                 alert(data.message);    
                 }
         
               },
   
           });
       });
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
     $(document).on('click','.dataclass',function(){
         var id = $(this).data('id');
         var category_image = $(this).data('category_image');
         
        // var brief_detail = $(this).data('brief_detail');
       //  alert(brief_detail);
         $("#category_image").attr("src",category_image);
         $('#nf-name').val($(this).data('name'));
         $('#nf-title').val($(this).data('title'));
         $('#exampleFormControlTextarea1').val($(this).data('description'));
   
         var category_id = $(this).data('id');
         
         var url = '{{ route("categories.update", ":id") }}';
         url = url.replace(':id',category_id);
         $('.modal_hiddenid').val(id);       
         $('.card-body').attr('action', url);       
   var orderdata = ' <td>'+$(this).data('serviceid')+'</td><td>'+$(this).data('name')+'</td><td>'+$(this).data('amount')+'</td><td>'+$(this).data('brief_detail')+'</td><td>'+$(this).data('status')+'</td><td>'; 
     $("#orderdata").html(orderdata);
        
     });
   })
</script> 
<script>
   $(document).ready(function(){
   $(document).on('keyup','.update',function(){
   let id = $(this).data('id');
   let value =  $(this).val();
     $.ajax({
     type: "POST",
     dataType: "json",
     url: '{{ route('edit_category') }}',
   //   beforeSend: function(){
   // // Show image container
   //    $("#loader").show();
   //  },
     data: {'id': id,'value':value,"_token": "{{ csrf_token() }}"},
      success: function (data) {
           //$("#loader").hide();
     //var status = data.status;   
   
      }
      ,
           error: function (jqXHR, exception) {
       var msg = '';
       if (jqXHR.status === 0) {
           msg = 'Not connect.\n Verify Network.';
       } else if (jqXHR.status == 404) {
           msg = 'Requested page not found. [404]';
       } else if (jqXHR.status == 500) {
           msg = 'Internal service Error [500].';
       } else if (exception === 'parsererror') {
           msg = 'Requested JSON parse failed.';
       } else if (exception === 'timeout') {
           msg = 'Time out error.';
       } else if (exception === 'abort') {
           msg = 'Ajax request aborted.';
       } else {
           msg = 'Uncaught Error.\n' + jqXHR.responseText;
       }
      // $('#post').html(msg);
       alert(msg);
   },
      });
    });
    });
   
</script>
@endsection
