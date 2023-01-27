<style type="text/css">
   i{
      /*font-size: 20px;*/
   }
</style>
<div class="dashboard-menu">
   <div class="nav-menu">
      <div class="user-info">
         <div class="user-icon"><img src="@if(Auth::user()->profile_pic=='') {{ asset('public/images/profilepics/avatar7.png') }}  @else {{ asset('public/images/profilepics/'.Auth::user()->profile_pic) }}@endif" alt="img"></div>
         <div class="user-name">
            <h5>{{ Auth::user()->full_name }}</h5>
            <span class="h6 text-muted">
            @if(!empty(Auth::user()->getRoleNames()))
            @foreach(Auth::user()->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}
            </label>@endforeach 
            @endif
            </span>
         </div>
      </div>
      <ul class="list-unstyled nav">
         <li class="nav-item"><span class="menu-title text-muted">NAVIGATION </span></li>
         <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link" data-position="top"><i class="fal fa-home-alt"></i> Dashboard</a></li>
         <li class="nav-item"><a href="https://booking.lawwa.online/lawwa-2.0/lawwa-walkthrough.php" class="nav-link" target="_blank" data-position="top"><i class="fa fa-globe" aria-hidden="true"></i> Open Panel</a></li>
         <li class="nav-item {{ (request()->is('admin/orders*')) ? 'active' : '' }}"><a href="{{ route('orders.index') }}" class="nav-link" data-position="top"><i class="fad fa-hand-holding-box"></i> Orders</a></li>
         <li class="nav-item {{ (request()->is('admin/bookings*')) ? 'active' : '' }}"><a href="{{route('bookings.index')}}" class="nav-link" data-position="top"><i class="far fa-calendar-check"></i> Bookings</a></li>
         <li class="nav-item"><a href="{{ route('payments') }}" class="nav-link" ><i class="fas fa-money-bill-alt"></i> Payment history</a></li>
         <li class="nav-item {{ (request()->is('admin/users*') || request()->is('users*') ) ? 'active' : '' }}" data-position="top">
            <a href="#" class="nav-link"><i class="fa fa-users"></i> Users </a>
            <ul class="sub-menu">
               <li class="nav-item" data-position="top"><a href="{{ route('users.beauticians') }}" class="nav-link"><i class="fa fa-users"></i>PBTLA</a></li>
               <li class="nav-item" data-position="top"><a href="{{ route('users.createbeautician') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Create PBTLA</a></li>
               <li class="nav-item" data-position="top"><a href="{{ route('users.customers') }}" class="nav-link"><i class="fa fa-users"></i>Customers</a></li>
               <li class="nav-item" data-position="top"><a href="{{ route('users.createcustomer') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Create Customer</a></li>
            </ul>
         </li>
         <li class="nav-item {{ (request()->is('admin/service*') or request()->routeIs('categories.servicecategories*') or request()->routeIs('categories.create.servicecategory*') ) ? 'active' : '' }}" data-position="top">
            <a href="#" class="nav-link"><i class="fab fa-servicestack"></i> Services </a>
            <ul class="sub-menu">
               <li class="nav-item"  data-position="top"><a href="{{ route('service.index') }}" class="nav-link"><i class="fab fa-servicestack"></i>Services</a></li>
               <li class="nav-item"  data-position="top"><a href="{{ route('service.create') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Create Service</a></li>
               <li class="nav-item"  data-position="top"><a href="{{ route('categories.servicecategories') }}" class="nav-link"><i class="far fa-tags"></i>Service Categories</a></li>
               <li class="nav-item" data-position="top"><a href="{{ route('categories.create.servicecategory') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Add Service Category</a></li>
            </ul>
         </li>
         <!--<li class="nav-item {{ (request()->is('admin/brands*')) ? 'active' : '' }}"><a href="#" class="nav-link"><i class="fab fa-delicious"></i>Brands </a>
            <ul class="sub-menu">
                <li class="nav-item"><a href="{{ route('brands.index') }}" class="nav-link"><i class="fab fa-delicious"></i></i>Brands</a></li>
                <li class="nav-item"><a href="{{ route('brands.create') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Add Brands</a></li>
            </ul>
            </li>-->
         <li class="nav-item {{ (request()->is('admin/products*') or request()->routeIs('categories.index*') or request()->routeIs('categories.create')) ? 'active' : '' }}" data-position="top">
            <a href="#" class="nav-link"><i class="fa fa-cube"></i>Products</a>
            <ul class="sub-menu">
               <li class="nav-item" data-position="top"><a href="{{ route('products.index') }}" class="nav-link"><i class="fa fa-cube"></i>Products</a></li>
               <li class="nav-item" data-position="top"><a href="{{ route('products.create') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Add Product</a></li>
               <li class="nav-item" data-position="top"><a href="{{ route('categories.index') }}" class="nav-link"><i class="far fa-tags"></i>Product Categories</a></li>
               <li class="nav-item" data-position="top"><a href="{{ route('categories.productsoffrescategory') }}" class="nav-link"><i class="far fa-tags"></i>Offer Categories</a></li>
               <li class="nav-item" data-position="top"><a href="{{ route('categories.create') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Add Product Category</a></li>
            </ul>
         </li>
         <li class="nav-item {{ request()->is('admin/queries*')  ? 'active' : '' }}" ><a href="{{ route('queries.index') }}" class="nav-link" data-position="top"><i class="fas fa-question-circle"></i> Queries</a></li>
         <li class="nav-item {{ request()->is('admin/recruitmentapplies*')  ? 'active' : '' }}" ><a href="{{ route('recruitmentapplies.index') }}" class="nav-link" data-position="top"><i class="fas fa-question-circle"></i> Recruitment applies</a></li>
         <li class="nav-item {{ request()->is('admin/tickets*')  ? 'active' : '' }}"><a href="{{ route('admin.tickets.index') }}"  class="nav-link" data-position="top"><i class="fa fa-ticket" aria-hidden="true"></i> Tickets</a></li>
         <li class="nav-item"><a href="{{route('courses.index')}}" class="nav-link" data-position="middle"><i class="fab fa-discourse"></i> Courses Sold</a></li>
         <li class="nav-item"><a href="{{route('certificates.index')}}" class="nav-link" data-position="middle"><i class="fas fa-universal-access"></i> Certificates applied</a></li>
         <li class="nav-item {{ (request()->is('admin/Roles*') || request()->is('admin/Permissions*') ) ? 'active' : '' }}" data-position="middle">
            <a href="#" class="nav-link" data-position="middle"><i class="fas fa-user-secret"></i> Roles </a>
            <ul class="sub-menu">
               <li class="nav-item"><a href="{{ route('Roles.index') }}" class="nav-link" data-position="middle"><i class="fa fa-users"></i>Roles</a></li>
               <li class="nav-item"><a href="{{ route('Permissions.index') }}" class="nav-link" data-position="middle"><i class="fa fa-users"></i> Permissions</a></li>
               <li class="nav-item"><a href="{{ route('Roles.create') }}" class="nav-link" data-position="middle"><i class="fa fa-plus-circle"></i>Create Role</a></li>
               <!-- <li class="nav-item"><a href="{{ route('Permissions.create') }}" class="nav-link" data-position="middle"><i class="fa fa-plus-circle"></i>Create Permission</a></li> -->
            </ul>
         </li>
         <li class="nav-item {{ (request()->is('admin/membershipplan*') || request()->is('admin/Permissions*') ) ? 'active' : '' }}" data-position="middle" >
            <a href="#" class="nav-link"><i class="fas fa-american-sign-language-interpreting"></i>Membership </a>
            <ul class="sub-menu">
               <li class="nav-item"><a href="{{ route('membershipplan.index') }}" class="nav-link"><i class="fas fa-american-sign-language-interpreting"></i>Membership Plan</a></li>
               <li class="nav-item"><a href="{{ route('membershipplan.create') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Create Plan</a></li>
            </ul>
         </li>
         <li class="nav-item {{ (request()->is('admin/managers*') || request()->is('admin/create/manager*') || request()->is('admin/manager*')) ? 'active' : '' }}" data-position="middle">
            <a href="#" class="nav-link" data-position="middle"><i class="fa fa-users"></i> Admin manager </a>
            <ul class="sub-menu">
               <li class="nav-item"><a href="{{ route('users.admin.managers') }}" class="nav-link"><i class="fa fa-users"></i>Managers </a></li>
               <li class="nav-item"><a href="{{ route('admin.create.manager') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Create Manager</a></li>
            </ul>
         </li>
         <li class="nav-item {{ (request()->is('admin/mailtemplates*')) ? 'active' : '' }}" data-position="middle">
            <a href="#" class="nav-link"><i class="fas fa-mail-bulk"></i>Mail Templates</a>
            <ul class="sub-menu">
               <li class="nav-item" data-position="middle"><a href="{{ route('mailtemplates.index') }}" class="nav-link"><i class="fas fa-mail-bulk"></i>Mail Templates</a></li>
               {{--<li class="nav-item" data-position="middle"><a href="{{ route('mailtemplates.create') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Add Mail Templates</a></li>--}}
            </ul>
         </li>
         <li class="nav-item " ><a href="{{ route('feedbacks.index') }}" class="nav-link" data-position="middle"><i class="fas fa-question-circle"></i> Feedback</a></li>
         <li class="nav-item {{ (request()->is('admin/pages*')) ? 'active' : '' }} {{ (request()->is('admin/pages*') || request()->is('admin/page*') ) ? 'active' : '' }}" data-position="middle">
            <a href="#" class="nav-link" data-position="middle"><i class="fas fa-file-alt"></i>Pages</a>
            <ul class="sub-menu">
               <li class="nav-item" ><a href="{{ route('admin.pages') }}" class="nav-link"><i class="fas fa-file-alt"></i>Pages</a></li>
            </ul>
         </li>
         <li class="nav-item {{ (request()->is('admin/sociallinks*')) ? 'active' : '' }}" data-position="middle">
            <a href="#" class="nav-link"><i class="fas fa-share-alt"></i> Social Links</a>
            <ul class="sub-menu">
               <li class="nav-item" data-position="middle"><a href="{{ route('sociallinks.index') }}" class="nav-link"><i class="fas fa-share-alt"></i>Social links</a></li>
               <li class="nav-item" data-position="middle"><a href="{{ route('sociallinks.create') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Add Social link</a></li>
            </ul>
         </li>
         <li class="nav-item {{ (request()->is('admin/notifications*')) ? 'active' : '' }}" data-position="middle">
            <a href="#" class="nav-link"><i class="fas fa-envelope-open-text"></i>Notifications</a>
            <ul class="sub-menu">
               <li class="nav-item" data-position="middle"><a href="{{ route('notifications.index') }}" class="nav-link"><i class="far fa-envelope"></i>Notifications</a></li>
               <li class="nav-item" data-position="middle"><a href="{{ route('notifications.send.beauticians') }}" class="nav-link"><i class="fas fa-share-square"></i>Send PBTLA </a></li>
               <li class="nav-item" data-position="middle"><a href="{{ route('notifications.send.customers') }}" class="nav-link"><i class="fas fa-share-square"></i>Send Customers </a></li>
               <li class="nav-item" data-position="middle"><a href="{{ route('notifications.create') }}" class="nav-link"><i class="fas fa-share-square"></i>Send All </a></li>
            </ul>
         </li>
         <li class="nav-item {{ (request()->is('admin/banners*')) ? 'active' : '' }}" data-position="middle">
            <a href="#" class="nav-link"><i class="far fa-images"></i>Banners</a>
            <ul class="sub-menu">
               <li class="nav-item" data-position="middle"><a href="{{ route('banners.index') }}" class="nav-link"><i class="far fa-images"></i>Banners</a></li>
               <li class="nav-item" data-position="middle"><a href="{{ route('banners.create') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Add Banner</a></li>
            </ul>
         </li>
         <li class="nav-item {{ (request()->is('admin/settings*')) ? 'active' : '' }}" data-position="middle">
            <a href="#" class="nav-link"><i class="fas fa-cog"></i>Settings</a>
            <ul class="sub-menu">
               <li class="nav-item" data-position="middle"><a href="{{ route('settings.index') }}" class="nav-link"><i class="fas fa-cog"></i>Settings</a></li>
               <li class="nav-item" data-position="middle">
                  <a href="{{ route('settings.contactussettings.address') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Address</a>
               </li>
               <li class="nav-item" data-position="middle">
                  <a href="{{ route('settings.contactussettings.email') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Emails</a>
               </li>
               <li class="nav-item" data-position="middle">
                  <a href="{{ route('settings.contactussettings.contactnumber') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Contact Numbers</a>
               </li>
               <li class="nav-item" data-position="middle">
                  <a href="{{ route('settings.homepagecontent',1) }}" class="nav-link"><i class="fa fa-plus-circle"></i>Home Content</a>
               </li>
               <li class="nav-item" data-position="middle">
                  <a href="{{ route('settings.bank.index') }}" class="nav-link"><i class="fa fa-plus-circle"></i>Banks</a>
               </li>
            </ul>
         </li>
      </ul>
   </div>
</div>
