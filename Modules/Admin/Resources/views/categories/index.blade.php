@extends('admin::layouts.master')
@section('title') {{$pagename}}   @endsection
@section('content')
<style type="text/css">
   .btn-secondary{
   pointer-events: none;
   display: inline-block; /* For added support */
   }
</style>
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">{{$pagename}}</h1>
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

<div class="col-sm-12">
   <div class="row">
      <div class="col-md-12 text-right">
         <a class="btn btn-sm btn-warning rounded-pill text-white" href="javascript:history.go(-1)"> <i class="fas fa-arrow-circle-left"></i> Back</a>
         @if($categorey_type==0)
         <a class="btn  btn-info btn-sm rounded-pill " href="{{ route('categories.create.servicecategory') }}" > <i class="fa fa-plus-circle"></i> Service Category</a>
         @else
         <a class="btn  btn-info btn-sm rounded-pill " href="{{ route('categories.create') }}" > <i class="fa fa-plus-circle"></i> Product Category</a>
         @endif
      </div>
      <div class="col-sm-12 mb-4 mt-3" >
         <div class="box bg-white">
            <div class="box-row">
               <div class="box-content">
                  <table id="dataTable" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col" class="sr-no">S.No</th>
                           <th scope="col">Name</th>
                           <th scope="col" class="action">icon</th>
                           <th scope="col">Sub-Category</th>
                           <th scope="col"> Status</th>
                           <th scope="col" class="action float-center">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $i=1; @endphp
                        @foreach($categories as $categorie)
                        <tr class="notification{{$categorie->id}}">
                           <th scope="row" class="sr-no"> {{$i++}}</th>
                           <td><b> {{ucfirst($categorie->name)}} </b></td>
                           <td><img src="{{ asset('public/images/categoriesimages/'.$categorie->image) }}" alt="icon" width="60"class="img-thumbnail img-zoom"></td>
                           <td>
                              <b>
                              @if($categorie->subcategory=='')
                              Self
                              @else
                              {{count($categorie->subcategory, true)}}
                              @endif 
                              </b>
                           </td>
                           <td>
                              <span class="Statuschange badge @if($categorie->status=='0') badge-danger @else badge badge-success @endif" data-id="{{$categorie->id}}"  data-model="Category" id="Statuschange{{$categorie->id}}">
                              @if($categorie->status=="0") Deactive @else Active @endif 
                              </span>
                           </td>
                           <td class="action float-center" >
                              <a class="icon-btn preview" href="{{ route('categories.show',$categorie->id) }}"  > <i class="fal fa-eye"  id="show-btn"></i></a> 
                              <a class="icon-btn edit" href="{{ route('categories.edit',$categorie->id) }}"> <i class="fal fa-edit"  id="show-edit"></i></a> 
                              <a class="icon-btn delete universaldelete" href="javascript:void(0);" data-status="0" data-id="{{ $categorie->id}}"  data-model="Category" id="notification{{$categorie->id}}" > <i class="fal fa-trash-alt" id="delete-btn"></i></a> 
                           </td>
                           </td>
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
@jquery
@toastr_js
@toastr_render
@endsection
@section('css')
<style type="text/css">
.img-thumbnail:hover {
  transition: transform .8s;
    zoom: 4; /* all browsers */
  transform: scale(4);
  cursor: zoom-out;
}   
</style>
@endsection
@section('js') 
<script>
   $(document).ready( function () {
    $('#dataTable').DataTable();
   });
   
</script> 
@endsection
