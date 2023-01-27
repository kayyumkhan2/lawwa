@extends('front::layouts.master')
@section('title') Notifications @endsection
@section('content')

<!-- Lawwa My Account -->
<section class="my-account">
  <div class="container">
    <div class="row">
     @include('beautician::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="feedback-header">
            <h6>Notifications</h6>
          </div>
           <div class="notification-info">
           @forelse($notifications as $notification)            
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
                                <div class="img-block-1">
                                    <i class="fa fa-bell link" style="font-size: 30px;" aria-hidden="true"></i>
                                </div>
                              </td>
                              <td>
                                <div class="notification-wrap">
                                @php $type=json_decode($notification->data,true) @endphp
                                  @if($notification->type=='Booking')
                                    @if($type['current_status'] =="Assigned")   
                                      <h6>You have assigned a new booking</h6>
                                    @endif
                                @elseif($notification->type=='NewBeautician')
                                  <h6>Welcome you have successfully registered <h6>    
                                @else
                                <h6>{{$notification->title}}</h6>
                                @endif    
                                  <span>{{$notification->created_at}}</span>
                                </div>
                              </td>  
                              <td>
                                @php  $data = json_decode($notification->data,true) @endphp
                                @if($data!="")
                                  @if($notification->type=='Booking')
                                    <a href="{{route('beautician.Booking.Details',$data['id'])}}" class="notification-link">View</a>
                                  @endif
                                @endif
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
            @empty
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
           @endforelse
          </div>
          <div class="mt-1 float-right"> 
            {{ $notifications->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection