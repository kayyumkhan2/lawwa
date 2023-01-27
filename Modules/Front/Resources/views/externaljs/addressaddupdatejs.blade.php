<script type="text/javascript">
$(function() {
  ignore: [],
      $("#address_form").validate({
      rules: {
         'Name': {
          required: true,
         },
         'MobileNumber': {
          required: true,
          digits: true
         },
         'Country': {
          required: true,
         },
         'State_Province_Region': {
          required: true,
         } ,
         'Town_City': {
          required: true,
         },
         'Zip_Postcode': {
          required: true,
          digits: true
         } ,
         'Address_line1': {
          required: true,
         } ,
         'Type': {
          required: true,
         }     
        },
      });
});
</script>
<script>
    function reload_user_address() {
      $.ajax({
        url:"{{ route('GetUserAddress') }}",
        type: 'get', //this is your method
        dataType: 'json',
        success: function(response){
        //  alert(response);
        $('#user_addressess').html(response);
        }
      });
    }
    reload_user_address();
</script>
<script>
  $(document).on('click','#card-new-address',function(){
     $("#country-dropdown")[0].selectedIndex = 0; 
     $(".new-address-add").css("display", "block");  
     $('#address_id').val("null");
     $('#address_form')[0].reset();
     $('#state-dropdown').val(false);
     //$('#country-dropdown').val(false);
     $('#city-dropdown').val(false);
     $("label.error").hide();
     $(".error").removeClass("error");
  });
</script>
<script>
  $(document).on('click','#canceladdress',function(){
     $("#country-dropdown")[0].selectedIndex = 0; 
     $(".new-address-add").css("display", "none");  
     $('#address_id').val("null");
     $('#address_form')[0].reset();
     $('#state-dropdown').val(false);
     //$('#country-dropdown').val(false);
     $('#city-dropdown').val(false);
  });
</script>

<script type="text/javascript">
    $('#address_form').on('submit', function(event){
        event.preventDefault();  
        var form_data = $(this).serialize();
        $.ajax({
            url:"{{ route('customer.AddAddress') }}",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
              if(data.error.length > 0){
                  var error_html = '';
                  for(var count = 0; count < data.error.length; count++){
                      error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                  }
                  $('#form_output').html(error_html);
              }
              else{
                swal({
                  title: "Success",
                  text: data.success,
                  icon: "success",
                });
                  $('#address_form')[0].reset();
                    reload_user_address();
                    $(".new-address-add").css("display", "none");
                }
            }
        })
    });
</script>
<script>
  $(document).ready(function(){
    $(document).on('click','.edit-address',function(){
        $("label.error").hide();
        $(".error").removeClass("error");
        $(".new-address-add").css("display", "block");
        $('#MobileNumber').val($(this).data("mobilenumber"));
        $('#Name').val($(this).data("name"));
        $('#Zip_Postcode').val( $(this).data("zip_postcode"));
        $('#Address_line1').val( $(this).data("address_line1"));
        $('#address_id').val( $(this).data("address_id"));
        $('#country-dropdown').val($(this).data("country"));
          var state_id =($(this).data("state_province_region"));
          var city_id =($(this).data("town_city"));
          var country_id = $(this).data("country"); 
          var address_id = $(this).data("address_id"); 
          var type= $(this).data("type")       
          if (type=='Home') {
             $('#home').prop('checked',true)
          }
          else if(type=='Work'){
            $('#work').prop('checked',true)
          }
          else{
             $('#other').prop('checked',true)
          }
          $("#state-dropdown").html('');
          $.ajax({
            url:"{{url('get-states-by-country')}}",
            type: "POST",
            data: {
              country_id: country_id,
              _token: '{{csrf_token()}}' 
            },
            dataType : 'json',               
            success: function(result){
             $('#state-dropdown').html('<option value="" >Select State</option>');
               $.each(result.states,function(key,value){
                if (state_id==value.id) {
                  $("#state-dropdown").append('<option selected value="'+value.id+'">'+value.name+'</option>');
                }
                else{
                  $("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
                }
            });
              $("#city-dropdown").html('');
              $.ajax({
                url:"{{url('get-cities-by-state')}}",
                type: "POST",
                  data: {
                    state_id: state_id,
                    _token: '{{csrf_token()}}' 
                  },
                  dataType : 'json',
                  success: function(result){
                    $('#city-dropdown').html('<option value="">Select City</option>'); 
                    $.each(result.cities,function(key,city){
                      if (city_id==city.id) {
                        $("#city-dropdown").append('<option selected value="'+city.id+'">'+city.name+'</option>');
                      }
                      else{
                        $("#city-dropdown").append('<option  value="'+city.id+'">'+city.name+'</option>');
                      }
                 }); 
                }
              });
            $('#city-dropdown').html('<option value="" >Select State First</option>'); 
          }
      });
  });
});
</script>