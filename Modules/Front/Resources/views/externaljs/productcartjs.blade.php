<script>
    function GetProductCart() {
      $.ajax({
        url:"{{ route('GetProductCart') }}",
        type: 'get', //this is your method
        dataType: 'json',
        success: function(response){
          //alert(response);
          $('#GetProductCart').html(response.data);
          $('#producttotalquantity').html(response.totalquantity);
          $('#totalprice').html(response.totalprice);
          $('#sub_total').html(response.sub_total);
          
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
<script>
  function AddToCartProduct(product_id) {
        //  alert(product_id);
            $.ajax({
                url:"{{ route('AddToCartProduct') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    product_id: product_id,
                    _token: '{{csrf_token()}}' 
            },
            success: function(response){
            Get_Cart_Product_Count();
        }
    });
  }
</script>
<script>
    $(document).on('click','.AddToCartProduct',function(){
      var product_id = $(this).data('product_id');
      AddToCartProduct(product_id);
    });    
</script>

<script>
$(document).ready(function(){
    $(document).on('click','.universaldelete',function(){
        let id = $(this).data('id');
        var notifictionid= $(this).attr("id");
        // alert(notifictionid);
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
               reload_address();
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