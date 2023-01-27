@extends('admin::layouts.master')
@section('title') Notification info @endsection
@section('content')
<div class="main-content">
   <div class="page-title col-sm-12">
      <div class="row align-items-center">
         <div class="col-md-6">
            <h3>Notification info </h3>
         </div>
         <div class="col-md-6">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('notifications.index')}}">notifications</a></li>
               <li class="breadcrumb-item active" aria-current="page">notifications Show</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
  <div class="card">
<div class="card-header"> 
<div class="d-flex justify-content-between">
      <div>
     {{ $Notification->title }}
      </div>
      <div>
       <a class="btn btn-sm btn-warning text-white" href="javascript:history.go(-1)" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;"><i class="fas fa-arrow-circle-left"></i>  Back</a> <a class="btn btn-sm btn-info " href="{{ route('notifications.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;"><i class="fas fa-paper-plane"></i>Notifications</a>
      </div>
 </div>
</div>
      <div class="card-body">
      </div>
       <div class="card-body">
         {!! $Notification->description !!}
      </div>
      @if($Notification->NotificationAttachments !="")
         <!-- <img src="images/notificationattachments"> -->
      @endif
   </div>
</div>
@endsection

