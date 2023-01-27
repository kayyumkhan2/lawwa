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
  <table style="background:#ffffff; font-family: 'Open Sans', sans-serif;  border-spacing: 0; border-collapse:collapse; padding: 0px;width: 750px; margin: 0 auto;">
    <tr>
      <td>
        <table style="width: 100%; background-color:#2B3990; padding: 10px; border-radius: 2px;">
          <tr>
            <td>
              <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 16px; color: #fff; text-align: left;">Order Details</h3>
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
              <a href="#" target="_blank"><img src="{{ asset('images/lawwa-brand.png')}}" alt="Lawwa" width="200"></a>
            </td>
            <td>
              <span><a style="display: block; text-align: right; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">{{$order->address}}</a></span>

              <span><a style="display: block; text-align: right; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="mailto:info@lawwa.com" target="_blank">Support:info@lawwa.com</a></span>
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
              <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 16px; color: #fff; text-align: left;">{{$order->user_name}}</h3>
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
              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #d83968; text-decoration: none;" href="#">Congratulations, you have made a order with Lawwa</a></span>

              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Order id : {{ $order->id  }}</a></span>

              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Date : {{ date('d-m-Y') }}</a></span>

              <span><a style="display: block; text-align: left; padding: 5px 0; font-size: 14px; font-family: 'Open Sans', sans-serif; color: #444444; text-decoration: none;" href="#">Status : {{ $order->current_status  }}</a></span>
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
              <h3 style="margin: 0; font-weight: 700; font-family: 'Open Sans', sans-serif; font-size: 16px; color: #fff; text-align: left;">Invoice specification : {{GetPaymentHistoryID($order->txn_id)}}</h3>
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
                    <th style="border-right: 1px solid #ddd; width: 50px; color: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left;">S.No</th>
                    <th style="border-right: 1px solid #ddd; width: 300px; color: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left; ">Description</th>
                    <th style="border-right: 1px solid #ddd; width: 75px; color: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: left;">Quantity</th>
                    <th style="color: #fff; font-size: 16px; width: 125px; line-height: 1.5em; font-family: 'Open Sans', sans-serif; font-weight: 700; padding: 10px; text-align: right;">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1;@endphp
                  @foreach ($order->OrderProducts as $key => $value)
                  <tr>
                    <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left;">{{$i++}}</td>
                    <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left; ">{{$value->product_name}}</td>
                    <td style="border-right: 1px solid #ddd; color: #3C424F; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: left;">{{$value->product_price}} * {{$value->product_quantity}}</td>
                    <td style="color: #3C424F; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; padding: 10px; text-align: right;">RM {{$value->product_price *$value->product_quantity}}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="3" style="color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 500; padding:10px 10px;  text-align: left; background:#2B3990;">Thank you for order <span style="text-align: right; float: right;">Total Amount </span></td>
                    <td style="color: #fff; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 500; padding:10px 10px;  text-align: right; background:#d83968;">{{$order->total_price}}</td>
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

