@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')

<!-- Lawwa My Account -->
<section class="my-work-history">
  <div class="container">
    <div class="row">
      @include('beautician::includes.sidebar')
      <div class="col-lg-9">
        <div class="wallet-header">
          <h2>{{ucwords($pagename)}} </h2>
        </div>
        <div class="table-responsive">
            <table class="table">
              <thead>
                  @if(!$workhistory->isEmpty()) 
                     <tr>
                       <th><span class="ml-3">Booking Deatils</span></th>
                       <th>Services</th>
                       <th>Amount</th>
                       <th>Status</th>
                       <th>Commission</th>
                     </tr>
                  @endif  
            </thead>
            <tbody>
              @foreach($workhistory as $history)
              @php 
                  $data=json_decode($history->booking_info, true); 
                  $booking = (object) $data; 
              @endphp
                <tr>
                  <td>
                    <div class="my-work">
                      <!-- <div class="img-box">
                        <img src="{{asset('front/assets/images/user.png')}}" alt="user">
                      </div> -->
                     <div class="work-history">
                        <h4>@foreach(json_decode($history->customer_info , true) as $key=> $customers)  {{  $customers['full_name'] }} @endforeach</h4>
                        <h5>{{date('D - M -Y', strtotime($booking->date))}} {{ date ('H:i',strtotime($booking->start_time))}}</h5>
                        <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{$booking->location }}</span>
                     </div>
                    </div>
                  </td>
                  <td>@foreach(json_decode($history->services , true) as $key=> $service)  {{  $service['name'] }} @endforeach</td>
                  <td><span class="text-them">RM {{$booking->amount }}</span></td>
                  <td><span class="text-green">{{$booking->current_status }}</span></td>
                  <td class="text-danger">RM {{$history->commission}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        <div class="mt-1 float-right" style="color: #2B3990;"> 
              {{ $workhistory->links() }}
        </div>
      </div>
    </div>
  </div>
</section>

@endsection