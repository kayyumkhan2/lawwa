<!DOCTYPE html>
<html>
<head>  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>INVOICE</title>
</head>
<body style="background-color:#fff;">
<table style="background:#ffffff; font-family: 'Open Sans', sans-serif;  border-spacing: 0; border-collapse:collapse; padding: 0px;  width: 550px; margin: 0 auto;">
<tr>
  <td>
    <table style="width: 100%; background-color:#2B3990; padding: 8px 10px; border-radius: 2px;">
      <tr>
        <td>
           <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #fff; text-align: left;">Booking Details</h3>
        </td>
        <td>
            <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #fff; text-align: right;">INVOICE</h3>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td>
    <table style="width: 100%; background-color:#fff; padding: 5px 0;">
      <tr>
        <td>
          <a href="#" target="_blank" target="_blank"><img src="{{ asset('images/final-logo.png')}}" alt="Lawwa" width="200"></a>
        </td>
        <td>
          <span><a style="display: block; text-align: right; padding: 0; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none; line-height: 22px;" href="#">{{$Booking->location}}</a></span>

          <span><a style="display: block; text-align: right; padding: 5px 0; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="mailto:info@lawwa.com" target="_blank">Support:info@lawwa.com</a></span>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td>
    <table style="width: 100%; background-color:#2B3990; padding: 8px 10px; border-radius: 2px;">
      <tr>
        <td>
          <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #fff; text-align: left;">Booked By : {{ucfirst($Booking->get_user->full_name)}}</h3>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td>
    <table style="width: 100%; background-color:#fff; padding:5px 0;">
      <tr>
        <td>
          <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #d83968; text-decoration: none;" href="#">Congratulations, you have made a booking with Lawwa</a></span>

          <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Booking id : {{$Booking->id}}</a></span>

          <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Date : {{ date('d-m-Y') }} start time : {{ date('G:i', strtotime($Booking->start_time))}} end time:  {{ date('G:i', strtotime($Booking->end_time))}}</a></span>

          <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Status : {{ $Booking->current_status  }}</a></span>

          <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 13px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Invoice id : {{GetPaymentHistoryID($Booking->txn_id)}}</a></span>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td>
    <table style="width: 100%; background-color:#2B3990; padding: 8px 10px; border-radius: 2px;">
      <tr>
        <td>
          <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 14px; color: #fff; text-align: left;">Services</h3>
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
                <th style="border-right: 1px solid #ddd; width: 50px; color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left;">S.No</th>
                <th style="border-right: 1px solid #ddd; width: 300px; color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left; ">Description</th>
                <th style="border-right: 1px solid #ddd; width: 75px; color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left;">Quantity</th>
                <th style="color: #fff; font-size: 14px; width: 125px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: right;">Amount</th>
              </tr>
            </thead>
            <tbody>
              @php $i=1;@endphp
              @foreach ($Booking->ServiceDetails as $key => $value)
              <tr>
                <td style="border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; color: #3C424F; font-size: 13px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left;">{{$i++}}</td>
                <td style="border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; color: #3C424F; font-size: 13px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left; ">{{ucfirst($value->name)}}</td>
                <td style="border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; color: #3C424F; font-size: 13px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left;">{{($Booking->BookingUsers)->count()}}</td>
                <td style="color: #3C424F; border-bottom: 1px solid #ddd; font-size: 13px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: right;">RM {{$value->amount}} * {{($Booking->BookingUsers)->count()}}</td>
              </tr>
               @endforeach
              <tr>
                <td colspan="3" style="color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif !important; font-weight: 700; padding:10px 10px;  text-align: left; background:#2B3990; border-radius: 3px;">Thank you for booking <span style="text-align: right; float: right;">Total Amount </span></td>
                <td style="color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif !important; font-weight: 700; padding:10px 10px;  text-align: right; background:#d83968; border-radius: 2px;">RM {{($Booking->amount)*($Booking->BookingUsers)->count()}}</td>
              </tr>
            </tbody>
          </table>
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
                <th style="border-right: 1px solid #ddd; width: 50px; color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left;">S.No</th>

                <th style="border-right: 1px solid #ddd; width: 200px; color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left; ">Email</th>

                <th style="border-right: 1px solid #ddd; width: 100px; color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left; ">Full name</th>

                <th style="border-right: 1px solid #ddd; width: 75px; color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left;">Phone no.</th>

                <th style="color: #fff; font-size: 14px; width: 125px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: right;">Emergency no.</th>
              </tr>
            </thead>
            <tbody>
              @php $i=1;@endphp
              @foreach ($Booking->BookingUsers as $key => $users)
              <tr>
                <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 13px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left;">{{$i++}}</td>

                <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 13px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left; ">{{$users->email}}</td>

                <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 13px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left; ">{{ucfirst($users->full_name)}}</td>

                <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 13px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left;">{{$users->phone_no}}</td>

                <td style="color: #3C424F; font-size: 13px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: right;"> 
                  @if($users->UserProfileInformation!="")
                  {{ucfirst($users->UserProfileInformation->Emergency_Number)}} 
                  @endif
                </td>
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
    <table style="width: 100%; background-color:#2B3990; border-radius: 2px; padding: 8px 10px; margin-top: 30px">
      <tr>
        <td style="width: 55%;"> 
          <p style="color: #fff;  font-size: 13px; font-family: 'Open Sans', sans-serif; padding: 0; margin: 0; text-align: left;">Copyright © 2021 <a style="text-decoration: none; color: #fff;" href="https://lawwa.ezxdemo.com">Lawwa.Asia</a> All Rights Reserved.</p>
        </td>
        <td style="width: 45%;">
          <ul style="margin: 0; padding: 0;">
            <li style="list-style: none; display: inline-block; padding-left: 10px; padding-top: 5px;">
              <a style="font-size: 13px; color: #fff; font-family: 'Open Sans', sans-serif; text-decoration: none;" href="http://lawwa.ezxdemo.com/terms-condition">Terms &amp; Conditions</a></li>

            <li style="list-style: none; display: inline-block; padding-left: 10px; padding-top: 5px;">
              <a style="font-size: 13px; color: #fff; font-family: 'Open Sans', sans-serif; text-decoration: none;" href="http://lawwa.ezxdemo.com/privacy-policy">Privacy Policy</a></li>

            <li style="list-style: none; display: inline-block; padding-left: 10px; padding-top: 5px;">
              <a style="font-size: 13px; color: #fff; font-family: 'Open Sans', sans-serif; text-decoration: none;" href="http://lawwa.ezxdemo.com/faq">FAQ</a></li>
          </ul>
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>
</body>
</html>