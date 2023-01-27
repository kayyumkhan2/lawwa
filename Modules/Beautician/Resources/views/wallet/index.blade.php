@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')

<section class="manage-wallet-wrap">
  <div class="container">
    <div class="row">
     @include('beautician::includes.sidebar')
      <div class="col-lg-9">
        <div class="wallet-header">
          <div class="row justify-content-between">
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="manage-wallet">
                <div class="img-block">
                  <img src="{{asset('front/assets/images/lawwa-wallit.png')}}" alt="lawwa-wallit"> 
                </div>
                <div class="wallet">
                  <h4>Lawwa Wallet</h4>
                  <!-- <h5>MYR 30.5</h5> -->
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="total-balance">
                <h4>Total</h4>
                <h5>RM {{$totalwallet}}</h5>
              </div>
            </div>
          </div>
       <!--    <div class="add-money">
            <h3>Add money to Lawwa wallet</h3>
            <div class="row">
              <div class="col-xl-9 col-md-8 col-sm-7">
                <div class="search-bar">
                  <input type="text" class="form-control" placeholder="MYR   Enter Amount">
                </div>
              </div>
              <div class="col-xl-3 col-md-4 col-sm-5 mt-sm-0 mt-3">
                <div class="btn-block">
                  <button type="submit" class="lawwa-btn">Add Money</button>
                </div>
              </div>
            </div>
          </div> -->
          <div class="table-responsive">
            <table class="table table-text">
              <thead>
                @if(!$wallethistory->isEmpty()) 
                  <tr>
                    <th>Transaction</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Date</th>
                  </tr>
                @endif  
                </thead>
              <tbody>
              @forelse($wallethistory as $history)
                <tr>
                  <td align="center">
                    <div class="img-block">
                        <img src="{{asset('front/assets/images/lawwa-wallit.png')}}" alt="lawwa-wallit"> 
                    </div>
                      <h6>{{$history->narration}}</h6>
                  </td>  
                  <td align="center"><span class="them-color">RM {{$history->amount}}</span></td>
                  <td align="center" style="color:{{ $history->type == "Credit" ? 'Green' : 'Red' }} ;">{{ucfirst($history->type)}}</td>
                  <td align="center">{{date('d-m-Y h : i a', strtotime($history->created_at))}}</td>
                </tr>
              @empty
               <tr>
                  <td>
                    <div class="order-history">
                      <div class="order-contant">
                        <h5>There are no wallet history ... </h5>
                      </div>
                    </div>
                  </td>  
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
           @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection