@extends('emails.layout')
@section('content')
<!DOCTYPE html>
<html>
<head>  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>INVOICE</title>
</head>
<body style="background-color:#fff;">
  <table style="background:#ffffff; font-family: 'Open Sans', sans-serif;  border-spacing: 0; border-collapse:collapse; padding: 0px;  width: 750px; margin: 0 auto;">
    <tr>
      <td>
        <table style="width: 100%; background-color:#2B3990; padding: 10px; border-radius: 2px;">
          <tr>
            <td>
              <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 16px; color: #fff; text-align: left;">Membership Details</h3>
            </td>
            <td>
              <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 16px; color: #fff; text-align: right;">INVOICE</h3>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table style="width: 100%; background-color:#fff; padding: 15px 0;">
          <tr>
            <td>
              <a href="{{ url('/') }}" target="_blank"><img src="{{ asset('images/final-logo.png')}}" alt="Lawwa" width="200"></a>
            </td>
            <td>
              <span> <a style="display: block; text-align: right; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#"><p style="color: 444444; font-size: 14px;">{{$Membership->address}}</p> </a></span>

              <span> <a style="display: block; text-align: right; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="mailto:info@lawwa.com" target="_blank">Support:info@lawwa.com </a></span>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table style="width: 100%; background-color:#2B3990; padding: 10px; border-radius: 2px;">
          <tr>
            <td>
              <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 16px; color: #fff; text-align: left;">{{Auth::user()->full_name}}</h3>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table style="width: 100%; background-color:#fff; padding: 15px 0;">
          <tr>
            <td>
              @php 
                   $EndDate = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $MembershipUser->created_at)->addYear();
                 @endphp
              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #d83968; text-decoration: none;" href="#">Congratulations, you have made a membership with Lawwa</a></span>

              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Membership id : {{ $MembershipUser->id  }}</a></span>

              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Date : {{ date('d-m-Y') }}</a></span>

              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Start : {{date_format($MembershipUser->created_at,"d-M-Y")}} </a></span>

              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">End : {{date_format($EndDate,"d-M-Y")}} </a></span>

              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Plan name :{{$MembershipUser->membership_plan_name}}</a></span>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table style="width: 100%; background-color:#2B3990; padding: 10px; border-radius: 2px;">
          <tr>
            <td>
              <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 16px; color: #fff; text-align: left;">Invoice id : {{GetPaymentHistoryID($MembershipUser->txn_id)}}</h3>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table style="width: 100%; background-color:#fff; border-spacing: 0; border: 1px solid #ddd;">
          <tr>
            <td>
              <table style="width: 100%; background-color: #fff; border-spacing: 0;">
                <thead style="background-color: #d83968; border-radius: 2px;">
                  <tr>
                    <th style="border-right: 1px solid #ddd; width: 136px; color: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left;">S.No</th>
                    <th style="border-right: 1px solid #ddd; width: 450px; color: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left; ">Benefits</th>
                  </tr>
                </thead>
                <tbody>
                   @php $i=1;@endphp
                    @foreach (Auth::user()->UserCurrentMemberShip->MembershipInfo->MembershipFeatures as $Features)
                  <tr>
                    <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left;">{{$i++}}</td>
                    <td style=" color: #3C424F; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left; ">{{$Features->name}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table style="width: 100%; background-color:#2B3990; padding: 10px; border-radius: 2px;">
          <tr>
            <td>
              <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 16px; color: #fff; text-align: left;">Services</h3>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table style="width: 100%; background-color:#fff; border-spacing: 0; border: 1px solid #ddd;">
          <tr>
            <td>
              <table style="width: 100%; background-color: #fff; border-spacing: 0;">
                <thead style="background-color: #d83968; border-radius: 2px;">
                  <tr>
                    <th style="border-right: 1px solid #ddd; width: 300px; color: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left;">S.No</th>
                    <th style="border-right: 1px solid #ddd; width: 450px; color: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left; ">Name</th>
                    <th style="border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 450px; color: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left; ">Services Type</th>
                  </tr>
                </thead>
                <tbody>
                   @php $i=1;@endphp
                    @foreach (Auth::user()->UserCurrentMemberShip->MembershipInfo->MembershipFeatures as $Features)
                  <tr>
                    <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left;">{{$i++}}</td>
                    <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left; ">{{$Features->name}}</td>
                    <td style="color: #3C424F; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left; ">Free</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2" style="color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 500; padding:10px 10px;  text-align: left; background:#2B3990;">Thank you for lawwa.aisa <span style="text-align: right; float: right;">Total Amount </span></td>
                    <td style="color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 500; padding:10px 10px;  text-align: right; background:#d83968;">{{$MembershipUser->amount}}</td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
@endsection
@section('css')
@endsection