@extends('admin::layouts.master')
@section('title') Edit Notification  @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">Edit Notification</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{route('notifications.index')}}">Notifications</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Notification</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="card">
<div class="card-header"> 
<div class="d-flex justify-content-between">
      <div>
      Edit Notification
      </div>
      <div>
       <a class="btn btn-sm btn-warning text-white" href="javascript:history.go(-1)" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;"><i class="fas fa-arrow-circle-left"></i> Back</a> <a class="btn btn-sm btn-info " href="{{ route('notifications.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;"> <i class="fas fa-paper-plane"></i> Notifications</a>
      </div>
 </div>
</div>
<div class="card-body">
<form action="{{ route('notifications.update',$Notification->notification_id) }}" method="post" id="formid">
   <input name="_method" type="hidden" value="PATCH">
   {{ csrf_field() }}
      <div class="form-group">
         <label for="nf-title">Title</label>
         <input class="form-control" value="{{$Notification->title}}" id="nf-title" maxlength="100" name="title" type="text" name="nf-title"
            placeholder="Enter Notification title.." autocomplete="title">
            @if ($errors->has('title'))
            <span class="invalid feedback" role="alert"> 
                <strong class="text-danger">{{ $errors->first('title') }}.</strong> 
            </span>
          @endif 
        </div>
         <label for="nf-name">Description</label>
         <textarea class="form-control" autocomplete="random"  id="description" name="description">{{$Notification->description}}</textarea>
    @if ($errors->has('description'))
                    <span class="invalid feedback" role="alert"> 
                        <strong class="text-danger">{{ $errors->first('description') }}.</strong> 
                    </span>
            @endif 
          </div>
       <div class="card-footer">
         <button class="btn btn-sm btn-primary" type="submit">Save</button>
         <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
      </div>
</form>
</div>
@endsection
</div>
@section('js')
 <script>
    $(document).ready(function(){
          $("#formid").validate(
          {
              ignore: [],
            debug: false,
              rules: { 
                  description: {
                      required: true,
                      },
                  title: {
                      required: true,
              },
            },
          });
      });
</script>
@endsection

