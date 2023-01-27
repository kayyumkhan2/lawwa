@extends('admin::layouts.master')
@section('title') Brands @endsection
@section('content')
<div class="main-content">
    <div class="page-title col-sm-12">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 m-0">Brands</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Brands</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
  

    @if ($message = Session::get('errors'))
    <div class="alert alert-danger" role="alert">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="col-sm-12">

        <div class="col-md-12 text-right mb-2">
                    <a class="btn btn-sm btn-warning text-white rounded-pill" href="{{ URL::previous() }}"> <i class="fas fa-arrow-circle-left"></i> Back</a>
                    <a class="btn  btn-info btn-sm rounded-pill" href="{{ route('brands.create') }}" > <i class="fa fa-plus-circle"></i> Brands</a>
            </div>

        <div class="row">
            <div class="col-sm-12 mb-4">
                <div class="box bg-white">
                    <div class="box-row">
                        <div class="box-content">
                            <table id="dataTable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sr-no">#</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Brand Image</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($brands as $Val)
                                                      <tr class="notification{{$Val->id}}">

                                        <th scope="row" class="sr-no"> {{$i++}}</th>
                                        <td>{{$Val->name}}</td>

                                        <?php
                                        if (!empty($Val->brand_logo)) {
                                            $img = $Val->brand_logo;
                                        } else {
                                            $img = 'dummy.png';
                                        }
                                        ?>
                                        <td>
                                            <span class="img-icon">
                                                <img src="{{ asset('public/images/brands/'.$img)}}" height="50" width="50" alt="img">
                                            </span>
                                        </td>
                                        <td>
                                            {{ date_format($Val->created_at,"d M Y")}}
                                        </td>
                                        <td>
                  <span class="Statuschange badge @if($Val->status=='0') badge-danger @else badge badge-success @endif" data-id="{{$Val->id}}"  data-model="Brand" id="Statuschange{{$Val->id}}">
                          @if($Val->status=="0") Deactive @else Active @endif 
                    </span></td>
                    <td class="action center">
                                        <span class="icon-btn edit dataclass " data-toggle="modal" 
                                                                data-serviceid="{{ $Val->id }}" 
                                                                data-name="{{ $Val->name }}" 
                                                                 data-status="{{ $Val->status }}"   
                                                                 data-description="{{ $Val->description }}"   
                                                                data-brand_logo="{{ asset('public/images/brands/'.$img) }}" 
                                                                 data-target="#myModal"><i class="fal fa-eye" id="show-edit"></i></span> 
                                                            <a class="icon-btn preview" href="{{ route('brands.edit',$Val->id) }}"><i class="fal fa-edit" id="show-edit"></i></a>
                                                             <a class="icon-btn delete universaldelete" href="javascript:void(0);" data-status="0" data-id="{{ $Val->id}}"  data-model="Brand" id="notification{{$Val->id}}" > <i class="fal fa-trash-alt" id="delete-btn"></i></a> 
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
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Service info</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12" ><img src="" id="brand_logo"></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12" >
              <table id="dataTable" class="table table-responsive-sm table-striped">
                <thead>
                  <tr class="table-primary">
                    <th>Brand id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr id="orderdata"> </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.dataclass',function(){
        var id = $(this).data('id');
        var brand_logo = $(this).data('brand_logo');
       var description = $(this).data('description');
      //  alert(brand_logo);
        $("#brand_logo").attr("src",brand_logo);
        var shippingcharges = $(this).data('shippingcharges');
  var id = $(this).data('id');
        $('.modal_hiddenid').val(id);       
var orderdata = ' <td>'+$(this).data('serviceid')+'</td><td>'+$(this).data('name')+'</td><td>'+$(this).data('description')+'</td><td>'+$(this).data('status')+'</td>'; 
    $("#orderdata").html(orderdata);
       
    });
  })
  </script> 
@endsection

