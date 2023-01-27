@extends('emails.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Le Tresor Perdu Jewelry</title>
<div id="div1">
  <div id="div2" >
    <table id="table" width="600" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto; background-color: #fff;">
      <tr>
          <td id="td-1">
              <table id="table1">
                  <tr>
                      <td id="td-2">
                        <span><img src="{{ asset('images/logo-icon.png')}}" alt="icon" width="130"></span>
                          <p id="p-1">{{$MailTemplate->subject}}</p>
                          <h2>Order id: #{{$order->id}}</h2>
                          <p id="p-2">{!!$MailTemplate->html_template!!}</p>
                          <a id="a-1" href="{{route('customer.order.details',$order->id)}}">{{$order->current_status}}</a>
                      </td>
                  </tr>
              </table>
          </td>
      </tr>
    </table>

  </div>
</div>
</body>
</html>
@endsection
@section('css')

@endsection