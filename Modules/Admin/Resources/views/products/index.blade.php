@extends('admin::layouts.master')
@section('title') Categories   @endsection
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
         <h1 class="h3 m-0">@if($categorey_type==0) Services @else  Products  @endif </h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">@if($categorey_type==0) Services @else  Products  @endif </li>
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
         <a class="btn  btn-info btn-sm rounded-pill " href="{{ route('services.create.servicecategory') }}" > <i class="fa fa-plus-circle"></i> Service Category</a>
         @else
         <a class="btn  btn-info btn-sm rounded-pill " href="{{ route('products.create') }}" > <i class="fa fa-plus-circle"></i> @if($categorey_type==0) Services @else  Products  @endif </a>
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
                           <th scope="col">Products</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $i=1; @endphp
                        @foreach($categories as $categorie)
                        <tr class="notification{{$categorie->id}}">
                           <th scope="row" class="sr-no"> {{$i++}}</th>
                           <td><b> {{$categorie->name}}  </b></td>
                           <td>
                               <a class="text-primary" href="{{route('products.categoryproducts',$categorie->id)}}"><span class="badge badge-danger badge-pill"> {{ ($categorie->CategoryProduct)->count() }}</span> </a> 
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
