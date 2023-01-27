<div id="loading"></div>
 
<div class="navbar navbar-expand flex-column flex-md-row align-items-center navbar-custom">
   <div class="container-fluid">
        <a href="{{route('front.home')}}" class="navbar-brand mr-0 mr-md-2 logo">
            <img src="{{ asset('images/final-logo.png')}}" alt="Logo">
        </a>
      <button type="button" class="navigation-btn"><i class="fal fa-bars"></i></button>
      <ul class="navbar-nav flex-row ml-auto d-flex align-items-center list-unstyled topnav-menu mb-0">
         <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <i class="far fa-bell"></i>
            <span class="noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-lg">
               @if(count(GetNotifications())>0)
               <div class="dropdown-item noti-title border-bottom" id="clearallafter">
                  <h5 class="m-0 font-size-16">
                     <span class="float-right">
                     <a href="javascript:void(0);" class="text-dark">
                     <small class="clearall" id="notification-clear" data-model="Notification">Clear All  </small>
                     </a>
                     </span>Notification
                  </h5>
               </div>
               <div class="noti-scroll" style="width: auto; height:400px; overflow-y: scroll";>
                  @php
                  $i=1;
                  @endphp
                  @foreach(GetNotifications() as $value )
                      @if($value->type=='NewCutomer')
                        <a href="javascript:void(0);" data-id="{{ $value->id}}" data-model="Notification" class="dropdown-item notify-item deletenotification" id="notification-{{$i++}}">
                      @elseif($value->type=='NewBeautician')
                        <a href="javascript:void(0);"  data-status="0" data-id="{{ $value->id}}"  data-model="Notification" class="dropdown-item notify-item deletenotification" id="notification-{{$i++}}" class="dropdown-item notify-item">
                      @else
                        <a href="javascript:void(0);" data-status="0" data-id="{{ $value->id}}"  data-model="Notification" class="dropdown-item notify-item deletenotification" data-status="0" id="notification-{{$i++}}" class="dropdown-item notify-item"> 
                     @endif
                     @if($value->type=='Order')
                         @php $type=json_decode($value->data,true) @endphp  
                        <div class="notify-icon bg-secondary"><i class="fad fa-box-open"></i></div>
                        <p class="notify-details" style = "text-transform: capitalize;">  
                            @if($type['current_status'] =="ORDERED")
                                New order placed : id {{$type['id']}}
                            @elseif($type['current_status'] =="ONTHEWAY")
                              Order id : {{$type['id']}} is on the way 
                            @else
                               Order id : {{$type['id']}} has been {{strtolower($type['current_status'])}}  
                            @endif  
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}
                            </small>
                        </p>
                     @elseif($value->type=='NewCutomer')
                        <div class="notify-icon bg-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i></div>
                        <p class="notify-details">{{$value->title}}<small class="text-muted">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</small></p>
                     @elseif($value->type=='NewBeautician')
                        <div class="notify-icon bg-primary"> <i class="fa fa-user-plus" aria-hidden="true"></i></div>
                        <p class="notify-details">{{$value->title}}<small class="text-muted">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</small></p>
                     @elseif($value->type=='Membership')
                        <div class="notify-icon bg-primary"> <i class="fas fa-american-sign-language-interpreting"></i></i></div>
                        <p class="notify-details">{{$value->title}}<small class="text-muted">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</small></p>
                     @elseif($value->type=='Booking')
                        @php $type=json_decode($value->data,true) @endphp   
                        <div class="notify-icon bg-success"><i class="far fa-calendar-check"></i></div>
                        <p class="notify-details" style = "text-transform: capitalize;">  
                            @if($type['current_status'] =="Booked")
                                New Booking Booked : id {{$type['id']}}
                            @elseif($type['current_status'] =="OnTheWay")
                              Booking : {{$type['id']}} PBT is on the way
                            @elseif($type['current_status'] =="Reached")
                              Booking : {{$type['id']}} PBT has been Reached
                            @elseif($type['current_status'] =="Assigned")
                              Booking : {{$type['id']}} Has been Assigned to new pbt
                            @else
                              Booking : {{$type['id']}} has been {{strtolower($type['current_status'])}}  
                            @endif  
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}
                            </small>
                        </p>                   
                    @endif
                  </a>
                @endforeach
               </div>
               <!-- All-->
               <a href="{{route('notifications.index')}}"
                  class="dropdown-item align-items-center justify-content-center notify-item border-top" id="Viewall">View
               all</a>
               @else
               <div><h6 style="margin-left: 30px;">No Notification Found</h6></div>
              @endif 
            </div>
         </li>
         <li class="dropdown user-link">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <i class="far fa-cog"></i>
            <span class="noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-lg">
               <a href="{{ route('users.adminmanagerprofile',Auth::user()->id ) }}" class="dropdown-item"> <i class="fal fa-user"></i> My Profile</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
               <i class="fal fa-sign-out"></i> Logout</a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
         </li>
      </ul>
   </div>
</div>
</div>
