@extends('admin::layouts.master')
@section('title') Role management  @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">Role management</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="row">
<div class="col-md-12 bg-light text-right">
   <a class="btn btn-sm btn-warning text-white" href="javascript:history.go(-1)">  <i class="fas fa-arrow-circle-left"></i> Back</a>
   <a class="btn btn-sm btn-info " href="{{ route('Roles.create') }}" > Add Role</a>
</div>
<div class="col-sm-12 mb-4 mt-3" >
   <div class="box bg-white">
      <div class="box-row">
         <div class="box-content">
            <table id="dataTable" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr>
                     <th scope="col" class="sr-no">S.No</th>
                     <th scope="col" >Name</th>
                     <th scope="col" class="action">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php $i=1 @endphp
                  @foreach ($roles as $key => $role)
                  <tr>
                     <td>{{ $i++ }}</td>
                     <td> @if($role->name=="Beautician") PBTLA @else {{ $role->name }} @endif  </td>
                     <td class="action ">
                        <form method="post" action="{{route('Roles.destroy',$role->id)}}" id="add-product-form">
                           {!! method_field('delete') !!}
                           {!! csrf_field() !!}              
                        </form>
                        @if(Auth::user()->hasPermissionTo('users.update'))<a class="icon-btn edit" href="{{ route('Roles.edit',$role->id) }}"><i class="fal fa-trash-alt" id="delete-btn"></i></a>
                        @endif 
                        <a class="icon-btn preview" href="{{ route('Roles.show',$role->id) }}"><i class="fal fa-eye" id="show-btn"></i></a>
                        @if($role->name !="Beautician")
                           {{-- @if($role->name !="Admin") --}}
                                @if($role->name !="Customer")     
                                    <a class="icon-btn edit" href="{{ route('Roles.edit',$role->id) }}"><i class="fal fa-edit" id="show-edit"></i></a>
                                    <a href="javascript:document.getElementById('add-product-form').submit();" class="icon-btn delete"><i class="fal fa-trash-alt" id="delete-btn"></i>
                                    </a>
                                @endif
                          {{--  @endif --}}
                        @endif
                     </td>
                  </tr>
                  @endforeach 
               </tbody>
            </table>
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
