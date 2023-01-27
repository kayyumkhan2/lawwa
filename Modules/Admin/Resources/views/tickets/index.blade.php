@extends('admin::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
<div class="main-content">
<div class="page-title col-sm-12">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1 class="h3 m-0">{{$pagename}}</h1>
    </div>
    <div class="col-md-6">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$pagename}}</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-12 text-right"> 
      <a class="btn btn-sm btn-warning rounded-pill text-white" href="javascript:history.go(-1)"><i class="fas fa-arrow-circle-left"></i> Back </a>
    </div>
    <div class="col-sm-12 mb-4 mt-3" >
      <div class="box bg-white">
        <div class="box-row">
          <div class="box-content">
           <div class="panel-body">
            @if ($tickets->isEmpty())
            <p>There are currently no tickets.</p>
            @else
            <table id="dataTable" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr>
                     <th>So</th>
                     <th>Category</th>
                     <th>Title</th>
                     <th>Priority</th>
                     <th>Status</th>
                     <th>Last Updated</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                @php $i=1 @endphp
                  @foreach ($tickets as $ticket)
                  <tr>
                    <td>{{$i++}}</td>
                     <td>
                        @foreach ($categories as $category)
                          @if ($category->id === $ticket->category_id)
                          {{ $category->name }}
                          @endif
                        @endforeach
                     </td>
                     <td>
                        <a href="{{ route('admin.tickets.show',$ticket->ticket_id) }}">
                        #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                        </a>
                     </td>
                     <td>{{$ticket->priority}}</td>
                     <td>
                        @if ($ticket->status === 'Open')
                          <span class="badge badge-success">{{ $ticket->status }}</span>
                        @else
                          <span class="badge badge-danger">{{ $ticket->status }}</span>
                        @endif
                     </td>
                     <td>{{ $ticket->updated_at }}</td>
                     <td>
                      <div class="row">
                        <div class="col">                        
                          <a href="{{ route('admin.tickets.show',$ticket->ticket_id) }}" class="btn btn-sm btn-primary">Comment</a>
                        </div>
                        @if ($ticket->status === 'Open')
                        <div class="col"> 
                          <form action="{{ route('admin.ticket.close_ticket',$ticket->ticket_id) }}" method="POST">
                           {!! csrf_field() !!}
                           <button type="submit" class="btn btn-sm btn-danger">Close</button>
                        </form>
                      </div>
                      @endif
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            @endif
         </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@toastr_js
@toastr_render
@endsection

@section('js') 

<script>
    $('#dataTable').DataTable();
</script>
@endsection 