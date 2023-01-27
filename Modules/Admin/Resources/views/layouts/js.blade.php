<link href="{{ asset('admin/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ asset('admin/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap.bundle.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/daterangepicker.min.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/select2.min.js') }}"></script>
<script src="{{ asset('admin/js/app.js') }}"></script>
<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/js/jquery.imgareaselect.min.js" integrity="sha512-59swnhUs+9AinrKlTPqsoO5ukNPPFbPXFyaf41MAgiTG/fv3LBZwWQWiZNYeksneLhiUo4xjh/leTZ53sZzQ4Q==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/js/jquery.imgareaselect.pack.js" integrity="sha512-ALBRD8RI3E1FAUPtPZ4bEEZ7EdfRT/gOxkX1CrrS9pMfxRrTPIFhglvfFs3puB4CenVg9SD0m3uydtBYHFny9A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/js/jquery.imgareaselect.js" integrity="sha512-dt/pzq6FVYkejyZ/oLCrWIDmfJSpFOGiwExcHURKdNawbwWXLNvtmKjAmZ2y5ht4LX5G0dQNwp7MQXw2t/E4ig==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/css/imgareaselect-deprecated.css" integrity="sha512-XJ1M0LEiy89IgpcyTIClowc3M9TNlrVb/IShMNjq/IaaXRjtEWq5e5ARBrkPKmmt0MbKKx8+xxdJntWYo9yrYw==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/css/imgareaselect-default.css" integrity="sha512-wUdm/cyWPwiPypgc4kem0zyqbdCfAFIMElxGR1LOTgIT4uS9KSi5XwBLnQtGFC5QGmtcwPSnuGaDrFzD1T1ilA==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/css/imgareaselect-animated.css" integrity="sha512-VOWGVItJ5anAaHwRzNFPo8YGbAGDl34AkUq0/Dkn4UJxK0ag95IZQWoitH6xM7Bq6C3i2VW5oFzkL1+wYkLdmQ==" crossorigin="anonymous" />

@yield('js')
@yield('jslinkbottom')
@toastr_css
@toastr_js
<script>
jQuery(document).ready(function() {
    jQuery('#loading').fadeOut(1000);
});
</script>
<script type="text/javascript">
    $('button,.Statuschange').on('click', function () {
        return confirm('Are you sure?');
    });
</script>
<script>
$(document).ready(function(){
    $(document).on('click','.deletenotification',function(){
        let id = $(this).data('id');
        var notifictionid= $(this).attr("id");
        let model = $(this).data('model');
        let status = $(this).data('status');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route('notificationsalstatuschange') }}',
            data: {'id': id,'model':model,'status':status,"_token": "{{ csrf_token() }}"},
            success: function (data) {
            if(data.status=='ok')
              {
               $('#'+notifictionid+'').remove();
                window.location.href = data.route;
              }
              if(data.status=='error')
              {
              alert(data.message);    
              }
            },
        });
    });
});
</script>
<script>
$(document).ready(function(){
    $(document).on('click','.clearall',function(){
        let model = $(this).data('model');
        var action='clearall';
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route('notificationsalstatuschange') }}',
            data: {'model':model,'action':action,"_token": "{{ csrf_token() }}"},
            success: function (data) {
            if(data.status=='ok')
              {
               $('#'+notifictionid+'').remove();
                window.location.href = data.route;
            if(data.status=="clearall")
              {
               $('.noti-scroll').remove();
               $('#Viewall').remove();
               var div_data = '<div><h6>No Notification Found</h6></div>';
               $("#clearallafter").html(div_data);
                toastr.success(data.message);    
              }
              if(data.status=='error')
              {
                alert(data.message);    
              }
            },
        });
    });
});
</script>
<script>
    $(document).on('click','.nav-item',function(){
     var tempheight = $('.nav-menu').height()/3;
     var position=$(this).data("position")
       // var tempheight = $('.nav-menu').scrollTop();
       if (position=="middle") {
        @php session()->put( 'sidebarheight', '710' ); @endphp
            tempheight={{session()->get( 'sidebarheight')}}
       }
       else{
        @php session()->put( 'sidebarheight', "0" ); @endphp
            tempheight={{session()->get( 'sidebarheight')}};
       }
       // alert(tempheight);
     $('.dashboard-menu').animate({
         scrollTop: tempheight
     }, 'slow');
 });
</script>
 <script type="text/javascript">
    $(document).ready(function() {
        var position = $(".active").data("position")
       if (position=="middle") {
            tempheight=550;
       }
       else{
            tempheight=0;
       }
       <?php  
           if (session()->has('sidebarheight')) {?>
                $('.dashboard-menu').animate({
                    scrollTop: tempheight
                }, 'slow');
            <?php }
       ?>
    });
 </script>

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
                url: "{{ route('universaldelete') }}",
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

<script>
    $(document).ready(function(){

        $(document).on('click','.Statuschange',function(){
            let id = $(this).data('id');
            var notifictionid= $(this).attr("id");
            let model = $(this).data('model');
          //  alert(model);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('universalstatuschange') }}",
                data: {'id': id,'model':model,"_token": "{{ csrf_token() }}"},
                success: function (data) {
                            //  alert(data.currentstatus);
                  if(data.status=='ok')
                  {
                  toastr.success(data.message);    
                  }
                  if(data.currentstatus==1)
                  {
                    $('#'+notifictionid+'').addClass('badge-success')
                    $('#'+notifictionid+'').removeClass('badge-danger')
                    $('#'+notifictionid+'').text('Active');

                  }
                  else
                  {

                    $('#'+notifictionid+'').addClass('badge-danger')
                    $('#'+notifictionid+'').removeClass('badge-success')
                    $('#'+notifictionid+'').text('inactive');
                  }
                  
                  if(data.status=='error')
                  {
                 toastr.warning(data.message);    
                  }
          
                },

            });
        });
    });
</script>

