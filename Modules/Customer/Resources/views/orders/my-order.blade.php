@extends('front::layouts.master')
@section('title') My orders @endsection
@section('content')
<!-- Lawwa My Account -->
<section class="my-order">
  <div class="container">
    <div class="row">
      @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="right-header">
            <div class="row align-items-center">
              <div class="col-sm-7">
                <h6>My orders</h6>
              </div>
              <div class="col-sm-5">
                <div class="form-group m-0">
                  <select class="form-control" id="order-filter">
                    <option value="All"  {{request()->get('filter')  == 'All' ? 'selected' : ''}} >All</option>
                    <option value="UPCOMING" {{request()->get('filter')  == 'UPCOMING' ? 'selected' : ''}}>UPCOMING ORDER</option>
                    <option value="DELIVERED" {{request()->get('filter')  == 'DELIVERED' ? 'selected' : ''}}>DELIVERED ORDER</option>
                    <option value="DISPATCH" {{request()->get('filter')  == 'DISPATCH' ? 'selected' : ''}}>DISPATCH ORDER</option>
                    <option value="CANCEL" {{request()->get('filter')  == 'CANCEL' ? 'selected' : ''}}>CANCEL ORDER</option>
                    <option value="ONTHEWAY" {{request()->get('filter')  == 'ONTHEWAY' ? 'selected' : ''}}>ON THE WAY ORDER</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="order-info">
          @foreach($Orders as $Order)
            <div class="singal-order">
              <div class="table-responsive">
                <table class="table m-0">
                  <tr>
                    <td>
                      <table class="table m-0">
                        <tr>
                          <td>
                            <div class="order-detail">
                              <h6><strong>Order Id :</strong> <span>{{$Order->id}}</span></h6>
                              <h6><strong>Products  :</strong> <span>
                                @foreach($Order->OrderProducts as $value) 
                                  {{$value->product_name}} @if(!$loop->last)<b style="color: #4F5DB2;">|</b>@endif
                                @endforeach </span></h6>
                              <h6><strong>Price :</strong> <span>RM {{$Order->total_price}}</span></h6>
                              <h6><strong>Address :</strong> <span>{{$Order->address}}</span></h6>
                            </div>
                          </td>
                          <td align="center">
                            <div class="img-block">
                              <div class="lawwa-table-wrap">
                                <div class="lawwa-align-wrap">
                                  <img src="{{ asset('images/productsimages/'.$value->product_image)}}">
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="btn-block">
                              <a href="{{route('customer.order.details',$Order->id)}}" class="lawwa-btn">View</a>
                              <br>
                              <b class="text-success">{{$Order->current_status}}</b>
                              <br><br>
                              @if($Order->current_status != 'CANCEL' && $Order->current_status != 'PAYMENTFAILED' && $Order->current_status != 'PENDING' && $Order->current_status != 'DELIVERED' && $Order->current_status != 'REFUNDED' ) 
                                <a href="#0" class="link" data-toggle="modal" data-orderid="{{$Order->id}}" data-target="#exampleModalCenter">Cancel</a>
                              @endif
                            </div>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          @endforeach
          </div>
          <div class="mt-1 float-right"> 
            {{ $Orders->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Reason cancel to order </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form method="post" action="{{route('customer.order.cancel')}}" id="gallery_upload_image_form" enctype="multipart/form-data"  >
          <div class="modal-body">
           <span id="gallery_form_output"></span>
              @csrf  
              @method('PUT')
              <div class="row">
                <input type="text" name="order_id" hidden="" required="" value="">
                <input type="text" name="status" hidden="" required="" value="CANCEL">
                <div class="col-md-12">
                   <select class="form-control" required="" name="reason">
                   <option value="">Please select cancel reason</option>
                   <option value="Product is taking too long to be delivered.">Product is taking too long to be delivered.</option> 
                   <option value="Product is not required anymore.">Product is not required anymore.</option> 
                   <option value="Cheaper alternative available for lesser price.">Cheaper alternative available for lesser price.</option> 
                   <option value="Bad review from friends/relatives after ordering the product.">Bad review from friends/relatives after ordering the product.</option> 
                   <option value="If you are not going to be available in town due to some urgent travel.">If you are not going to be available in town due to some urgent travel.</option> 
                  </select>
                </div>
                <div class="col-md-12 mt-2">
                  <textarea name="comment" class="form-control" placeholder="Comment.."></textarea>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn lawwa-pink-btn text-white"  data-dismiss="modal">Close</button>
            <button type="submit" class="btn lawwa-pink-btn text-white" onclick="return confirm('Are you sure you want to cancel this order?');" value="Change">Save</button> 
          </div>
          </form>
      </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
   $('#order-filter').change(function(){
     var filtertype = $(this).val();
     var url = "{{route('customer.orders')}}"+"/"+'?filter='+filtertype;
     window.location = url ;
  });
</script>
<script>
  $("form").submit(function (e) {
    let value = $('.order_id').val();
    if (value=="") 
      {
        e.preventDefault();
      }
  });
</script>
<script>
  $(document).ready(function(){ 
    $('.link').click(function(){
        var orderid = $(this).data("orderid");
        $('input[name="order_id"]').val(orderid);
     });
  });
</script>
@endsection