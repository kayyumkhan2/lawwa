@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')

<!-- Lawwa My Account -->
<section class="my-account">
  <div class="container">
    <div class="row">
     @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="feedback-header">
            <h6>{{$pagename}} <a href="{{ route('customer.ticket.create') }}" class="float-right link ">Create Ticket</a></h6>
          </div>
           <div class="notification-info notification-info-inner">
	        		@if ($tickets->isEmpty())
						<p>There are currently no tickets.</p>
	        		@else
	        		<div class="table-responsive table-border">
		        		<table class="table">
		        			<thead>
		        				<tr>
		        					<th>Category</th>
		        					<th>Title</th>
		        					<th>Priority</th>
		        					<th>Status</th>
		        					<th>Last Updated</th>
		        					<th style="text-align:center" colspan="2">Actions</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        			@foreach ($tickets as $ticket)
								<tr>
		        					<td>
		        					@foreach ($categories as $category)
		        						@if ($category->id === $ticket->category_id)
											{{ $category->name }}
		        						@endif
		        					@endforeach
		        					</td>
		        					<td>
		        						<a class="title-wight" href="{{ route('customer.ticket.show',$ticket->ticket_id) }}">
		        							#{{ $ticket->ticket_id }} - {{ $ticket->title }}
		        						</a>
		        					</td>
		        					<td>{{ $ticket->priority }}</td>
		        					<td>
		        					@if ($ticket->status === 'Open')
		        						<span class="badge badge-success text-white">{{ $ticket->status }}</span>
		        					@else
		        						<span class="badge badge-danger text-white">{{ $ticket->status }}</span>
		        					@endif
		        					</td>
		        					<td>{{ $ticket->updated_at }}</td>
		        					<td>
		        					@if ($ticket->status === 'Open')
		        						<a href="{{ route('customer.ticket.show',$ticket->ticket_id) }}" class="lawwa-btn">Comment</a>
		        					@endif
		        					</td>
		        					<td>
		        					@if ($ticket->status === 'Open')
		        						<form action="{{ route('customer.ticket.close_ticket' , $ticket->ticket_id) }}" method="POST">
		        							{!! csrf_field() !!}
		        							<button type="submit" class="lawwa-btn lawwa-pink-btn">Close</button>
		        						</form>
		        					@endif
		        					</td>
		        				</tr>
		        			@endforeach
		        			</tbody>
		        		</table>
		        	</div>
								{{ $tickets->links() }}
		        	@endif
	        	</div>
	        </div>
	    </div>
	  </div>
	</div>
</section>
@endsection