<script>
    function CheckOutCart() {
      $.ajax({
        url:"{{ route('CheckOutCart') }}",
        type: 'get', 
        dataType: 'json',
        success: function(response){
          if(response.totalquantity<=0){
            swal({
                  title:"error!",
                  text: "Your cart is empty please select item before checkout!",
                  icon: "info",
              }).then(function() {
                  window.location.href = "{{route('products.productscategory')}}";
              });
           }
          $('#CheckOutCart').html(response.data);
          $('#producttotalquantity').html(response.totalquantity);
          $('#totalsaleprice').html(response.totalsaleprice);
          $('#totaldiscount').html(response.totaldiscount); 
          $('#sub_total').html(response.sub_total);
          $('#ShippingCharges').html(response.ShippingCharges);
        }
      });
    }
    CheckOutCart();
</script>
<script type="text/javascript">
$(function() {
  ignore: [],
  $("#address_select").validate({
    rules: {
      'selected_address':{
        required: true,
      }   
    },
  });
});
</script>
<script type="text/javascript">
  $("#Checkout").click(function() {
    if($("input:radio[name='selected_address']").is(":checked") && $("input:checkbox[name='Terms']").is(":checked"))
      {
        $("#selected_address").val();
        $("#address_select").submit();
      }
      else
      {
        swal({
          title: "error!",
          text: "Please select to address before checkout!",
          icon: "info",
        });
      }
    });
</script>
