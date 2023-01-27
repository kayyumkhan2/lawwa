<div class="preloader"><img src="{{ asset('images/lawwaloder.gif' ) }}"></div>
<header class="lawwa-header">
   <div class="row align-items-center">
      <div class="col-xl-2 col-8">
         <a href="/" class="lawwa-logo">
         <img src="{{ asset('front/assets/images/lawwa-brand.svg' ) }}" alt="Lawwa" width="242">
         </a>
      </div>
      <div class="col-xl-10 col-4">
         <div class="header-right">
            <div class="header-wrap">
               <a href="#0" class="lawwa-logo d-xl-none">
               <img src="{{ asset('front/assets/images/lawwa-brand.svg' ) }}" alt="Lawwa" width="242">
               </a>
               <nav class="lawwa-navigation">
                  <ul id="active-tab">
                     <li class="{{ Route::currentRouteNamed('front.home') ? 'active' : '' }}" onclick="changeClass()"><a href="{{route('front.home')}}">Home</a></li>
                     <li class="{{ Route::currentRouteNamed('pages.about-us') ? 'active' : '' }}" ><a href="{{route('pages.about-us')}}">About Us</a></li>
                     @auth
                        @if(Auth::user()->roles->first()->name=="Beautician")
                           <li class="{{ Route::currentRouteNamed('pages.recruitments') ? 'active' : '' }}"><a href="{{route('pages.recruitments')}}">Recruitments</a></li>
                           <li class="{{ Route::currentRouteNamed('pages.academy') ? 'active' : '' }}"><a href="{{route('pages.academy')}}">Academy</a></li>
                        @elseif(Auth::user()->roles->first()->name=="Customer")
                        <li class="{{ Route::currentRouteNamed('services.servicescategory') ? 'active' : '' }}" ><a href="{{route('services.servicescategory')}}">Services</a></li>
                        <li class="{{ Route::currentRouteNamed('products.productscategory') ? 'active' : '' }}"  ><a href="{{route('products.productscategory')}}">Products</a></li>
                        <li class="{{ Route::currentRouteNamed('pages.membership') ? 'active' : '' }}"><a href="{{route('pages.membership')}}">Membership</a></li>
                        @endif
                     @endauth
                     @guest
                        <li class="{{ Route::currentRouteNamed('pages.academy') ? 'active' : '' }} {{ Route::currentRouteNamed('pages.academy-facilities-details') ? 'active' : '' }} {{ Route::currentRouteNamed('pages.course-details') ? 'active' : '' }} {{ Route::currentRouteNamed('pages.certificate-details') ? 'active' : '' }} "><a href="{{route('pages.academy')}}">Academy</a>
                           <ul class="sub-menu">
                              <li class="{{ Route::currentRouteNamed('pages.recruitments') ? 'active' : '' }}"><a href="{{route('pages.recruitments')}}">Recruitments</a></li>
                           </ul>
                        </li>
                        <li class="{{ Route::currentRouteNamed('services.servicescategory') ? 'active' : '' }}" ><a href="{{route('services.servicescategory')}}">Services</a></li>
                        <li class="{{ Route::currentRouteNamed('products.productscategory') ? 'active' : '' }}"  ><a href="{{route('products.productscategory')}}">Products</a></li
                        >
                        <li class="{{ Route::currentRouteNamed('pages.membership') ? 'active' : '' }}"><a href="{{route('pages.membership')}}">Membership</a></li>
                     @endguest
                     <li class="{{ Route::currentRouteNamed('pages.gallery') ? 'active' : '' }} {{ Route::currentRouteNamed('pages.news-details') ? 'active' : '' }}"><a href="{{route('pages.gallery')}}">Gallery</a></li>
                     <li class="{{ Route::currentRouteNamed('pages.contact-us') ? 'active' : '' }}"><a href="{{route('pages.contact-us')}}">Contact</a></li>
                     @auth
                     @if(Auth::user()->roles->first()->name=="Beautician")
                      <li  class="{{request()->is('beautician*') ? 'active' : '' }}"><a href="{{route('beautician.dashboard')}}">My Account</a></li>
                     @else
                      <li  class="{{request()->is('myaccount*') ? 'active' : '' }}"><a href="{{route('customer.dashboard')}}">My Account</a></li>
                     @endif
                     <li>
                        <a href="{{ route('logout') }}" class="header-btn">
                        Logout
                        </a>
                     </li>
                     @if(Auth::user()->roles->first()->name=="Customer")
                        <li>
                           <a href="{{route('showcart')}}" class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge-icon ProductCartCount">0</span></a>
                        </li>
                     @endif
                     @endauth
                  </ul>
               </nav>
               @guest
               <div class="header-btn">
                  <a href="javascript:void(0);" class="dropdown register-link"><img src="{{ asset('front/assets/images/icons/register-icon.svg' ) }}" alt="Register" width="12"> Register</a>
                  <a href="{{route('login')}}" class="dropdown sign-in-link"><img src="{{ asset('front/assets/images/icons/signin-icon.svg' ) }}" alt="Sign In" width="16"> Sign In</a>
                  <div class="dropdown-top register-dropdown">
                     <a href="{{route('beautician.signup')}}"><img src="{{ asset('front/assets/images/icons/customer-login-icon.svg' ) }}" alt="beautician-login-icon"> Beautician Register</a>
                     <a href="{{route('customer.signup')}}"><img src="{{ asset('front/assets/images/icons/customer-login-icon.svg' ) }}" alt="beautician-login-icon"> Customer Register</a>
                  </div>
                  {{--<div class="dropdown-top signin-dropdown">
                     <a href="{{route('login')}}"><img src="{{ asset('front/assets/images/icons/customer-login-icon.svg' ) }}" alt="beautician-login-icon"> Beautician Log In </a>
                     <a href="{{route('login')}}"><img src="{{ asset('front/assets/images/icons/customer-login-icon.svg' ) }}" alt="beautician-login-icon"> Customer Log In </a>--}}
                  </div>
               </div>
               @endguest
            </div>
            <a href="javascript:void(0);" class="lawwa-toggle"><span></span></a>
         </div>
      </div>
   </div>
</header>
