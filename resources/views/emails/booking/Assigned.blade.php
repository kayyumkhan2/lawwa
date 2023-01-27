@extends('emails.layout')
@section('content')
<div id="div1">
  <div id="div2" >
    <table id="table">
      <tr>
          <td id="td-1">
              <table id="table1">
                  <tr>
                      <td id="td-2">
                        <span><img src="{{ asset('images/logo-icon.png')}}" alt="icon" width="130"></span>
                          <p id="p-1">{{$MailTemplate->subject}}</p>
                          <h2>Booking id: #{{$Booking->id}}</h2>
                          <p id="p-2">{!!$MailTemplate->html_template!!}</p>
                          <a id="a-1" href="{{route('customer.Booking.Details',$Booking->id)}}">{{$Booking->current_status}}</a>
                      </td>
                  </tr>
              </table>
          </td>
      </tr>
    </table>
  </div>
</div>
@endsection
@section('css')

@endsection