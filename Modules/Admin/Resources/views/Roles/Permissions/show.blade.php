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
      <h1>Permission info</h1>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('Permissions.index')}}">Permissions</a></li>
          <li class="breadcrumb-item active" aria-current="page">Permission info</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="card">
<div class="card-header"> 
<div class="d-flex justify-content-between">
      <div>
         {{ $Permission->name }}
      </div>
      <div>
  <a class="btn btn-sm btn-warning text-white" href="{{ URL::previous() }}" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> <a class="btn btn-sm btn-info " href="{{ route('Permissions.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Permissions</a>
      </div>
 </div>
</div>
<div class="card-body">
<div class="row">

  <div class="card" style="width: 30rem; margin-left:2%;">
    <div class="card-header">Permissions </div>
     {{$Permission->name}} 
   </div>
 </div>
</div>
</div>
@endsection