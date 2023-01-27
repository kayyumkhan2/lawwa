@extends('admin::layouts.master')
@section('title') Certificates Applied @endsection
@section('content')
<div class="main-content">
    <div class="page-title col-sm-12">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 m-0">Certificates Applied</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Certificates Applied</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @if ($message = Session::get('errors'))
    <div class="alert alert-danger" role="alert">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <div class="box bg-white">
                    <div class="box-row">
                        <div class="box-content">
                            <table id="dataTable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sr-no">#</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Txn_id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Date</th>
                                       <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($certificates as $Val)
                                    <tr class="notification{{$Val->id}}">
                                        <th scope="row" class="sr-no"> {{$i++}}</th>
                                        <td>{{$Val->amount}}</td>
                                        <td>{{$Val->txn_id}}</td>
                                        <td>{{$Val->certificate_name}}</td>
                                         <td>
                                           @if(!$Val->UserInfo=="") 
                                             <a class="badge badge-info" href="{{ route('users.show',$Val->UserInfo->id ) }}">{{$Val->UserInfo->full_name}}</a>
                                           @else 
                                            User not found
                                           @endif
                                       </td>
                                        <td>
                                            {{ date_format($Val->created_at,"d M Y")}}
                                        </td>
                                       <td>
                                            <span class="badge badge-primary status{{$Val->id}}"> {{ $Val->status  }} </span>
                                             @if($Val->current_status != 'UPLOADED  ' )
                                                 <select id="certificate-status-change"  data-id="{{$Val->id}}" >
                                                   <option value="PENDING"  {{$Val->current_status  == 'PENDING' ? 'selected' : ''}}> PENDING  </option>
                                                   <option value="UPLOADED"  {{$Val->current_status == 'UPLOADED' ? 'selected' : ''}}> UPLOADED  </option>
                                                   <option value="FAILED" {{$Val->current_status  == 'FAILED' ? 'selected' : ''}}> FAILED </option>
                                                 </select>
                                             @endif
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
</div>

@endsection
@section('js')
<script>
  $('#dataTable').DataTable();
</script>
<script>
$(document).ready(function(){
    $(document).on('change','#certificate-status-change',function(){
        var id = $(this).data('id');
        var status = $(this).val();
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
            url: "{{ route('certificates.updatestatus') }}",
            data: {'id': id,'status':status,"_token": "{{ csrf_token() }}"},
            success: function (data) {
              if(data.status=='ok')
              {
               $('.status'+id+'').text(status);
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
                swal({
                  title: "error!",
                  text: data.message,
                  icon: "error",
                  button: "Ok!",
                  timer: 2000,
                });    
              }
            },
           error: function (request, status, error) {
           swal({
                 title: "error!",
                 text: "Something is wrong",
                 icon: "error",
                 button: "Ok!",
                 timer: 3000,
           });  
            }
        });
        } 
       });
    });
});
</script> 
@endsection

