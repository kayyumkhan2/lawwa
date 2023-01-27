@extends('admin::layouts.master')
@section('content')
<div class="main-content">
    <div class="page-title col-sm-12">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 m-0">Permissions</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
 

		@if ($message = Session::get('success'))
		<div class="alert alert-success"><p>{{ $message }}</p>
		</div>
		@endif



<div class="col-md-12 bg-light text-right">
                    <a class="btn btn-sm btn-warning text-white" href="{{ URL::previous() }}">Back</a>
                    <a class="btn btn-sm btn-info " href="{{ route('Roles.create') }}" > Add Role</a>

       

            </div>
 <div class="col-sm-12 mb-12 mt-12" >
                <div class="box bg-white">
                    <div class="box-row">
                        <div class="box-content">
 @foreach($permissions as $key=>$permission)  
 
 <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header badge-pill "><b>{{$key}}</b></div>
                    <div class="card-body"> @foreach ($permission as $value)
                                                <b>{{$value->name}} |</b>
                                            @endforeach 
                </div>
                </div>
            </div>
   
  @endforeach 

                       

                                                       </div>
                    </div>
                </div>
            </div>
           
       


	@endsection
@section('js')
  <script>
   $(document).ready( function () {
    $('#dataTable').DataTable();
});

</script>
@endsection
