@extends('admin::layouts.master')
@section('title') {{$pagename}} @endsection
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
      <h3>{{$pagename}} info</h3>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('membershipplan.index')}}">{{$pagename}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$pagename}} info</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="card">
<div class="card-header"> 
<div class="d-flex justify-content-between">
      <div>
         {{ $membershipplan->name }}
      </div>
      <div>
  <a class="btn btn-sm btn-warning text-white rounded-pill" href="javascript:history.go(-1)" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;"> <i class="fas fa-arrow-circle-left"></i> Back</a> <a class="btn btn-sm btn-info  rounded-pill" href="{{ route('membershipplan.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;"> <i class="fas fa-american-sign-language-interpreting"></i> {{$pagename}}</a>
      </div>
 </div>
</div>
<div class="card-body">
<div class="row">

  <div class="card" style="width: 30rem; margin-left:2%;">
    <div class="card-header">Membership Featurs </div>
    @if(!empty($membershipfeatures))
    <ul class="list-group list-group-flush">
      @foreach($membershipplan->MembershipFeatures as $v)
      <li class="list-group-item text-success">{{ ucwords($v->name) }},</li>
      @endforeach
    </ul>
    @endif 
  </div>
  <div class="card" style="width: 30rem; margin-left:2%;">
    <div class="card-header">Membership Services </div>
    @if(!empty($membershipplan->MemberShipServices))
    <ul class="list-group list-group-flush">
      @foreach($membershipplan->MemberShipServices as $Services)
        <li class="list-group-item text-primary">{{ ucwords($Services->name) }},</li>
      @endforeach
    </ul>
    @endif 
  </div>
</div>
</div>
</div>
@endsection