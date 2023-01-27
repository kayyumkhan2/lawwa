@extends('admin::layouts.master')
@section('title') Show @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1 class="h3 m-0">Profile</h1>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
           <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
          <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="col-sm-12">
  <div class="row">
    <div class="col-lg-12 col-md-4 mb-4">
      <div class="card">
            <div class="card-header bg-white">
              <a href="{{ route('users.edit',$user->id) }}">
                <span class="badge badge-success ">Edit</span>
              </a>
              <a href="{{route('users.index')}}">
                <span class="badge badge-info float-right " style="margin-left: 10px">Users</span>
              </a>
              <a href="javascript:history.go(-1)">
                <span id="exportData" class="badge badge-warning float-right">Back</span>
              </a>
            </div>
        </div>
      <div class="box bg-white">
        <div class="container mt-4">
          <div class="main-body">
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center"> <img src="{{ !$user->profile_pic=='' ? asset('public/images/profilepics/'.$user->profile_pic) : asset('public/images/profilepics/avatar7.png') }}" alt="Admin" class="img-thumbnail" >
                      <div class="mt-3">
                        <h4>{{ $user->full_name }}</h4>
                        <p class="text-secondary mb-1">{{ $user->email }}</p>
                        <p class="text-muted font-size-sm">{{ $user->Address_Location }}</p>
                        @if(!$user->UserProfileInformation=="")
                          @if(!$user->UserProfileInformation->Id_Proof=="")
                            <a href="{{ asset('images/customerphotos/'.$user->UserProfileInformation->Id_Proof) }}" class="btn btn-primary">Id Proof</a> 
                          <!-- <button class="btn btn-outline-primary">Message</button> -->
                          @endif
                        @endif
                        </div>
                    </div>
                  </div>
                </div>
            @if($user->getRoleNames()->first()=="Customer")
              <div class="card mt-3">
                  <div class="tabs-titale">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link active" id="v-pills-home-tab " data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><h6 class="mb-0"><i class="fad fa-hand-holding-box" style="width="24"; height="24";"></i> Orders</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$totalorderscount}}</span></span> </a>
                      <a class="nav-link" id="v-pills-transaction-tab" data-toggle="pill" href="#v-pills-transaction" role="tab" aria-controls="v-pills-transaction" aria-selected="false"><h6 class="mb-0"><i class="fad fa-list-alt"></i> Transaction History</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$transactionhistorycount}}</span></span></a>
                      <a class="nav-link" id="v-pills-address-tab" data-toggle="pill" href="#v-pills-address" role="tab" aria-controls="v-pills-address" aria-selected="false"><h6 class="mb-0"><i class="fas fa-book"></i> Address Book</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$totaladdresscount}}</span></span></a>
                      <a class="nav-link" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="false"><h6 class="mb-0"><i class="far fa-bell"></i> Notifications</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$notificationscount}}</span></span></a>
                      <a class="nav-link" id="v-pills-bookings-tab" data-toggle="pill" href="#v-pills-bookings" role="tab" aria-controls="v-pills-bookings" aria-selected="false"><h6 class="mb-0"><i class="far fa-calendar-alt"></i> Bookings</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$bookingcount}}</span></span></a>
                    </div>
                  </div>
                </div>
           @endif    
            </div>
              <div class="col-md-8">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Name</h6>
                      </div>
                      <div class="col-sm-9 text-danger"> {{ $user->full_name }} </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Email</h6>
                      </div>
                      <div class="col-sm-9 text-danger"> {{ $user->email }} </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Mobile</h6>
                      </div>
                      <div class="col-sm-9 text-danger"> {{ $user->phone_no }} </div>
                    </div>
                    @if(!$user->UserProfileInformation=="")
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Emergency Number</h6>
                      </div>
                      <div class="col-sm-9 text-danger"> {{ $user->UserProfileInformation->Emergency_Number }} </div>
                    </div>
                    @endif 
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Avg Rating</h6>
                      </div>
                      <div class="col-sm-9 text-danger"> {{round(($user->UserReviewGet)->avg('rating'),1)}}</div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Total Reviews</h6>
                      </div>
                      <div class="col-sm-9 text-danger"> {{($user->UserReviewGet)->count()}}</div>
                    </div>
                    <hr>
                    @if(!$user->HealthConditionStatus=="")
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0 text-primary">Health Conditions</h6>
                        </div>
                        <div class="col-sm-9 text-danger">
                          <a href="{{route('users.healthconditionsform',$user->HealthConditionStatus->id)}}">Download</a>
                        </div>
                      </div>
                      <hr>
                    @endif
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Membership Status</h6>
                      </div>
                      <div class="col-sm-9 text-danger">
                        @if(MemberShipStatusCheck($user))
                          <b class="text-danger">From</b> : <span class="badge badge-dark"> {{MemberShipStatusCheck($user,'membershipinfo')['from']}}</span>
                          <b style="padding-left: 10px;">To</b> : <span class="badge badge-dark"> {{MemberShipStatusCheck($user,'membershipinfo')['to']}} </span> <b style="padding-left: 10px;">Days remaing</b> : <span class="badge badge-dark"> {{MemberShipStatusCheck($user,'membershipinfo')['daysremaing']}} </span>
                          @else Not membership user  
                        @endif  
                      </div>
                    </div>
                  </div>
                </div>
                 @if($user->getRoleNames()->first()=="Customer")
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <div class="card h-100">
                        <div class="card-body">
                          <table id="Orderstable" class="table table-striped table-bBookinged table-hover ">
                            <thead>
                              <tr>
                                <th scope="col" class="sr-no">#Id</th>
                                <th scope="col">Address</th>
                                <th scope="col">Price</th>
                                <th scope="col">Order At</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="action">action</th>
                            </thead>
                            <tbody>
                          @php $i=1 @endphp
                          @foreach ($orders  as $order)
                            <tr>
                              <td>{{ $order->id }}</td>
                              <td>{{ $order->address  }} </td>
                              <td>{{ $order->total_price  }} </td>
                              <td>{{date('d-m-Y', strtotime($order->created_at))}}</td>
                             <td>
                            @if($order->current_status=='DELIVERED')
                                  <span class="badge badge-success status{{$order->id}}"> {{ $order->current_status  }} </span>
                                @elseif($order->current_status=='PENDING') 
                                  <span class="badge badge-warning status{{$order->id}}"> {{ $order->current_status  }} </span>
                                @elseif($order->current_status=='PAYMENTFAILED') 
                                  <span class="badge badge-warning status{{$order->id}}"> {{ $order->current_status  }} </span>
                                @elseif($order->current_status=='CANCEL') 
                                  <span class="badge badge-danger status{{$order->id}}">  {{ $order->current_status  }}  </span> 
                                @elseif($order->current_status=='ORDERED') 
                                  <span class="badge badge-secondary status{{$order->id}}"> {{ $order->current_status  }} </span> 
                                @elseif($order->current_status=='DISPATCH') 
                                  <span     class="badge badge-info status{{$order->id}}"> {{ $order->current_status  }} </span>
                                @elseif($order->current_status=='ONTHEWAY') 
                                  <span class="badge badge-secondary status{{$order->id}}"> {{ $order->current_status  }} </span>
                                @elseif($order->current_status=='REFUNDED') 
                                  <span class="badge badge-secondary status{{$order->id}}"> {{ $order->current_status  }} </span>
                            @endif
                              <td class="action float-left"><a class="icon-btn preview" href="{{ route('orders.show',$order->id) }}"> <i class="fal fa-eye" id="show-btn"></i></a>  </td>
                            </tr>
                            @endforeach
                              </tbody>
                          </table>
                        </div>
                        <div class="mt-1 float-right"> 
                          {{ $orders->links() }}
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-transaction" role="tabpanel" aria-labelledby="v-pills-transaction-tab">
                      <div class="card h-100">
                        <div class="card-body">
                          <table id="transaction" class="table table-striped table-bBookinged table-hover ">
                            <thead>
                              <tr>
                                <th scope="col" class="sr-no">#</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Txn_id</th>
                                <th scope="col">Type </th>
                                <th scope="col">Date </th>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                          @foreach ($transactionhistory  as $transaction)
                            <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $transaction->amount }}</td>
                              <td>{{ $transaction->txn_id  }} </td>
                              <td>{{ $transaction->type   }} </td>
                              <td>{{date('d-m-Y', strtotime($transaction->created_at))}}</td>
                            </tr>
                            @endforeach
                              </tbody>
                          </table>
                        </div>
                        <div class="mt-1 float-right"> 
                          {{ $transactionhistory->links() }}
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
                      <div class="card h-100">
                        <div class="card-body">
                          <table id="AddressBook" class="table table-striped table-bBookinged table-hover ">
                            <thead>
                              <tr>
                                <th scope="col" class="sr-no">Id</th>
                                <th scope="col">Type</th>
                                <th scope="col">Address</th>
                                <th scope="col">Created At</th>
                            </thead>
                            <tbody>
                          @php $i=1 @endphp
                          @foreach ($address  as $selected_address)
                            <tr>
                              <td>{{ $i++}}</td>
                              <td>{{$selected_address->Type}} </td>
                              <td>{{$selected_address->Name.' , '.$selected_address->MobileNumber.' , '.$selected_address->Address_line1.' , '.$selected_address->GetCity->name.','.$selected_address->Zip_Postcode.' ('.$selected_address->GetState->name.') , '.$selected_address->GetCountry->name}} </td>
                              <td>{{date('d-m-Y', strtotime($selected_address->created_at))}}</td>
                            </tr>
                            @endforeach  
                              </tbody>
                          </table>
                        </div>
                        <div class="mt-1 float-right"> 
                          {{ $address->links() }}
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-notifications" role="tabpanel" aria-labelledby="v-pills-notifications-tab">
                      <div class="card h-100">
                        <div class="card-body">
                            <table id="notifications" class="table table-striped table-bBookinged table-hover ">
                            <thead>
                              <tr>
                                <th scope="col" class="sr-no">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Created At</th>
                            </thead>
                            <tbody>
                            
                            @php $i=1 @endphp
                          @foreach ($notifications  as $notification)
                            <tr>
                              <td>{{ $i++}}</td>
                              <td>{{$notification->title}} </td>
                              <td>{{$notification->type}}  </td>
                              <td>{{date('d-m-Y', strtotime($notification->created_at))}}</td>
                            </tr>
                            @endforeach 
                              </tbody>
                          </table>
                        </div>
                        <div class="mt-1 float-right"> 
                          {{ $notifications->links() }}
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-bookings" role="tabpanel" aria-labelledby="v-pills-bookings-tab">
                      <div class="card h-100">
                        <div class="card-body">
                          <table id="bookings" class="table table-striped table-bBookinged table-hover ">
                            <thead>
                              <tr>
                                <th scope="col" class="sr-no">Id</th>
                                <th scope="col">amount</th>
                                <th scope="col">location</th>
                                <th scope="col">type</th>
                                <th scope="col">date</th>
                                <th scope="col" class="action">status</th>
                                <th scope="col" class="action">action</th>
                            </thead>
                            <tbody>
                            
                            @php $i=1 @endphp
                          @foreach ($bookings  as $Booking)
                            <tr>
                              <td>{{ $i++}}</td>
                              <td>{{$Booking->amount}} </td>
                              <td>{{$Booking->location}} </td>
                              <td>{{ $Booking->type }} </td>
                              <td>{{date('d-m-Y', strtotime($Booking->date))}}</td>
                              <td>
                                @if($Booking->BookingStatusCurrentStatus!='') 
                                    @if($Booking->BookingStatusCurrentStatus->status=="Booked")
                                    <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                                    @elseif($Booking->BookingStatusCurrentStatus->status=='Assigned')
                                     <span class="badge badge-info"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>@elseif($Booking->BookingStatusCurrentStatus->status=='Reached')
                                     <span class="badge badge-success"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>@elseif($Booking->BookingStatusCurrentStatus->status=='Accepted')
                                     <span class="badge badge-warning"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                                    @elseif($Booking->BookingStatusCurrentStatus->status=='OnTheWay')
                                     <span class="badge badge-danger"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span> 
                                    @elseif($Booking->BookingStatusCurrentStatus->status=='PaymentFailed')
                                    <span class="badge badge-danger"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span> 
                                    @elseif($Booking->BookingStatusCurrentStatus->status=='Postponed')
                                     <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }}</span>@elseif($Booking->BookingStatusCurrentStatus->status=='Cancel')
                                      <span class="badge badge-info"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                                    @elseif($Booking->BookingStatusCurrentStatus->status=='Start')
                                     <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                                    @elseif($Booking->BookingStatusCurrentStatus->status=='Completed') 
                                    <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                                    @elseif($Booking->BookingStatusCurrentStatus->status=='Refunded')
                                    <span class="badge badge-secondary"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                                    @elseif($Booking->BookingStatusCurrentStatus->status=='Pending')
                                    <span class="badge badge-warning"> {{ $Booking->BookingStatusCurrentStatus->status  }} </span>
                                  @endif
                                @endif
                              </td>
                              <td class="action float-left"><a class="icon-btn preview" href="{{ route('bookings.show',$Booking->id) }}"> <i class="fal fa-eye" id="show-btn"></i></a>  </td>
                            </tr>
                            @endforeach 
                              </tbody>
                          </table>
                        </div>
                        <div class="mt-1 float-right"> 
                          {{ $bookings->links() }}
                        </div>
                      </div>
                    </div>
                  </div>
                 @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js') 
<script>
   $(document).ready( function () {
    $('#Orderstable').DataTable();
});
</script>
<script>
   $(document).ready( function () {
    $('#bookings').DataTable();
});
</script> 
<script>
   $(document).ready( function () {
    $('#notification').DataTable();
});
</script> 
<script>
   $(document).ready( function () {
    $('#AddressBook').DataTable();
});
</script> 
<script>
   $(document).ready( function () {
    $('#transaction').DataTable();
});
</script>
<script>
   $(document).ready( function () {
    $('#notifications').DataTable();
});
</script> 
@endsection