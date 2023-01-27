@extends('admin::layouts.master')
@section('title') Edit Service @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h4>Edit Service</h4>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('service.index')}}">Services</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header flex-column h-100">
      <span>Fill Service Details</span>
      <a class="btn btn-sm btn-info rounded-pill float-right ml-5 ml-lg-2" href="{{ route('service.index') }}" > <i class="fab fa-servicestack"></i> Services</a>
      <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a>
   </div>
   <div class="card-body">
      <form method="POST" action="{{ route('service.update',$data->id) }}" id="formvalidation" autocomplete="off"  enctype="multipart/form-data">
         @csrf
         {{ method_field('PATCH') }}
         <div class="form-group row ">
            <div class="col-xs-6 col-sm-6 col-md-6">
               <label class="col-form-label starlabel" >Service Name : </label>
               <input type="text" name="name" placeholder = 'Enter service name' value="{{ $data->name }}" class = "form-control  @error('name') is-invalid @enderror" >
               @if ($errors->has('name'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('name') }}.</strong> 
               </span>
               @endif
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
               <label class="col-form-label starlabel" >Amount : </label>
               <input type="text" name="amount" placeholder = 'Enter service amount' value="{{ floor($data->amount)}}" class = "form-control  @error('amount') is-invalid @enderror" >
               @if ($errors->has('amount'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('amount') }}.</strong> 
               </span>
               @endif
            </div>
         </div>
         <div class="form-group row ">
            <div class="col-xs-6 col-sm-6 col-md-6">
               <label for="exampleFormControlTextarea1">Hour</label>
               <input type="number" name="houre" min="0" max="12" value="{{ value($data->houre) }}" class = "form-control @error('houre') is-invalid @enderror ">
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
               <label for="exampleFormControlTextarea1">Minute</label>
               <input type="number" max="59" min="1" value="{{ value($data->minute) }}" name="minute" class = "form-control  @error('minute') is-invalid @enderror">
            </div>
         </div>
         <div class="form-group row">
            @if($data->ServiceCategories()->first()->parent_id=="")
                  @php $cat_id=$data->ServiceCategories()->first()->id; @endphp
               @else
                  @php $cat_id=$data->ServiceCategories()->first()->parent_id; @endphp   
            @endif
            <div class="col-xs-6 col-sm-6 col-md-6">
               <label class="col-form-label starlabel" >Service Categories : </label>
               <select name="service_category[]"  class="form-control category" id="category">
                  <option value="">Please Select Category</option>
                  @foreach($categories as $category)
                     <option value="{{$category->id}}" @if($cat_id==$category->id) selected @endif  data-show="parent">
                        {{$category->name}}
                     </option>
                  @endforeach    
               </select>
            </div>
            @php $parent_id=$data->ServiceCategories()->first()->parent_id; @endphp
            @if($parent_id!="")
            @php $sub_cat_id=$data->ServiceCategories()->first()->id; @endphp
               @php $cat_sub_categories=$data->ServiceCategories()->first()->getparent->subcategory @endphp
                  <div class="col-xs-6 col-sm-6 col-md-6" id="subcategory">
                     <label class="col-form-label starlabel" >Sub Categories :  </label>
                     <select name="service_category[]"  class="form-control" id="category">
                        <option value="" >Please Select Sub Category  </option>
                        @foreach($cat_sub_categories as $subcat)
                        <option value="{{$subcat->id}}"  @if($sub_cat_id==$subcat->id) selected @endif>{{$subcat->name}}
                        </option>
                        @endforeach    
                     </select>
                  </div>
            @endif
            <div class="col-xs-6 col-sm-6 col-md-6 subcategory" ></div>
         </div>
         <div class="form-group row ">
            <div class="col-xs-10 col-sm-10 col-md-10">
               <label>Service image : </label>
               <input type="file" name="service_image"  class = "form-control  @error('service_image') is-invalid @enderror" >
               @if ($errors->has('service_image'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('service_image') }}.</strong> 
               </span>
               @endif
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
               <img src="{{ asset('public/images/serviceimages/'.$data->service_image) }}" class="img-thumbnail" width="220" height="220" > 
            </div>
         </div>
         <div class="form-group row ">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <label for="exampleFormControlTextarea1">Brief Detail</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="brief_detail">{{ $data->brief_detail }}</textarea>
               @if ($errors->has('brief_detail'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('brief_detail') }}.</strong> 
               </span>
               @endif
            </div>
         </div>
         
   </div>
   <div class="card-footer ">
            <button class="btn btn-sm btn-primary" type="submit">Save</button>
         </div>
   </form>
   
</div>
@endsection
@section('js')
<script type="text/javascript">
   $(document).on('click', '.category', function(e){
     var dataShow = $(this).find(':selected').attr("data-show");
     if(dataShow == "parent"){
       $("#subcategory").html("");
     }
   $(this).parent().parent().find('.subcategory').html('<div class="col-xs-12 col-sm-12 col-md-12 subcategory" id="subcategory"></div>');
     var cat_id = e.target.value

      if (cat_id) {
      $.ajax({
                 url:"{{ route('categories.servicesubcategory') }}",
                 type:"POST",
                 data: {cat_id: cat_id,"_token": "{{ csrf_token() }}"},
                success:function (response) {
                 len = response['subcategories'].length;
                 if(len>0)
                 {
                   var html = [];
                   html.push('<label class="col-form-label starlabel" >Sub Categories :  </label><select name="service_category[]" class="form-control">');
                 html.push('<option value="">- - Sub Categories - -</option>');
               for(var i=0; i<len; i++){
                    var id = response['subcategories'][i].id;
                    var name = response['subcategories'][i].name;
                    html.push( "<option value='"+id+"' data-show='child'>"+name+"</option>"); 
                   }
                   html.push('</select>');
                   var data= html.join('');
                   $('#subcategory').html(data);
                 }
                }
             })
         }
         else
         {
           $("#subcategory").html("");
         }
     });
</script>
<script type="text/javascript">
   $(function() {
         $("#formvalidation").validate({
         rules: {
           name: {
             required: true,
           },
           amount: {
             required: true,
             min: 1,
             digits: true   
           },
           'service_category[]': {
             required: true,
           },
           brief_detail: {
             required: true,
           },
           houre: {
             digits: true,
             max: 12,
             min: 0
           },
           minute: {
             digits: true,
             max: 59,
             min: 0
           }
   
         },
   
         messages: {
           name: {
             required: "Service name is a required field !"
           } ,
           amount: {
             required: "Amount is a required field !"
           },     
           brief_detail: {
             required: "Brief Detail is a Required field !"
           }
         }
      });
   });
</script>
@endsection
