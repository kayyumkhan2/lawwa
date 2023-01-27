<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Models\{User,Order,Product,Booking,PaymentHistory,Certificate,CertificateUser};
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

    // ELAHIA APIES  Get Token            
        // $response = Http::post('http://test.giglogisticsse.com/api/thirdparty/login', [
        //     'username' => 'ACC001052',
        //     'Password' => '1234567',
        //     'SessionObj' => '',
        // ]);
        // $obj = json_decode($response,true);
        // return $obj['Object']['access_token'];
        // die();


    // //Track Shipment item
    //  return   $response = Http::withToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1laWQiOiJkYzhiOWFlMC1mZWExLTQ4MGYtOGZiYS1hYjg3Y2IwM2IwMTMiLCJ1bmlxdWVfbmFtZSI6IkFDQzAwMTA1MiIsImh0dHA6Ly9zY2hlbWFzLm1pY3Jvc29mdC5jb20vYWNjZXNzY29udHJvbHNlcnZpY2UvMjAxMC8wNy9jbGFpbXMvaWRlbnRpdHlwcm92aWRlciI6IkFTUC5ORVQgSWRlbnRpdHkiLCJBc3BOZXQuSWRlbnRpdHkuU2VjdXJpdHlTdGFtcCI6ImMxODllNWRlLTk4N2UtNDFkYi04MmUyLWJiYzBiYzM5YTVkNyIsInJvbGUiOiJUaGlyZFBhcnR5IiwiQWN0aXZpdHkiOlsiQ3JlYXRlLlRoaXJkUGFydHkiLCJEZWxldGUuVGhpcmRQYXJ0eSIsIlVwZGF0ZS5UaGlyZFBhcnR5IiwiVmlldy5UaGlyZFBhcnR5Il0sIlByaXZpbGVnZSI6IlB1YmxpYzpQdWJsaWMiLCJpc3MiOiJodHRwczovL2FnaWxpdHlzeXN0ZW1hcGlkZXZtLmF6dXJld2Vic2l0ZXMubmV0LyIsImF1ZCI6IjQxNGUxOTI3YTM4ODRmNjhhYmM3OWY3MjgzODM3ZmQxIiwiZXhwIjoxNjI5ODk2OTI4LCJuYmYiOjE2Mjk0NjQ5Mjh9.3df7BdAJq7FTuj5MIW5zFEmu-xiive4V_NOXasGsywE')->get('http://test.giglogisticsse.com/api/thirdparty/TrackAllShipment/1348000181');



// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'http://test.giglogisticsse.com/api/thirdparty/price',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'{
//     "ReceiverAddress": "Dominos Pizza Gbagada,1A Idowu Olaitan St, Gbagada, Lagos, Nigeria", 
//          "CustomerCode": "ECO001449",
//         "SenderLocality": "Ifako Ijaye",
//          "SenderAddress": "21 Emmanuel Olorunfemi St, Ifako Agege, Lagos, Nigeria", 
//         "ReceiverPhoneNumber": "08039322440", 
//         "VehicleType": "BIKE", 
//         "SenderPhoneNumber": "+2347063965528", 
//         "SenderName": "TEST ECOMMERCE IT", 
//         "ReceiverName": "Ehinomen", 
//          "UserId": "45456", 
//          "ReceiverStationId": "4",
//           "SenderStationId": "5",
//         "ReceiverLocation": 
//         {
//          "Latitude": "6.5483775", 
//          "Longitude": "3.3883414"
//          }, 
//          "SenderLocation": 
//          {
//              "Latitude": "6.639438", 
//              "Longitude": "3.330983"
//         },
//         "PreShipmentItems": 
//         [ 
//             {
//                 "SpecialPackageId": "0", 
//                 "Quantity": "1", 
//                 "Weight": "1", 
//                 "ItemType": "Normal", 
//                 "WeightRange": "0", 
//                 "ItemName": "Shoe Lace", 
//                 "Value": "1000", 
//                 "ShipmentType": "Regular" 
//             }
//         ]
       
// }',
//   CURLOPT_HTTPHEADER => array(
//     'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1laWQiOiJkYzhiOWFlMC1mZWExLTQ4MGYtOGZiYS1hYjg3Y2IwM2IwMTMiLCJ1bmlxdWVfbmFtZSI6IkFDQzAwMTA1MiIsImh0dHA6Ly9zY2hlbWFzLm1pY3Jvc29mdC5jb20vYWNjZXNzY29udHJvbHNlcnZpY2UvMjAxMC8wNy9jbGFpbXMvaWRlbnRpdHlwcm92aWRlciI6IkFTUC5ORVQgSWRlbnRpdHkiLCJBc3BOZXQuSWRlbnRpdHkuU2VjdXJpdHlTdGFtcCI6ImMxODllNWRlLTk4N2UtNDFkYi04MmUyLWJiYzBiYzM5YTVkNyIsInJvbGUiOiJUaGlyZFBhcnR5IiwiQWN0aXZpdHkiOlsiQ3JlYXRlLlRoaXJkUGFydHkiLCJEZWxldGUuVGhpcmRQYXJ0eSIsIlVwZGF0ZS5UaGlyZFBhcnR5IiwiVmlldy5UaGlyZFBhcnR5Il0sIlByaXZpbGVnZSI6IlB1YmxpYzpQdWJsaWMiLCJpc3MiOiJodHRwczovL2FnaWxpdHlzeXN0ZW1hcGlkZXZtLmF6dXJld2Vic2l0ZXMubmV0LyIsImF1ZCI6IjQxNGUxOTI3YTM4ODRmNjhhYmM3OWY3MjgzODM3ZmQxIiwiZXhwIjoxNjI5ODk2OTI4LCJuYmYiOjE2Mjk0NjQ5Mjh9.3df7BdAJq7FTuj5MIW5zFEmu-xiive4V_NOXasGsywE',
//     'Content-Type: application/json'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;

//       return   $response = Http::withToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1laWQiOiJkYzhiOWFlMC1mZWExLTQ4MGYtOGZiYS1hYjg3Y2IwM2IwMTMiLCJ1bmlxdWVfbmFtZSI6IkFDQzAwMTA1MiIsImh0dHA6Ly9zY2hlbWFzLm1pY3Jvc29mdC5jb20vYWNjZXNzY29udHJvbHNlcnZpY2UvMjAxMC8wNy9jbGFpbXMvaWRlbnRpdHlwcm92aWRlciI6IkFTUC5ORVQgSWRlbnRpdHkiLCJBc3BOZXQuSWRlbnRpdHkuU2VjdXJpdHlTdGFtcCI6ImMxODllNWRlLTk4N2UtNDFkYi04MmUyLWJiYzBiYzM5YTVkNyIsInJvbGUiOiJUaGlyZFBhcnR5IiwiQWN0aXZpdHkiOlsiQ3JlYXRlLlRoaXJkUGFydHkiLCJEZWxldGUuVGhpcmRQYXJ0eSIsIlVwZGF0ZS5UaGlyZFBhcnR5IiwiVmlldy5UaGlyZFBhcnR5Il0sIlByaXZpbGVnZSI6IlB1YmxpYzpQdWJsaWMiLCJpc3MiOiJodHRwczovL2FnaWxpdHlzeXN0ZW1hcGlkZXZtLmF6dXJld2Vic2l0ZXMubmV0LyIsImF1ZCI6IjQxNGUxOTI3YTM4ODRmNjhhYmM3OWY3MjgzODM3ZmQxIiwiZXhwIjoxNjI5ODk2OTI4LCJuYmYiOjE2Mjk0NjQ5Mjh9.3df7BdAJq7FTuj5MIW5zFEmu-xiive4V_NOXasGsywE')->withBody(json_encode([
//                     'ReceiverAddress' => 'Dominos Pizza Gbagada,1A Idowu Olaitan St, Gbagada, Lagos, Nigeria',
//                       'CustomerCode' => 'ECO001449',
//                       'SenderLocality' => 'Ifako Ijaye',
//                       'SenderAddress' => '21 Emmanuel Olorunfemi St, Ifako Agege, Lagos, Nigeria',
//                       'ReceiverPhoneNumber' => '08039322440',
//                       'VehicleType' => 'BIKE',
//                       'SenderPhoneNumber' => '+2347063965528',
//                       'SenderName' => 'TEST ECOMMERCE IT',
//                       'ReceiverName' => 'Ehinomen',
//                       'UserId' => '45456',
//                       'ReceiverStationId' => '4',
//                       'SenderStationId' => '5',
//                       'ReceiverLocation' => "",
//                       'PreShipmentItems'=>array('SpecialPackageId' => '0',
//                       'Quantity' => '1',
//                       'Weight' => '1',
//                       'ItemType' => 'Normal',
//                       'WeightRange' => '0',
//                       'ItemName' => 'Shoe Lace',
//                       'Value' => '1000',
//                       'ShipmentType' => 'Regular'),
//                 ]),'application/json')->post('http://test.giglogisticsse.com/api/thirdparty/price');





// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://myopenapi.gdexpress.com/api/demo/prime/GetConsignmentDocument?accountNo=1532486',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'[
//   "TCN1017107"
// ]
// ',
//   CURLOPT_HTTPHEADER => array(
//     'ApiToken: 2626e67d-f58c-496e-b169-057b61788b7b',
//     'Subscription-Key: 426bab58c16c441ebb2d36133a92483e',
//     'Content-Type: application/json',
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// return $response;
   
// die();
// SkyposyApi  Tracking api      
// return $response = Http::withHeaders([
//                     'ApiToken' => '2626e67d-f58c-496e-b169-057b61788b7b',
//                     'Subscription-Key' => '426bab58c16c441ebb2d36133a92483e',
//                     'Content-Type' => "application/json"
//                 ])->withBody(json_encode([
//                         "access_token"=>"C4447448-D5F0-484D-B3FA-5B2E07A83094",
//                         "awbs"=>array(["awbnumber"=>"23879082990"]),
//                 ]),'application/json')
//                 ->post('http://api.skynet.com.my/api/sn/pub/AWBTracking');

//     //Skypost Print Api            
    // return $response = Http::withHeaders([
    //                 'ApiToken' => '2626e67d-f58c-496e-b169-057b61788b7b',
    //                 'Subscription-Key' => '426bab58c16c441ebb2d36133a92483e',
    //                 'Content-Type' => "application/json"
    //             ])->withBody(json_encode([
    //                     "access_token"=>"C4447448-D5F0-484D-B3FA-5B2E07A83094",
    //                     "CODType"=> "",
    //                     "printFormat"=> "Sticker",
    //                     "ShippingDate"=>"2021-09-08",
    //                     "accountNo"=>"10000",
    //                     "ReturnType"=>"PDF",
    //                     "shipperRef"=>"Test111",
    //             ]),'application/json')
    //             ->post('http://api.skynet.com.my/api/Skynet/PrintAWB');
                /*return $response;*/

      // return  $response = Http::withHeaders([
      //               'ApiToken' => '2626e67d-f58c-496e-b169-057b61788b7b',
      //               'Subscription-Key' => '426bab58c16c441ebb2d36133a92483e',
      //               'Content-Type' => "application/json"
      //           ])->withBody(json_encode([[
      //                   'accountNo' => 'TCN1017107',
      //           ]]),'application/json')->post('https://myopenapi.gdexpress.com/api/demo/prime/GetConsignmentDocument',[
      //                   'accountNo' => '1532486',
      //               ]);
      //           /*return $response;*/
      //           $data = json_decode($response);

        $date =Carbon::today()->subDays(7);
        $beauticians = User::role('Beautician')->count();
        $customers = User::role('Customer')->count();
        $totalorders = Order::all()->count();
        $totalproducts = Product::all()->count();
        $totalbookings = Booking::all()->count();
        $RevenueBooking = PaymentHistory::where('type',"Booking")->sum('amount');
        $RevenueOrder = PaymentHistory::where('type',"Order")->sum('amount');
        $RevenueMembership = PaymentHistory::where('type',"Membership")->sum('amount');
        $RevenueCourse = PaymentHistory::where('type',"Course")->sum('amount');
        $CountCertification = CertificateUser::count();
        $membershipcustomers = User::where('membership_plan_id', '!=', 0)->count();  
        $data = array(
            'RevenueBooking'=>$RevenueBooking,
            'RevenueOrder'=>$RevenueOrder,
            'RevenueCourse'=>$RevenueCourse,
            'RevenueMembership'=>$RevenueMembership,
            'RevenueCertification'=>$CountCertification,
            'totalproducts'=>$totalproducts,
            'totalorders'=>$totalorders,
            'totalbookings'=>$totalbookings,
            'beauticians'=>$beauticians,
            'customers'=>$customers,
            'membershipcustomers'=>$membershipcustomers,
        );
    return view('admin::dashboard')->with($data);
    }
}
