@extends('admin::layouts.master')
@section('title') Products @endsection
@section('content')
<div class="main-content">
   <div class="page-title col-sm-12">
     <div class="row align-items-center">
       <div class="col-md-6">
         <h1 class="h3 m-0">Products</h1>
       </div>
       <div class="col-md-6">
         <nav aria-label="breadcrumb">
           <ol class="breadcrumb m-0 p-0">
             <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
             <li class="breadcrumb-item active" aria-current="page">Products</li>
           </ol>
         </nav>
       </div>
      </div>
   </div>
   @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
   @endif
   <div class="col-sm-12">
     <div class="row">
      <div class="col-md-12">
         <a class="btn btn-sm btn-warning text-white float-right ml-1" href="{{ URL::previous() }}">Back</a>
         <a class="btn btn-sm btn-info float-right ml-1 " href="{{ route('products.create') }}" > Add Product</a>
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
                    <th scope="col" class="tdwidth">Product Id</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col"  class="action">Image</th>
                    <th class="action">Status</th>
                    <!-- <th scope="col">Details</th>-->
                    <th scope="col" class="action">Actions</th>
                </thead>
                <tbody>
               @php $i=1 @endphp
               @foreach ($products  as $product)
                  <tr class="notification{{$product->id}}">
                     <td scope="row" class="sr-no"> {{ $i++ }}</td>
                     <td>{{ $product->name }}</td>
                     <td>{{ $product->id }}</td>
                     <td>
                        @foreach ($product->categoriesdata as $categorname)
                           {{$categorname->name}}
                           @php $coma="|"; @endphp 
                           @if($loop->last)
                           @php $coma=""; @endphp  
                        @endif 
                           <b class="text-primary" style="font-size: 18px;">{{$coma}}</b> 
                        @endforeach
                     </td>
                     <td>{{ round($product->price, 2) }} </td>
                     <td> 
                        <img src="{{asset('images/productsimages/'.$product->product_thumbnail)}}" alt="not found" width="60">
                     </td>
                     <td>
                        <span class="Statuschange badge @if($product->status=='0') badge-danger @else badge badge-success @endif" data-id="{{$product->id}}"  data-model="Product" id="Statuschange{{$product->id}}">
                           @if($product->status=="0") Deactive @else Active @endif 
                        </span>
                     </td>
                     <td class="action float-left">
                           <a class="icon-btn preview" href="{{ route('products.show',$product->id) }}"> <i class="fal fa-eye" id="show-btn"></i></a> 
                        @can('role-edit')
                           <a class="icon-btn edit" href="{{ route('products.edit',$product->id) }}"><i class="fal fa-edit" id="show-edit"></i></a> 
                        @endcan 
                        @can('role-delete')
                            <a class="icon-btn delete universaldelete" href="javascript:void(0);" data-status="0" data-id="{{ $product->id}}"  data-model="Product" id="notification{{$product->id}}" > <i class="fal fa-trash-alt" id="delete-btn"></i></a> 
                         @endcan 
                     </td>
                  </tr>
            @endforeach
            </tbody>
            </table>
            @jquery
            @toastr_js
            @toastr_render
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 
@section('js')
<script>
  $(function(){ 
    $("#dataTable").addClass("table-responsive");
  });
</script>
<script language="javascript">
  $("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });
</script>
<script>
  $('#dataTable').DataTable({});
</script>
@endsection
