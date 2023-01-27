@extends('admin::layouts.master')
@section('title') Recruitment Applies @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">Recruitment Applies</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Recruitment Applies</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<!--
   @if ($message = Session::get('success'))
   <div class="alert alert-success" role="alert">
      <p>{{ $message }}</p>
   </div>
   @endif-->                                                                                
<div class="col-sm-12">
   <div class="row">
      <div class="col-sm-12 mb-4">
         <div class="box bg-white">
            <div class="box-row">
               <div class="box-content">
                  <table id="dataTable" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col" class="sr-no">S.No</th>
                           <th scope="col">Name</th>
                           <th scope="col">Email</th>
                           <th scope="col">Phone</th>
                           <th scope="col" class="action">Subject</th>
                           <!--<th scope="col">Message</th>-->
                           <th scope="col" class="action">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php  $i=1; @endphp
                        @foreach($applies as $applie)
                        <tr>
                           <th scope="row" class="sr-no"> {{$i++}}</th>
                           <td>{{$applie->name}}</td>
                           <td>{{$applie->email }}</td>
                           <td>{{$applie->phone}}</td>
                           <td>{{ $applie->subject  }}</td>
                           <td class="action ">
                              <a class="icon-btn preview" href="{{ route('recruitmentapplies.show',$applie->id) }}">   
                              <i class="fal fa-eye" id="show-btn"></i></a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@jquery
@toastr_js
@toastr_render
@endsection
@section('js')
<script>
   $(document).ready( function () {
    $('#dataTable').DataTable();
   });
   
</script>
<script>
   $(document).ready(function(){
       $(document).on('click','.querystatuschange',function(){
           let id = $(this).data('id');
           var notifictionid= $(this).attr("id");
          // alert(notifictionid);
           let model = $(this).data('model');
           swal({
               title: "Are you sure?",
               text: "Once change, you will not be able to recover this imaginary!",
               icon: "warning",
               buttons: true,
               dangerMode: true,
           })
            .then((willDelete) => {
         if (willDelete) {
            swal({
                icon: "{{ asset('images/lawwaloder.gif' ) }}",
                buttons: false,      
                closeOnClickOutside: false,
            });
           $.ajax({
               type: "POST",
               dataType: "json",
               url: '{{ route('queries.changestatus') }}',
               data: {'id': id,'model':model,"_token": "{{ csrf_token() }}"},
               success: function (data) {
                 if(data.status=='ok')
                 {
                 swal({
                      title: "Success!",
                      text: data.message,
                      icon: "success",
                      button: "Ok!",
                      timer: 2000,
                    });    
                 }
                 if(data.currentstatus=='1')
                 {
                   $('#'+notifictionid+'').addClass('badge-warning')
                   $('#'+notifictionid+'').removeClass('badge-danger')
                   $('#'+notifictionid+'').text('Pending');
                 }
                 else
                 {
                   $('#'+notifictionid+'').addClass('badge-danger')
                   $('#'+notifictionid+'').removeClass('badge-warning')
                   $('#'+notifictionid+'').text('Close');
                 }
                 if(data.status=='error')
                 {
                    toastr.warning(data.message);    
                 }
               },
            });
            } 
         });
      });
   });
</script>
@endsection
