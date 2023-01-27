@extends('front::layouts.master')
@section('title') Manage Schedule @endsection
@section('content')
@if (count($errors))
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif
<section class="my-account ">
  <div class="container">
    <div class="row">
@include('beautician::includes.sidebar')
<div class="col-lg-9">
  <div class="right-content content">
    <div class="dash__block my-account-header">
        <h6 class="dash__description">Add a new business time for the week. There must be only one time per day.</h6>
        <form class="request" method="POST" action="{{route('beautician.workingtime.store')}}">
            {{ csrf_field() }}
            <div class="manage-schedule">
                <div class="form-group">
                    <label for="times_day">Day <span class="request__validate">(select a day within the week)</span></label>
                    <select name="day" id="times_day" class="form-control request__input">
                        @foreach (getDaysOfWeek() as $day)
                            <option value="{{ strtoupper($day) }}" {{ old('day') == strtoupper($day) ? 'selected' : null }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group request__flex-container">
                    <div class="request__flex request__flex--left">
                        <label for="times_start_time">Start Time <span class="request__validate">(24 hour format e.g. 17:00 = 05:00 PM)</span></label>
                        <input name="start_time" type="text" id="times_start_time" class="form-control request__input" placeholder="hh:mm" value="{{ old('start_time') ? old('start_time') : '09:00' }}" masked-time>
                    </div>
                </div>
                <div class="form-group request__flex-container">
                    <div class="request__flex request__flex--right">
                        <label for="times_end_time">End Time <span class="request__validate">(24 hour format)</span></label>
                        <input name="end_time" type="text" id="times_end_time" class="form-control request__input" placeholder="hh:mm" value="{{ old('end_time') ? old('end_time') : '17:00' }}" masked-time>
                    </div>
                </div>
                <button class="lawwa-btn" type="submit">Create Business Time</button>
            </div>
        </form>
    </div>
   <div class="dash__block my-account-header">
      <br>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Warning!</strong> Editing/deleting a business time will remove future working times and bookings of that day.
        </div>
        <div class="table-responsive">
            <table class="table calender table-bordered">
                <tr>
                    @foreach (getDaysOfWeek() as $day)
                        <th class="table__day">{{ $day }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach (getDaysOfWeek(true) as $day)
                        <td class="table__day table__right-dotted">
                            @if ($bTime = $bTimes->where('day', $day)->first())
                                <div class="item">
                                    <form method="post" action="{{route('beautician.workingtime.destroy',$bTime->id)}}" id="delete-form">
                                         {!! method_field('delete') !!}
                                         {!! csrf_field() !!}              
                                      
                                    <section class="item__block item__block--no-margin">
                                        <div class="item__message">{{ toTime($bTime->start_time, false) }} - {{ toTime($bTime->end_time, false) }}</div>
                                        <a title="Edit this business time" href="{{route('beautician.workingtime.edit',$bTime->id)}}" class="item__edit"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                        <button type="submit" title="Delete this business time" onclick="return confirm(' you want to delete?');" class="item__remove" data-method="delete"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                         </form>  
                                    </section>
                                </div>
                            @else
                                <div class="table__message">N/A</div>
                            @endif
                        </td>
                    @endforeach
                </tr>
            </table>
        </div>
</div>
  </div>
  </div>
  </div>
</div>
</section>
@endsection