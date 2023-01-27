@extends('admin::layouts.master')
@section('title') Pages @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h4 m-0">
         Pages</h4>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Pages</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="row">
      <div class="col-md-12 text-right">
         <a class="btn btn-sm btn-warning rounded-pill text-white" href="javascript:history.go(-1)"> <i class="fas fa-arrow-circle-left"></i> Back</a>
        {{-- <a class="btn btn-sm btn-info rounded-pill "  href="{{ route('admin.pages') }}" > <i class="fas fa-file-alt"></i> Add Page</a>--}}
      </div>
      <div class="col-sm-12 mb-4 mt-3">
         <div class="box bg-white">
            <div class="box-row">
               <div class="box-content">
                  <table id="dataTable" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col" class="sr-no">S.No</th>
                           <th scope="col">Name</th>
                           <th scope="col" class="action"> Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php  $i=1; @endphp
                        @foreach($pages as $page)
                        <tr class="notification">
                           <th scope="row" class="sr-no"> {{$i++}}</th>
                           <td>{{ucfirst($page[0])}}</td>
                           <td class="action"> <a class="icon-btn edit" href="{{ route('admin.page.update',$page[0]) }}"><i class="fal fa-edit" id="show-edit"></i></a></td>
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
@section('js')
<script>
   $(document).ready( function () {
    $('#dataTable').DataTable();
   });
   
</script>
@endsection
