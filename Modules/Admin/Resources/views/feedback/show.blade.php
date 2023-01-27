@extends('admin::layouts.master')
@section('title') Querie info @endsection
@section('content')
<div class="main-content">
   <div class="page-title col-sm-12">
      <div class="row align-items-center">
         <div class="col-md-12">
            <h3>Feedback Info:</h3>
         </div>
         <div class="col-md-12">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb m-0 p-0">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('queries.index')}}">Feedback</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Feedback info</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
<div class="col-sm-12 col-xl-12">
    <div class="card">
       <div class="card-header"> 
            <div class="d-flex justify-content-between">
                <div>Feedback</div>
                <div>
                    <a class="btn btn-sm btn-warning text-white" href="javascript:history.go(-1)" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> <a class="btn btn-sm btn-info " href="{{ route('feedbacks.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Feedbacks</a>
                </div>
            </div>
        </div>
        <div class="card-body">
        <div class="accordion" id="accordion" role="tablist">
            <div class="card mb-0">
                <div class="card-header" id="headingOne" role="tab">
                    <h5 class="mb-0"><a data-toggle="collapse" href="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">Collapse Message</a></h5>
                </div>
                <div class="collapse show" id="collapseOne" role="tabpanel"
                    aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">{{$Feedback->message}}</div>
                </div>
            </div>
        </div>
         <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Name : </strong>{{$Feedback->name}}</li>
            <li class="list-group-item"><strong>Email : </strong>{{$Feedback->email}}</li>
            <li class="list-group-item"><strong>Phone : </strong>{{$Feedback->phone}}</li>
            <li class="list-group-item"><strong>Time : </strong>{{$Feedback->created_at}}</li>
          </ul>
        </div>
    </div>
</div>
@endsection

