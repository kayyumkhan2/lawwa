@extends('admin::layouts.master')
@section('title') Order info   @endsection
@section('content')
<style>
.card-title
{
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	
	}
</style>
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1>Order info</h1>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('orders.index')}}">Order</a></li>
          <li class="breadcrumb-item active" aria-current="page">Order Info</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<div class="card">
 <div class="card-header"> 
<div class="d-flex justify-content-between">
    <div>Order id :  {{ $order->id }}</div>
      <div>
       <a class="btn btn-sm btn-warning text-white" href="javascript:history.go(-1)" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Back</a> <a class="btn btn-sm btn-info " href="{{ route('orders.index') }}"  style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">Orders</a>
      </div>
   </div>
</div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-4">
        <div class="card border-text-dark mb-5">
          <div class="card-header"><i class="fa fa-user" aria-hidden="true"></i> Customer : @if(!$order->get_user=="") <a class="badge badge-info" href="{{ route('users.show',$order->get_user->id ) }}">{{ucfirst($order->user_name)}}</a> @else {{ucfirst($order->user_name)}} @endif</div>
          <div class="card-body text-success">
            <h5 class="card-title">@if(!$order->get_user=="") {{ucfirst($order->get_user->phone_no)}} @endif</h5>
            <h5 class="card-title">@if(!$order->get_user=="") {{ucfirst($order->get_user->email)}} @endif</h5>
            
            <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--> 
          </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="card border-.text-dark mb-5">
          <div class="card-header"> 
            @if($order->current_status=='DELIVERED')
              <span class="badge badge-success"> {{ $order->current_status  }} </span>
              @elseif($order->current_status=='PENDING') 
                <span class="badge badge-warning"> {{ $order->current_status  }} </span>
              @elseif($order->current_status=='PAYMENTFAILED')
                 <span class="badge badge-warning"> {{ $order->current_status  }}  </span>
              @elseif($order->current_status=='CANCEL') 
                <span class="badge badge-danger"> {{ $order->current_status  }}  </span> 
              @elseif($order->current_status=='ORDERED') 
                <span class="badge badge-secondary"> {{ $order->current_status  }} </span>
              @elseif($order->current_status=='DISPATCH') 
                <span class="badge badge-info"> {{ $order->current_status  }} </span>
                @elseif($order->current_status=='ONTHEWAY') 
                <span class="badge badge-secondary"> {{ $order->current_status  }} </span>
              @elseif($order->current_status=='REFUNDED') 
                <span class="badge badge-secondary"> {{ $order->current_status  }} </span>
            @endif
          </div>
          <div class="card-body text-success">
            <div class="order-status">
              <ul class="progressbar">
              @foreach($order->OrderStatus as $data)
              <li class="active">
                <span>{{$data->status}}</span>
                <span>{{date('D , M Y', strtotime($data->created_at))}}</span>
              </li>
              @endforeach
              </ul>
            </div>

            <!-- <ul class="progressbar">
               @foreach($order->OrderStatus as $data)
               <li class="active">
                  <span>{{$data->status}}</span>
                  <span>{{date('D , M Y', strtotime($data->created_at))}}</span>
                </li>
               @endforeach
              </ul> -->
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
      	@if($order->current_status=='CANCEL')
      	<div class="card">
        <div class="card-header"><b class="text-danger">Cancel Reason</b> : {{@$order->OrderCancelReason->reason}}</div> 
		  <div class="card-body">
		    {{@$order->OrderCancelReason->comment}}
		  </div>
		</div>
		@endif
        <table class="table table-responsive-sm table-striped">
          <thead>
            <tr class="table-primary">
              <th>Price</th>
              <th>Quantity</th>
              <th>Status</th>
              <th>Receipt</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$order->total_price}}</td>
              <td>{{$order->total_quantity}}</td>
              <td>
               @if($order->current_status=='DELIVERED')<span class="badge badge-success"> {{ $order->current_status  }} </span>
                  @elseif($order->current_status=='PENDING') <span class="badge badge-warning"> {{ $order->current_status  }} </span>
                  @elseif($order->current_status=='PAYMENTFAILED') <span class="badge badge-warning"> {{ $order->current_status  }} </span>
                  @elseif($order->current_status=='CANCEL') <span class="badge badge-danger"> {{ $order->current_status  }} </span> @elseif($order->current_status=='ORDERED') <span class="badge badge-secondary"> {{ $order->current_status  }} </span> @elseif($order->current_status=='DISPATCH') <span class="badge badge-info"> {{ $order->current_status  }} </span>
                  @elseif($order->current_status=='ONTHEWAY') <span class="badge badge-secondary"> {{ $order->current_status  }} </span>
                  @elseif($order->current_status=='REFUNDED') <span class="badge badge-secondary"> {{ $order->current_status  }} </span>
                @endif
            </td>
              <td><a href="{{route('order.downloadinvoice',$order->id)}}">Download</a></td>
              <td>
                <b>{{$order->address_type}}</b> <br>
                 @php $length = strlen($order->address) @endphp
                  @if ($length > 80) 
                   <?php
                    $middle = floor(strlen($order->address) / 2)  ; 
                    [$address1, $address2] = preg_split("~.{{$middle}}[^,]*\K, ?~", $order->address, 2);
                  ?>
                {{$address1}},
                 <br>
                {{$address2}}
                @else
                {{$order->address}}
                @endif
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-12">
        <table class="table table-responsive-sm table-striped table-bordered ">
          <thead>
            <tr class="table-primary">
              <th>Product id</th>
              <th>Name</th>
              <th>Size</th>
              <th>Color</th>
              <th>Unit</th>
              <th>Price</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>   
          @foreach ($order->OrderProducts as $key => $value)
          <tr>
            <td>{{$value->product_id}}</td>
            <td>{{$value->product_name}}</td>
            <td>{{ $value->size ? $value->size : 'Default' }}</td>
            <td>{{ $value->size ? $value->color: 'Default' }}</td>
            <td>{{ $value->size ? $value->unit : 'Default' }}</td>
            <td>{{$value->product_price}}</td>
            <td>{{$value->product_quantity}}</td>
          </tr>
          @endforeach
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <td>Shipping Charges : <b class="text-danger">{{$order->ShippingCharges}}</b></td>
            <td></td>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <td>Total Price : <b class="text-danger">{{ $order->total_price }}</b></td>
            <td>Total Quantity : <b>{{ $order->total_quantity }}</b></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    
   
  </div>
</div>
@endsection 