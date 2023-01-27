@section('title') {{ $pagename}}   @endsection
@extends('admin::layouts.master')
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
      <div class="col-md-6">
         <h3>{{ $pagename}}  Edit </h3>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('membershipplan.index')}}"> {{ $pagename}} </a></li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <div class="d-flex justify-content-between">
         <div>
            {{ $membership->name }}
         </div>
         <div>
            <a class="btn btn-sm btn-warning text-white" href="javascript:history.go(-1)" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> <a class="btn btn-sm btn-info " href="{{ route('membershipplan.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">{{ $pagename}}s </a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <form method="post" action="{{route('membershipplan.update', $membership->id)}}" id="formid">
         {{ csrf_field() }}
         {{ method_field('PATCH') }}
         <div class="form-group  ">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <label>Name:</label>
               <input type="name" class="form-control"  name="name" value="{{$membership->name}}">
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group"><label>Price :</label>
               <input type="text" name="price" class="form-control" value="{{$membership->price}}">
               @if ($errors->has('price'))
               <span class="invalid feedback" role="alert"> 
               <strong class="text-danger">{{ $errors->first('price') }}.</strong> 
               </span>
               @endif
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <div class="row">
               <div class="col-sm-12 col-md-12">
                  <div class="card">
                     <div class="card-header badge-pill "><b class="text-value text-primary">Membership Features</b></div>
                     <div class="card-body"> 
                        @foreach($features as $key=>$value)
                          <input type="checkbox" value="{{$value->id}}" @if(in_array($value->id, $membershipfeatures)) checked @endif   name="features[]"> 
                          {{ ucfirst($value->name) }} 
                          </label>
                        @endforeach 
                     </div>
                  </div>
              </div>
           </div>
         </div>
      </div>
      <div class="col-md-12" >
        <div class="form-group">
          <label for="email">Services  </label>
           <select  style="width: 100%" class="form-control js-example-basic-multiple" data-placeholder="Select Services"   name="services[]" multiple="multiple"  >
           @foreach($services as $service)
            @if($membership->MembershipFeatures) @endif
            <option value="{{$service->id}}" @if (in_array($service->name, $membership->MemberShipServices->pluck('name')->toarray())) selected="selected"  @endif > {{$service->name}}</option>
           @endforeach
          }
        </select>
        @if ($errors->has('services'))
           <span class="invalid feedback" role="alert"> 
           <strong class="text-danger">{{ $errors->first('services') }}.</strong> 
           </span>
        @endif    
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
                        },
                     "features[]": {
                        required: true,
                        },
                    },
               });
            });
</script>
@endsection