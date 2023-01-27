<script src="{{ asset('front/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('front/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('front/assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('front/assets/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('front/assets/js/sticky.min.js') }}"></script>
<script src="{{ asset('front/assets/js/scripts.js') }}"></script>
<script src="{{ asset('front/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('front/assets/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('front/assets/js/waypoints-min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.zoom.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.show-more.js') }}"></script>
@toastr_js
<script type="text/javascript" src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
@yield('jslinkbottom')
@yield('js')

<script >
	$(window).load(function() {
   $('.preloader').fadeOut('slow');
});
</script>
<script type="text/javascript">
  jQuery.validator.addMethod("customEmail", function(value, element) {
             return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
            }, "Please enter valid email address!");
  jQuery.validator.addMethod("full_name", function(value, element) {
             return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
            }, "Please enter valid full Name !");
</script>
@auth
<script>
    $(document).on('click','.increment',function(){
      var product_id_on = $(this).data('product_id_up');
      var quantity= $('#quantity'+product_id_on+'').val();
      $('#quantity'+product_id_on+'').val(parseInt(quantity)+1);
      AddToCartProduct(product_id_on,'up');
    });    
</script>
@endauth
@auth
<script>
    $(document).on('click','.decrement',function(){
      var product_id_on = $(this).data('product_id_down');
      var quantity= parseInt($('#quantity'+product_id_on+'').val());
      if (quantity>1) {
        $('#quantity'+product_id_on+'').val(quantity-1);
        AddToCartProduct(product_id_on,'down');
      }
    });    
</script>
<script>
  $(document).on('click','.AddToCartProductQuantity',function(){
    var cartquantity = $("#quantity").val();
    var product_id = $("#product_id").data("product_id");
    AddToCartProduct(product_id,'quantity',cartquantity);
  });    
</script>
@endauth
<style type="text/css">
  .toast {
    background-color: #030303;
  }
  .toast-info {
    background-color: #3276b1;
  }
  .toast-info2 {
    background-color: #2f96b4;
  }
  .toast-error {
    background-color: #CA386B;
  }
  .toast-success {
    background-color: #2B3990;
  }
  .toast-warning {
    background-color: #f89406;
  }
</style>
<script type="text/javascript">
   var options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
}
</script>
@auth
<script>
    function GetProductCart() {
      $.ajax({
        url:"{{ route('GetProductCart') }}",
        type: 'get', //this is your method
        dataType: 'json',
        success: function(response){
          // alert(response.data);
          // $('#GetProductCart').html(response.data);
          $('#GetProductCart').html(response.data);
          $('#producttotalquantity').html(response.totalquantity);
          $('#totalsaleprice').html(response.totalsaleprice);
          $('#ShippingCharges').html(response.ShippingCharges);
          $('#sub_total').html(response.sub_total);
          $('#totaldiscount').html(response.totaldiscount); 

        }
      });
    }
    GetProductCart();
</script>
<script>
    function emptyproductcart() {
       swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
       .then((willDelete) => {
        if (willDelete) {
            $.ajax({
            url:"{{ route('emptyproductcart') }}",
            type: 'get', //this is your method
            dataType: 'json',
              success: function(response){
              GetProductCart();
              Get_Cart_Product_Count();
                location.reload();
              }
            });
        } 
      });
  }
    GetProductCart();
</script>
<script>
    $(document).on('click','#emptyproductcart',function(){
      emptyproductcart();
    });    
</script>

<script>
    function Get_Cart_Product_Count() {
      $.ajax({
        url:"{{ route('GetProductCartCount') }}",
        type: 'get', //this is your method
        dataType: 'json',
        success: function(response){
          $('.ProductCartCount').html(response);
        }
      });
    }
    Get_Cart_Product_Count();
</script>
<script>
  function RemoveItemToProductCart(product_id) {
     swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
     .then((willDelete) => {
        if (willDelete) {
            $.ajax({
            url:"{{ route('RemoveItemToProductCart') }}",
            type: "POST",
            dataType: 'json',
            data: {
                  product_id: product_id,
                  _token: '{{csrf_token()}}' 
            },
            success: function(response){
            Get_Cart_Product_Count();
            GetProductCart();
            CheckOutCart();
            }
          });
        } 
      });
  }
</script>
<script>
    $(document).on('click','.RemoveItemToProductCart',function(){
      var product_id = $(this).data('product_id');
      RemoveItemToProductCart(product_id);
    });    
</script>
@endauth
<script>
$(document).ready(function(){
    $(document).on('click','.universaldelete',function(){
        let id = $(this).data('id');
        var notifictionid= $(this).attr("id");
        let model = $(this).data('model');
        let status = $(this).data('status');
       swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
    .then((willDelete) => {
  if (willDelete) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route('universaldelete') }}',
            data: {'id': id,'model':model,'status':status,"_token": "{{ csrf_token() }}"},
            success: function (data) {
              if(data.status=='ok')
              {
                $('.'+notifictionid+'').remove();
              // toastr.success(data.message);
               swal({
                      title: "Success!",
                      text: data.message,
                      icon: "success",
                      button: "Ok!",
                      timer: 2000,
                    });    
              }
              if(data.status=='error')
              {
              alert(data.message);    
              }
      
            },
        });
         } 
       });
    });
});
</script>