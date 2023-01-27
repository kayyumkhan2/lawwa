@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
@php
  use Carbon\Carbon;
@endphp
<!-- Lawwa My Account -->
<section class="my-account">
  <div class="container">
    <div class="row">
     @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="feedback-header">
            <h6>{{$pagename}}</h6>
          </div>
           <div class="notification-info member-box">
              @if(!$membership=="")
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                    <th>Amount</th>
                    <!-- <th>Txn id</th> -->
                    <th>Plan name</th>
                    <th>Start</th>
                    <th>End</th>
                    <!-- <th>Payment status</th> -->
                    <th>Benefits</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <td>{{$membership->amount}}</td>
                    <!-- <td>{{$membership->txn_id}}</td> -->
                    <td>{{ucfirst($membership->membership_plan_name)}}</td>
                    <td>{{date_format($membership->created_at,"d-M-Y")}}</td>
                     @php 
                      $EndDate = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $membership->created_at)->addYear();
                     @endphp
                    <td>
                      {{date_format($EndDate,"d-M-Y")}}
                    </td>
                    <!-- <td>{{$membership->payment_status}}</td> -->
                    <td><a href="{{route('customer.membership.show')}}" class="link">View</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              @else
              <div class="notification-info">
                <h6>Membership not found</h6>
                <a href="{{route('pages.membership')}}" class="link"> Become member now </a>
              </div>
              @endif
            {{--@empty
            <div class="singal-notification">
              <div class="table-responsive">
                <table class="table m-0">
                  <tbody>
                    <tr>
                      <td>
                        <table class="table m-0">
                          <tbody>
                            <tr>
                              <td>
                                <div class="notification-info">
                                  <h6>There are no new notifications for you.</h6>
                                </div>
                              </td>  
                            </tr>
                          </tbody>
                        </table>  
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
           @endforelse --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection