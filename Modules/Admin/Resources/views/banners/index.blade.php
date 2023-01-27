@extends('admin::layouts.master')
@section('title') Add Banner @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="h3 m-0">Banners</h1>
      </div>
      <div class="col-md-6">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Banners</li>
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
<div class="col-md-12 bg-muted text-right">
  <a class="btn btn-sm btn-warning rounded-pill text-white" href="javascript:history.go(-1)"> Back</a>
  <a class="btn btn-sm btn-info rounded-pill" href="{{ route('banners.create') }}" > Create Banner</a>
</div>
<div class="col-sm-12 mt-2">
   <div class="row">
      <div class="col-sm-12 mb-4">
         <div class="box bg-white">
            <div class="box-row">
               <div class="box-content">
                  <div class="row mt-6">
                     <div class="col-md-12 ">
                        <table id="table" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th width="30px" class="action">#</th>
                                 <th class="action">Title</th>
                               <!--  <th class="action float-center">Url</th>-->
                                 <th>Order</th>
                                 <th class="action">Status</th>

                                 <th class="action float-center">Banner</th>
                                 <th class="action float-center">Actions</th>
                              </tr>
                           </thead>
                           <tbody id="tablecontents">
                              @foreach($banners as $banner)

                              <tr class="row1 notification{{$banner->id}}" data-id="{{ $banner->id }}" >
                                 <td class="pl-3"><i class="fa fa-sort"></i></td>
                                 <td>{{ $banner->title }}</td>
                                <!-- <td>{{ $banner->url }}</td>-->
                                 <td>{{ $banner->order }}</td>

                                <td>   <span class="Statuschange badge @if($banner->status=='0') badge-danger @else badge badge-success @endif" data-id="{{$banner->id}}"  data-model="Banner" id="Statuschange{{$banner->id}}">
                                @if($banner->status=="0") Deactive @else Active @endif 
                                  </span></td>
                                 <td>
                                  <img src="{{ asset('public/images/banner_images/'.$banner->banner) }}" alt="img" width="100" height="100">
                                </td>
                                 </td>
                                 <td class="action float-center">
                                    <a class="icon-btn preview" href="{{ route('banners.show',$banner->id) }}">     
                                    <i class="fal fa-eye"  id="show-btn"></i></a></a>
                                    <a class="icon-btn edit" href="{{ route('banners.edit',$banner->id) }}">
                                    <i class="fal fa-edit" id="show-edit"></i></a>
                                   <a class="icon-btn delete universaldelete" href="javascript:void(0);" data-status="0" data-id="{{ $banner->id}}"  data-model="Banner" id="notification{{$banner->id}}" > <i class="fal fa-trash-alt" id="delete-btn"></i></a> 
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                        <!--<h5><button class="btn btn-primary btn-sm" onclick="window.location.reload()">REFRESH</button></h5>-->
                     </div>
                  </div>
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
    $('#table').DataTable();
});

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


<script type="text/javascript">
  
</script>
<script type="text/javascript">
   $(function () {

     $("#table").DataTable();
     $( "#tablecontents" ).sortable({


       items: "tr",
       cursor: 'move',
       opacity: 0.6,
   
       update: function() {
           sendOrderToServer();
       }
     });
        function sendOrderToServer() {

       var order = [];
       var token = $('meta[name="csrf-token"]').attr('content');
       $('tr.row1').each(function(index,element) {
         order.push({
           id: $(this).attr('data-id'),
           position: index+1
  
         });
   
       });
       $.ajax({
         type: "POST", 
         dataType: "json", 
         {{--url: "{{ route('post-sortable') }}"--}},
             data: {
           order: order,
           _token: token
         },
   
         success: function(response) {
             if (response.status == "success") {
               alert("asdas");
             } else {
	               alert("asdas");
   
             }
   
         }
   
       });
   
     }
   
   });
   
</script>
@endsection

