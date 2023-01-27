@extends('admin::layouts.master')
@section('title') Course Sold @endsection
@section('content')
<div class="main-content">
    <div class="page-title col-sm-12">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 m-0">Course Sold</h1>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Course Sold</li>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($Courseuser as $Val)
                                    <tr class="notification{{$Val->id}}">
                                        <th scope="row" class="sr-no"> {{$i++}}</th>
                                        <td>{{$Val->amount}}</td>
                                        <td>{{$Val->txn_id}}</td>
                                        <td>{{$Val->course_name}}</td>
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
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly updated!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
});
</script> 
@endsection

