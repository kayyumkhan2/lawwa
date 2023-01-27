@extends('admin::layouts.master')
@section('title') Mail Template @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1 class="h3 m-0">Mail Templates</h1>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Mail Templates</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-12 text-right"> 
      <a class="btn btn-sm btn-warning rounded-pill text-white" href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a>
       {{--<a class="btn btn-sm btn-info rounded-pill " href="{{ route('mailtemplates.create') }}" ><i class="fa fa-plus-circle"></i> Mail Template</a>--}}
        </div>
    <div class="col-sm-12 mb-4 mt-3" >
      <div class="box bg-white">
        <div class="box-row">
          <div class="box-content">
            <table id="dataTable" class="table table-striped table-bordered table-hover">
              <thead>
                <tr >
                  <th scope="col" class="sr-no">S.No</th>
                  <th scope="col"> For</th>
                  <th scope="col"> Title</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Status</th>
                  <th scope="col">Default status</th>
                  <th scope="col" class="action"> Action</th>
                </tr>
              </thead>
              <tbody>
              
              @php $i=1 @endphp
              @foreach ($datas as $key =>$data)
              <tr class="notification{{$data->id}}">
                <th scope="row" class="sr-no">{{ $i++ }}</th>
                <td>{{ $data->for }}</td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->subject }}</td>
                 <td>
                  <span class="Statuschange badge @if($data->status=='0') badge-danger @else badge badge-success @endif" data-id="{{$data->id}}"  data-model="MailTemplate" id="Statuschange{{$data->id}}">
                          @if($data->status=="0") Deactive @else Active @endif 
                    </span></td>
                <td>
                  <span class="badge @if($data->default_status =='0') badge-danger @else badge badge-success @endif"> @if($data->default_status=="0") No @else Yes @endif </span></td>
                <td class="action ">  
                        <a class="icon-btn preview" href="{{ route('mailtemplates.show',$data->id) }}">    
                        <i class="fal fa-eye" id="show-btn" ></i></a>
                        <a class="icon-btn edit" href="{{ route('mailtemplates.edit',$data->id) }}">
                        <i class="fal fa-edit" id="show-edit"></i></a>
                        {{--<a class="icon-btn delete universaldelete" href="javascript:void(0);" data-status="0" data-id="{{ $data->id}}"  data-model="MailTemplate" id="notification{{$data->id}}" > 
                                                                          <i class="fal fa-trash-alt" id="delete-btn"></i>--}}
                </a> 
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

@endsection
@section('js') 
<script>
    $('#dataTable').DataTable();
</script> 

@endsection 