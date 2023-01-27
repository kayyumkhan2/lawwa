@extends('admin::layouts.master')
@section('title') Profile @endsection
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
                    <span id="exportData" class="badge badge-warning float-right">
                       Back
                    </span>
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
                        @if($user->UserProfileInformation !="")
                          @if($user->UserProfileInformation->Id_Proof !="")
                            <a href="{{ asset('images/beauticiansdocs/'.$user->UserProfileInformation->Id_Proof) }}" class="btn btn-primary">Id Proof</a>
                          @endif
                        @endif
                        @if($user->BeauticianDocs !="") 
                          <a href="{{ asset('images/beauticiansdocs/'.$user->BeauticianDocs->doc) }}" class="btn btn-primary">Certificate</a>
                        @endif 
                      </div>
                    </div>
                  </div>
                </div>
            @if($user->getRoleNames()->first()=="Beautician")
              <div class="card mt-3">
                  <div class="tabs-titale">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link active" id="v-pills-workingtime-tab " data-toggle="pill" href="#v-pills-workingtime" role="tab" aria-controls="v-pills-workingtime" aria-selected="true"><h6 class="mb-0"><i class="fad fa-hand-holding-box" style="width="24"; height="24";"></i> Workingtime</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$workingtimes->count() }}</span></span> </a>
                      <a class="nav-link" id="v-pills-bankdetails-tab" data-toggle="pill" href="#v-pills-bankdetails" role="tab" aria-controls="v-pills-bankdetails" aria-selected="false"><h6 class="mb-0"><i class="fad fa-list-alt"></i> Bank details</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$bankdetailscount}}</span></span></a>
                      <a class="nav-link" id="v-pills-transaction-tab" data-toggle="pill" href="#v-pills-transaction" role="tab" aria-controls="v-pills-transaction" aria-selected="false"><h6 class="mb-0"><i class="fad fa-list-alt"></i> Transaction History</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$transactionhistorycount}}</span></span></a>
                      <a class="nav-link" id="v-pills-workhistory-tab" data-toggle="pill" href="#v-pills-workhistory" role="tab" aria-controls="v-pills-workhistory" aria-selected="false"><h6 class="mb-0"><i class="fas fa-book"></i> Work history</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$workhistorycount}}</span></span></a>
                      <a class="nav-link" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="false"><h6 class="mb-0"><i class="far fa-bell"></i> Notifications</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$notificationscount}}</span></span></a>
                      <a class="nav-link" id="v-pills-bookings-tab" data-toggle="pill" href="#v-pills-bookings" role="tab" aria-controls="v-pills-bookings" aria-selected="false"><h6 class="mb-0"><i class="far fa-calendar-alt"></i> Bookings</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$bookingcount}}</span></span></a>
                      <a class="nav-link" id="v-pills-services-tab" data-toggle="pill" href="#v-pills-services" role="tab" aria-controls="v-pills-services" aria-selected="false"><h6 class="mb-0"><i class="fab fa-servicestack"></i> Services</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{$user->BeauticianServices->count()}}</span></span></a>
                      <a class="nav-link" id="v-pills-wallet-tab" data-toggle="pill" href="#v-pills-wallet" role="tab" aria-controls="v-pills-wallet" aria-selected="false"><h6 class="mb-0"><i class="fas fa-wallet"></i> Wallet</h6>
                      <span class="text-secondary"><span class="badge badge-primary badge-pill">{{round($totalwallet)}}</span></span></a>
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
                        <h6 class="mb-0 text-primary" >Name</h6>
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
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Emergency Number</h6>
                      </div>
                      <div class="col-sm-9 text-danger"> @if(!$user->UserProfileInformation ==""){{ $user->UserProfileInformation->Emergency_Number }} @endif</div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">joined at</h6>
                      </div>
                      <div class="col-sm-9 text-danger"> {{ $user->created_at }} </div>
                    </div>
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
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Applied for certificate</h6>
                      </div>
                      <div class="col-sm-9 text-danger"> @if($certificatecount>0) {{$certificatecount}} <a href="{{route('certificates.index',['user-id'=>$user->id])}}" class="badge badge-danger"> View </a> @else {{$certificatecount}} @endif</div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0 text-primary">Bought courses</h6>
                      </div>
                      <div class="col-sm-9 text-danger">{{$coursecount}} @if($coursecount>0)<a href="{{route('courses.index',['user-id'=>$user->id])}}" class="badge badge-danger"> View </a>@endif</div>
                    </div>
                  </div>
                </div>
                 @if($user->getRoleNames()->first()=="Beautician")
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-workingtime" role="tabpanel" aria-labelledby="v-pills-workingtime-tab">
                      <div class="card h-100">
                        <div class="card-body">
                          <table id="Orderstable" class="table table-striped table-bBookinged table-hover ">
                            <thead>
                              <tr>
                                <th scope="col" class="sr-no">#Id</th>
                                <th scope="col">Day</th>
                                <th scope="col">Start time</th>
                                <th scope="col">End time</th>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($workingtimes  as $time)
                                  <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><b>{{ $time->day }}</b></td>
                                    <td><b>{{ $time->start_time  }}</b> </td>
                                    <td><b>{{ $time->end_time  }} </b></td>
                                  </tr>
                                @endforeach
                              </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-bankdetails" role="tabpanel" aria-labelledby="v-pills-bankdetails-tab">
                      <div class="card h-100">
                        <div class="card-body">
                          <table id="bankdetails" class="table table-striped table-bBookinged table-hover ">
                            <thead>
                              <tr>
                                <th scope="col" class="sr-no">#</th>
                                <th scope="col">Bank name</th>
                                <th scope="col">Name</th>
                                <th scope="col">Account number </th>
                                <th scope="col">Date </th>
                            </thead>
                            <tbody>
                              @php $i=1 @endphp
                              @foreach ($bankdetails  as $detail)
                                <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $detail->bank_name }}</td>
                                  <td>{{ $detail->account_name  }} </td>
                                  <td>{{ $detail->account_number   }} </td>
                                  <td>{{date('d-m-Y', strtotime($detail->created_at))}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div class="mt-1 float-right"> 
                          {{ $bankdetails->links() }}
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
                    <div class="tab-pane fade" id="v-pills-services" role="tabpanel" aria-labelledby="v-pills-services-tab">
                      <div class="card h-100">
                        <div class="card-body">
                           <ul>
                            @if(!$user->BeauticianServices->isEmpty())                                        
                                @foreach($user->BeauticianServices as $key=> $Services )
                                  @if ($loop->odd)
                                    <li><a href="{{route('service.show',$Services->ServiceInfo->id)}}" class="link">{{$Services->ServiceInfo->name}}</a></li>
                                  @endif
                                @endforeach
                            @endif
                          </ul>
                          <ul>
                            @if(!$user->BeauticianServices->isEmpty())                                        
                                @foreach($user->BeauticianServices as $key=> $Services )
                                  @if ($loop->even)
                                    <li><a href="#0" class="link">{{$Services->ServiceInfo->name}}</a></li>
                                  @endif
                                @endforeach
                            @endif
                          </ul>
                        </div>
                        <div class="mt-1 float-right"> 
                          {{ $bankdetails->links() }}
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-wallet" role="tabpanel" aria-labelledby="v-pills-wallet-tab">
                      <div class="card h-100">
                        <div class="card-body">
                          <table id="AddressBook" class="table table-striped table-bBookinged table-hover ">
                            <thead>
                              <tr>
                                <th scope="col" class="sr-no">Id</th>
                                <th scope="col">Transaction</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date</th>
                            </thead>
                            <tbody>
                          @php $i=1 @endphp
                          @foreach ($wallethistory  as $history)
                            <tr>
                              <td>{{ $i++}}</td>
                              <td>{{$history->narration}}</td>
                              <td>{{$history->amount}} </td>
                              <td>{{$history->type}}</td>
                              <td>{{date('d-m-Y', strtotime($history->created_at))}}</td>
                            </tr>
                            @endforeach 
                              </tbody>
                          </table>
                        </div>
                       <div class="mt-1 float-right"> 
                          {{ $wallethistory->links() }}
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-workhistory" role="tabpanel" aria-labelledby="v-pills-workhistory-tab">
                      <div class="card h-100">
                        <div class="card-body">
                          <table id="AddressBook" class="table table-striped table-bBookinged table-hover ">
                            <thead>
                              <tr>
                                <th scope="col" class="sr-no">Id</th>
                                <th scope="col">Services</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Commission</th>
                                <th scope="col">Date</th>
                            </thead>
                            <tbody>
                          @php $i=1 @endphp
                          @foreach ($workhistory  as $history)
                            <tr>
                              <td>{{ $i++}}</td>
                              <td>@foreach(json_decode($history->services , true) as $key=> $service)  {{  ucfirst($service['name']) }} @endforeach</td>
                              <td>{{$history->services_amount}} </td>
                              <td>{{$history->commission}}</td>
                              <td>{{date('d-m-Y', strtotime($history->created_at))}}</td>
                            </tr>
                            @endforeach  
                              </tbody>
                          </table>
                        </div>
                        <div class="mt-1 float-right"> 
                          {{ $workhistory->links() }}
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
    $('#bankdetails').DataTable();
});
</script>
<script>
   $(document).ready( function () {
    $('#notifications').DataTable();
});
</script> 
@endsection