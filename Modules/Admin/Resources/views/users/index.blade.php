@extends('admin::layouts.master')
@section('title') @if($type==0) PBTLA @elseif($type==1)Customers  @else Admin managers @endif @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">@if($type==0) PBTLA @elseif($type==1)Customers @else Admin managers @endif</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">@if($type==0) PBTLA @elseif($type==1) Customers  @else Admin managers @endif</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="row">
      <div class="col-md-12 text-right">
         <a class="btn btn-sm btn-warning text-white rounded-pill" href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back</a>
         <a class="btn btn-sm btn-info rounded-pill" href="@if($type==0) {{ route('users.createbeautician') }}@elseif($type==1){{ route('users.createcustomer') }}@else {{ route('admin.create.manager') }} @endif" > @if($type==0) <i class="fa fa-plus-circle"></i> PBTLA @elseif($type==1) <i class="fa fa-plus-circle"></i> Customers  @else <i class="fa fa-plus-circle"></i> Admin manager @endif</a>
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
                           <th scope="col">Phone Number</th>
                           <th scope="col">Email</th>
                           <th scope="col">Profile Pic</th>
                           @if($type!=0 && $type!=1 ) 
                              <th scope="col">Roles </th>
                           @endif 
                           <th scope="col">Status</th>
                           <th scope="col" class="action"> Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $i=1 @endphp
                        @foreach ($data as $key => $user)
                        @if(!empty($user->getRoleNames()))
                        @if($user->hasRole('Admin') || $user->getRoleNames()->first()==Auth::user()->getRoleNames()->first())
                        @php continue @endphp
                        @endif                                    
                        @endif 
                        {{--@if($user->getRoleNames()->first()==Auth::user()->getRoleNames()->first())
                        @php continue @endphp
                        @endif--}}   
                        <tr class="notification{{$user->id}}">
                           <th scope="row" class="sr-no">{{ $i++ }}</th>
                           <td>{{ $user->full_name }}</td>
                           <td>{{ $user->phone_no }}</td>
                           <td>{{ $user->email }}</td>
                           <td class="user-image">
                              @if($user->profile_pic=='')
                              <span class="img-icon"><img src="{{asset('public/images/profilepics/avatar7.png')}}" alt="img" ></span>
                              @else
                              <span class="img-icon"><img src="{{ asset('public/images/profilepics/'.$user->profile_pic) }}" alt="img" width="100" height="100"></span>
                           </td>
                           @endif
                           @if($type!=0 && $type!=1 )  
                           <td>
                              @if(!empty($user->getRoleNames()))
                              <label class="badge badge-success">{{$user->getRoleNames()->first()}}</label>
                              @endif
                           </td>
                           @endif 
                           <td>
                              <span class="Statuschange badge @if($user->status=='0') badge-danger @else badge badge-success @endif" data-id="{{$user->id}}"  data-model="User" id="Statuschange{{$user->id}}"> @if($user->status=="0") Deactive @else Active @endif </span>
                           </td>
                           <td class="action ">
                              @can('user-show')
                                 @if($user->hasRole('Customer'))
                                    <a class="icon-btn preview" href="{{ route('users.show',$user->id) }}"> <i class="fal fa-eye" id="show-btn"></i></a>
                                 @elseif($user->hasRole('Beautician'))
                                    <a class="icon-btn preview" href="{{ route('users.beauticianprofile',$user->id) }}">
                                       <i class="fal fa-eye" id="show-btn">  </i>
                                    </a>
                                 @else        
                                    <a class="icon-btn preview" href="{{ route('users.adminmanagerprofile',$user->id) }}">
                                       <i class="fal fa-eye" id="show-btn">  </i>
                                    </a>
                                 @endif       
                              @endcan
                              @can('user-edit')                                         
                                 <a class="icon-btn edit" href="{{ route('users.adminmanagerprofileedit',$user->id) }}">
                                    <i class="fal fa-edit" id="show-edit"></i>
                                 </a>
                              @endcan
                              {{--
                                 @can('user-delete')
                                    <a class="icon-btn delete universaldelete" href="javascript:void(0);" data-status="0" data-id="{{ $user->id}}"  data-model="User" id="notification{{$user->id}}" > <i class="fal fa-trash-alt" id="delete-btn"></i></a>                               
                                 @endcan
                              --}}
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
@endsection
@section('js')
<script>
   $('#dataTable').DataTable();
</script>
@endsection
