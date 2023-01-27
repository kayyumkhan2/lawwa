@extends('front::layouts.master')
@section('title') Schedule edit @endsection
@section('content')
@if (count($errors))
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif
<section class="my-account">
  <div class="container">
    <div class="row">
@include('beautician::includes.sidebar')
        <div class="col-lg-9">
          <div class="right-content content">
            <div class="dash__block my-account-header">
                <h2 class="dash__header">Edit Business Time</h2>
                <h6 class="dash__description">Edit an existing business time below.</h6>
                <form class="request" method="POST" action="{{route('beautician.workingtime.update', $bTime->id )}}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="manage-schedule">
                        <div class="form-group">
                            <label>Day</label>
                           <input type="text" class="form-control" value="{{ ucfirst($bTime->day) }}" readonly=""> 
                        </div>
                        <div class="form-group request__flex-container">
                            <div class="request__flex request__flex--left">
                                <label for="times_start_time">Start Time <span class="request__validate">(24 hour format e.g. 17:00 = 05:00 PM)</span></label>
                                <input name="start_time" type="time" id="times_start_time" class="form-control request__input" value="{{ old('start_time') ? old('start_time') :  date('H:i', strtotime($bTime->start_time)) }}" autofocus>
                            </div>
                            <div class="request__flex request__flex--right">
                                <label for="times_end_time">End Time</label>
                                <input name="end_time" type="time" id="times_end_time" class="form-control request__input" value="{{ old('end_time') ? old('end_time') :  date('H:i', strtotime($bTime->end_time)) }}" autofocus>
                            </div>
                        </div>
                        <button class="lawwa-btn" type="submit">Edit Business Time</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection