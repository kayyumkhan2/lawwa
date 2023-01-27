
       <div class="col-lg-3">
        <div class="left-siderbar">
          <div class="sidebar">
            <ul>
              <li><a href="{{route('beautician.dashboard')}}" class="{{ Route::currentRouteNamed('beautician.dashboard') ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon5.svg') }}" alt="Icons" >Dashboard</a></li>
              <li><a href="{{route('beautician.myaccount')}}" class="{{ Route::currentRouteNamed('beautician.myaccount') ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon6.svg') }}" alt="Icons">My Profile</a></li>
              <li><a href="{{route('beautician.notifications.index')}}" class="{{ Route::currentRouteNamed('beautician.notifications.index') ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon9.svg') }}" alt="Icons">Notifications</a></li>
              <li><a href="{{route('beautician.Booking')}}" class="{{ (request()->is('beautician/booking*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon10.svg') }}" alt="Icons">My Bookings</a></li>
              <li><a href="{{route('beautician.feedback.create')}}" class="{{ (request()->is('beautician/feedback*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/feedback.svg') }}" alt="Icons">Feedback</a></li>
              <li><a href="{{route('beautician.ratings.index')}}" class="{{ (request()->is('beautician/ratings*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon12.svg') }}" alt="Icons">Reviews &amp; Ratings</a></li>
              <li><a href="{{route('beautician.workingtime.index')}}" class="{{ (request()->is('beautician/workingtime*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon14.svg') }}" alt="Icons">Manage Schedule</a></li>
              <li><a href="{{route('beautician.bankdetail.index')}}" class="{{ (request()->is('beautician/bankdetail*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon9.svg') }}" alt="Icons">Manage Bank Detail</a></li>
              <li><a href="{{route('beautician.wallet.index')}}" class="{{ Route::currentRouteNamed('beautician.wallet.index') ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon16.svg') }}" alt="Icons">Manage Wallet</a></li>
              <li><a href="{{route('beautician.workhistory.index')}}" class="{{ Route::currentRouteNamed('beautician.workhistory.index') ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon17.svg') }}" alt="Icons">My Work History</a></li>
              <li><a href="{{ route('beautician.ticket.index') }}" class="{{ (request()->is('beautician/tickets*')) ? 'active' : '' }} {{ (request()->is('myaccount/assigned-beautician-profile*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/tickets.svg') }}" alt="Icons">Tickets</a></li>
              <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="{{ asset('front/assets/images/icons/icon13.svg') }}" alt="Icons">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
               </li>
            </ul>
          </div>
        </div>
      </div>