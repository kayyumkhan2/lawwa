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
      <h1>Role info</h1>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('Roles.index')}}">Roles</a></li>
          <li class="breadcrumb-item active" aria-current="page">Role info</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header"> 
  <div class="d-flex justify-content-between">
        <div>
           {{ $role->name }}
        </div>
        <div>
    <a class="btn btn-sm btn-warning text-white" href="javascript:history.go(-1)" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> <a class="btn btn-sm btn-info " href="{{ route('Roles.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Roles</a>
        </div>
   </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="card" style="width: 30rem; margin-left:2%;">
        <div class="card-header">Permissions </div>
        @if(!empty($rolePermissions))
        <ul class="list-group list-group-flush">
          @foreach($rolePermissions as $v)
          <li class="list-group-item text-success">{{ ucwords($v->name) }},</li>
          @endforeach
        </ul>
        @endif </div>
    </div>
  </div>
</div>
@endsection