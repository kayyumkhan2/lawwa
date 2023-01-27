<div class="col-lg-3">
        <div class="left-siderbar">
          <div class="sidebar">
            <ul>
              <li ><a href="{{route('customer.dashboard')}}" class="{{ (request()->is('myaccount/dashboard*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon5.svg') }}" alt="Icons">Dashboard</a></li>
              <li><a href="{{route('customer.myaccount')}}" class="{{ Route::currentRouteNamed('customer.myaccount') ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon6.svg') }}" alt="Icons">My Profile</a></li>
              <li><a href="{{ route('customer.orders') }}" class="{{ (request()->is('myaccount/orders*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon7.svg') }}" alt="Icons">My Order</a></li>
              <li><a href="{{ route('customer.my-favourite.index') }}" class="{{ (request()->is('myaccount/my-favourite*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon8.svg') }}" alt="Icons">My Favourite</a></li>
              <li><a href="{{ route('customer.notifications.index') }}" class="{{ (request()->is('myaccount/notifications*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon9.svg') }}" alt="Icons">Notifications</a></li>
              <li><a href="{{ route('customer.Booking') }}" class="{{ (request()->is('myaccount/booking*')) ? 'active' : '' }} {{ (request()->is('myaccount/assigned-beautician-profile*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon10.svg') }}" alt="Icons">My Bookings</a></li>
              <li><a href="{{ route('customer.ticket.index') }}" class="{{ (request()->is('myaccount/tickets*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/tickets.svg') }}" alt="Icons">Tickets</a></li>
               <li><a href="{{route('customer.ratings.index')}}" class="{{ (request()->is('myaccount/ratings*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/icon12.svg') }}" alt="Icons">Reviews &amp; Ratings</a></li>
              <li><a href="{{route('customer.feedback.create')}}" class="{{ (request()->is('myaccount/feedback*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/feedback.svg') }}" alt="Icons">Feedback</a></li>
              <li><a href="{{route('customer.membership.index')}}" class="{{ (request()->is('myaccount/membership*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/membership-icon.svg') }}" alt="Icons">Membership</a></li>
               <li><a href="{{route('customer.health.condition.create')}}" class="{{ (request()->is('myaccount/healthconditions*')) ? 'active' : '' }}"><img src="{{ asset('front/assets/images/icons/customer-helth.svg') }}" alt="Icons">Customer Health</a></li>
              <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="{{ asset('front/assets/images/icons/icon13.svg') }}" alt="Icons">Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
               </li>
            </ul>
          </div>
        </div>
      </div>