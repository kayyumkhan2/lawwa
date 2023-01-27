@extends('admin::layouts.master')
@section('title') Mail Template @endsection
@section('content')
<style>
.card-title
{
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	
	}
</style>
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-12">
      <h4>Mail Template</h4
        >
    </div>
    <div class="col-md-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('mailtemplates.index')}}">Mail Templates</a></li>
          <li class="breadcrumb-item active" aria-current="page">Mail Template Info</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="card">
<div class="card-header"> 
<div class="d-flex justify-content-between">
      <div >
         {{ $data->title }} <span class="badge @if($data->default_status =='0') badge-danger @else badge badge-success @endif "> @if($data->default_status=="0") No @else Yes @endif </span>
      </div>
      <div>
  <a class="btn btn-sm btn-info float-right ml-5 rounded-pill ml-lg-2" href="{{ route('mailtemplates.index') }}" > <i class="fas fa-mail-bulk"></i></i> Mail Templates</a>
         <a class="btn btn-sm btn-warning rounded-pill text-white float-right " href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a>
      </div>
 </div>
</div>
<div class="card-body">
 <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-md-12 col-form-label" for="text-input">
                    <strong>Title</strong>
                </label>
                <div class="col-md-12">
                    {{ $data->title }}
                </div>
                
                
 <label class="col-md-12 col-form-label" for="text-input">
                    <strong>Subject</strong>
                </label>

                <div class="col-md-12">

                    {{ $data->subject }}
                </div>
 <label class="col-md-12 col-form-label" for="text-input">
                    <strong>Mail Format</strong>
                </label>
                <div class="col-md-12">
                   
                    {!! $data->html_template  !!}
                </div>
 <label class="col-md-12 col-form-label" for="text-input">
                    <strong>Default Status</strong>
                </label>
              


            </div>
            
           
        </div>
    </div>
</div>
</div>
@endsection