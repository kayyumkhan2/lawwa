@extends('admin::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h3>Add {{$pagename}}</h3>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add {{$pagename}}</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <strong>Create {{$pagename}}</strong>
      <a class="btn btn-sm btn-info float-right ml-5 ml-lg-2 rounded-pill" href="{{ route('membershipplan.index') }}" > <i class="fas fa-american-sign-language-interpreting"></i> {{$pagename}}s</a>
      <a class="btn btn-sm btn-warning text-white float-right rounded-pill " href="javascript:history.go(-1)"> <i class="fas fa-arrow-circle-left"></i> Back</a>
   </div>
   <div class="card-body">
      <form method="POST" action="{{ route('membershipplan.store') }}" id="formid">
      @csrf
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group"><label>Name:</label>
               <input type="text" name="name" class="form-control" value="{{old('name')}}">
               @if ($errors->has('name'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('name') }}.</strong> 
               </span>
               @endif
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group"><label>Price :</label>
               <input type="text" name="price" class="form-control" value="{{old('price')}}">
               @if ($errors->has('price'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('price') }}.</strong> 
               </span>
               @endif
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group"><label>Select Services :</label>
                <select class="form-control js-example-basic-multiple" data-placeholder="Select Services" name="services[]" multiple="multiple" placeholder="Select Services">
                 @foreach($services as $service)
                  <option value="{{$service->id}}">{{$service->name}}</option>
                 @endforeach
                </select>
                @if ($errors->has('services'))
                     <span class="invalid feedback" role="alert"> 
                     <strong class="text-danger">{{ $errors->first('services') }}.</strong> 
                     </span>
               @endif    
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <div class="row">
               <div class="col-sm-12 col-md-12">
                  <div class="card">
                      <div class="card-header badge-pill ">
                        <b class="text-dark">{{$pagename}} Features</b>
                      </div>
                      <div class="card-body"> 
                         @foreach ($features as $value)
                         <input type="checkbox" value="{{$value->id}}"   name="features[]"> 
                         {{ ucfirst($value->name) }} 
                         </label>
                         @endforeach 
                      </div>
                    </div>
               </div>
             </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card-footer">
      <button class="btn btn-sm btn-primary" type="submit">Save</button>
      <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
   </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
}); 
</script>
<script >
   $(document).ready(function(){
        $("#formid").validate(
            {
                ignore:[],
                debug:false,
                rules:{ 
                    name:{
                        required: true,
                        },
                        price:{
                        required: true,
                        digits  : true,
                        },
                     "permission[]": {
                        required: true,
                        },
                    },
             	});
         	});
</script>
@endsection
