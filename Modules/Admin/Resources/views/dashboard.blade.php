@extends('admin::layouts.master')
@section('title') Dashboard @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1 class="h3 m-0">Dashboard</h1>
    </div>
    <!--<div class="col-md-6">
      <form class="dateFilter">
        <div class="input-group">
          <input type="text" name="dates" class="form-control date-range" value="01/01/2020 - 01/09/2020" />
          <div class="input-group-prepend"> <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span> </div>
        </div>
      </form>
    </div>-->
  </div>
</div>
<div class="row">
@can("Beauticians")  
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="fal fa-users"></i> </div>
      <div>
        <div class="text-value text-primary"><h3>{{$beauticians}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Beauticians</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('users.beauticians') }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Customers")  
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="far fa-user-friends"></i> </div>
      <div>
        <div class="text-value text-primary"><h3 >{{$customers}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Customers</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('users.customers') }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Membership Customers")
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="far fa-users"></i> </div>
      <div>
        <div class="text-value text-primary"><h3>{{$membershipcustomers}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Membership Customers</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('users.membershipcustomers') }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Total Orders")
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="fad fa-hand-holding-box"></i></div>
      <div>
        <div class="text-value text-primary"><h3>{{$totalorders}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Total Orders</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('orders.index') }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Total Products")
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"><i class="fad fa-box-check"></i> </div>
      <div>
        <div class="text-value text-primary"><h3>{{$totalproducts}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Total Products</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('products.index') }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Total Bookings")
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="far fa-calendar-check"></i>  </div>
      <div>
        <div class="text-value text-primary"><h3>{{$totalbookings}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Total Bookings</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('bookings.index') }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Booking Revenue")
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="far fa-money-bill-alt"></i> </div>
      <div>
        <div class="text-value text-primary"><h3>{{round($RevenueBooking)}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Booking Revenue</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('payments',['filterrevenue'=>'Booking']) }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Order Revenue")
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="far fa-money-bill-alt"></i> </div>
      <div>
        <div class="text-value text-primary"><h3 >{{round($RevenueOrder)}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Order Revenue</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('payments',['filterrevenue'=>'Order']) }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Certification")
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="far fa-money-bill-alt"></i> </div>
      <div>
        <div class="text-value text-primary"><h3 >{{round($RevenueCertification)}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Certification</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('certificates.index') }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Course Revenue")
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="far fa-money-bill-alt"></i> </div>
      <div>
        <div class="text-value text-primary"><h3>{{round($RevenueCourse)}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Course Revenue</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('payments',['filterrevenue'=>'Course']) }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@can("Membership Revenue")
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card">
    <div class="card-body widgets d-flex align-items-center">
      <div class="bg-gradient-muted widget-icon"> <i class="far fa-money-bill-alt"></i> </div>
      <div>
        <div class="text-value text-primary"><h3>{{round($RevenueMembership)}}</h3></div>
        <div class="text-muted text-uppercase font-weight-bold small">Membership Revenue</div>
      </div>
    </div>
    <div class="card-footer px-3 py-2"> <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('payments',['filterrevenue'=>'Membership']) }}"> <span class="small font-weight-bold">View More</span> <i class="fal fa-chevron-right text-muted"></i> </a> </div>
  </div>
</div>
@endcan
@endsection