@extends('front::layouts.master')
@section('title')#{{ $ticket->ticket_id }} - {{ $ticket->title }}@endsection
@section('content')
@section('customcss')
<style type="text/css">
   /*body{
   margin-top:20px;
   background:#eee;
   }*/
   .row.row-broken {
   padding-bottom: 0;
   }
  /* .col-inside-lg {
   padding: 20px 0 20px 20px;
   }*/
   /*.chat {
   height: calc(100vh - 180px);
   }*/
   .decor-default {
   background-color: #ffffff;
   }
   .chat-users h6 {
   font-size: 20px;
   margin: 0 0 20px;
   }
   .chat-users .user {
   position: relative;
   padding: 0 0 0 50px;
   display: block;
   cursor: pointer;
   margin: 0 0 20px;
   }
   .chat-users .user .avatar {
   top: 0;
   left: 0;
   }
   .chat .avatar {
   width: 40px;
   height: 40px;
   position: absolute;
   }
   .chat .avatar img {
   display: block;
   border-radius: 20px;
   height: 100%;
   }
   .chat .avatar .status.off {
   border: 1px solid #5a5a5a;
   background: #ffffff;
   }
   .chat .avatar .status.online {
   background: #4caf50;
   }
   .chat .avatar .status.busy {
   background: #ffc107;
   }
   .chat .avatar .status.offline {
   background: #ed4e6e;
   }
   .chat-users .user .status {
   bottom: 0;
   left: 28px;
   }
   .chat .avatar .status {
   width: 10px;
   height: 10px;
   border-radius: 5px;
   position: absolute;
   }
   .chat-users .user .name {
   font-size: 14px;
   font-weight: bold;
   line-height: 20px;
   white-space: nowrap;
   overflow: hidden;
   text-overflow: ellipsis;
   }
   .chat-users .user .mood {
   font: 200 14px/20px "Raleway", sans-serif;
   white-space: nowrap;
   overflow: hidden;
   text-overflow: ellipsis;
   }
   /*****************CHAT BODY *******************/
   .chat-body h6 {
   font-size: 20px;
   margin: 0 0 20px;
   }
   .chat-body .answer.left {
   padding: 0 0 0 58px;
   text-align: left;
   float: left;
   }
   .chat-body .answer {
   position: relative;
   max-width: 600px;
   overflow: hidden;
   clear: both;
   }
   .chat-body .answer.left .avatar {
   left: 0;
   }
   .chat-body .answer .avatar {
   bottom: 36px;
   }
   .chat .avatar {
   width: 40px;
   height: 40px;
   position: absolute;
   }
   .chat .avatar img {
   display: block;
   border-radius: 20px;
   height: 100%;
   }
   .chat-body .answer .name {
   font-size: 14px;
   line-height: 36px;
   }
   .chat-body .answer.left .avatar .status {
   right: 4px;
   }
   .chat-body .answer .avatar .status {
   bottom: 0;
   }
   .chat-body .answer.left .text {
   background: #ebebeb;
   color: #333333;
   border-radius: 8px 8px 8px 0;
   }
   .chat-body .answer .text {
   padding: 12px;
   font-size: 16px;
   line-height: 26px;
   position: relative;
   }
   .chat-body .answer.left .text:before {
   left: -30px;
   border-right-color: #ebebeb;
   border-right-width: 12px;
   }
   .chat-body .answer .text:before {
   content: '';
   display: block;
   position: absolute;
   bottom: 0;
   border: 18px solid transparent;
   border-bottom-width: 0;
   }
   .chat-body .answer.left .time {
   padding-left: 12px;
   color: #333333;
   }
   .chat-body .answer .time {
   font-size: 16px;
   line-height: 36px;
   position: relative;
   padding-bottom: 1px;
   }
   /*RIGHT*/
   .chat-body .answer.right {
   padding: 0 58px 0 0;
   text-align: right;
   float: right;
   }
   .chat-body .answer.right .avatar {
   right: 0;
   }
   .chat-body .answer.right .avatar .status {
   left: 4px;
   }
   .chat-body .answer.right .text {
   background: #7266ba;
   color: #ffffff;
   border-radius: 8px 8px 0 8px;
   }
   .chat-body .answer.right .text:before {
   right: -30px;
   border-left-color: #7266ba;
   border-left-width: 12px;
   }
   .chat-body .answer.right .time {
   padding-right: 12px;
   color: #333333;
   }
   /**************ADD FORM ***************/
   .chat-body .answer-add {
      position: relative;
   clear: both;
   margin: 0;
   padding: 5px;
   background: #7266ba;
   }
   .chat-body .answer-add input {
   border: none;
   background: none;
   display: block;
   width: 100%;
   font-size: 16px;
   line-height: 20px;
   padding: 0;
   color: #686B77;
   background: #fff;
height: 50px;
padding: 12px 15px;
border-radius: 0;
   }
.chat-body .answer-add button {
   position: absolute;
right: 0;
top: 50%;
transform: translateY(-50%);
font-size: 21px;
padding: 12px 25px;
background: #7266ba;
color: #fff;
}
   .chat input {
   -webkit-appearance: none;
   border-radius: 0;
   }
   .chat-body .answer-add .answer-btn-1 {
   background: url("http://91.234.35.26/iwiki-admin/v1.0.0/admin/img/icon-40.png") 50% 50% no-repeat;
   right: 56px;
   }
   .chat-body .answer-add .answer-btn {
   display: block;
   cursor: pointer;
   width: 36px;
   height: 36px;
   position: absolute;
   top: 50%;
   margin-top: -18px;
   }
   .chat-body .answer-add .answer-btn-2 {
   background: url("http://91.234.35.26/iwiki-admin/v1.0.0/admin/img/icon-41.png") 50% 50% no-repeat;
   right: 20px;
   }
   .chat input::-webkit-input-placeholder {
   color: #fff;
   }
   .chat input:-moz-placeholder { /* Firefox 18- */
   color: #fff;  
   }
   .chat input::-moz-placeholder {  /* Firefox 19+ */
   color: #fff;  
   }
   .chat input:-ms-input-placeholder {  
   color: #fff;  
   }
   .chat input {
   -webkit-appearance: none;
   border-radius: 0;
   }
</style>
@endsection
	<!-- Lawwa My Account -->
	<section class="my-account">
	<div class="container">
	<div class="row">
	   @include('customer::includes.sidebar')
	   <div class="col-lg-9">
	      <div class="right-content content">
	         <div class="feedback-header">
	            <h6>#{{ $ticket->ticket_id }} - {{ $ticket->title }}</h6>
	         </div>
            <div class="ticket-right-content">
   	         <div class="ticket-info">
   	           <div class="row">
                     <div class="col">Category : {{ $category->name }}</div>
                     <div class="col">
                        @if ($ticket->status === 'Open')
                           Status: <span class="badge badge-success">{{ $ticket->status }}</span>
                        @else
                           Status: <span class="badge badge-danger">{{ $ticket->status }}</span>
                        @endif
                     </div>
                     <div class="col">Created on: {{ $ticket->created_at->diffForHumans() }}</div>
                  </div>
               <hr>
               <p>{{ ucfirst($ticket->message) }}</p>
   	         </div>
   	         <div class="content container-fluid bootstrap snippets p-0">
   	            <div class="row row-broken">
   	               <div class="col-sm-12 col-xs-12" tabindex="5001">
   	                  <div class="col-inside-lg decor-default">
   	                     <div class="chat-body">
                              <div class="test chat">
   	                        @foreach ($comments as $comment)
   	                        @if($comment->user_id!=auth()->user()->id)
   	                        <div class="answer left">
                              <div class="avatar">
                                 <img src="{{asset('images/usericon.png')}}" alt="User name">
                                 @if(Cache::has('user-is-online-' . $comment->user_id) && ($comment->user_id !="" ))
                                    <div class="status online"></div>  
                                 @else
                                    <div class="status offline"></div>
                                @endif 
                              </div>
                              <div class="name"> {{ucfirst($comment->full_name)}}</div>
                              <div class="text">
                                 {{ucfirst($comment->comment)}}
                              </div>
                              <div class="time">{{ $comment->created_at->diffForHumans() }} 
                              </div>
                           </div>
   	                        @else
   	                        <div class="answer right">
                                 <div class="avatar">
                                    <img src="{{asset('images/usericon.png')}}" alt="User name">
                                    @if(Cache::has('user-is-online-' . Auth::user()->id))
                                       <div class="status online"></div>  
                                    @else
                                       <div class="status offline"></div>
                                    @endif 
                                 </div>
                                 <div class="name"> {{ucfirst($comment->full_name)}}</div>
                                 <div class="text">
                                    {{ucfirst($comment->comment)}}
                                 </div>
                                 <div class="time">{{ $comment->created_at->diffForHumans() }} 
                                 </div>
                              </div>
   	                        @endif  
   	                        @endforeach
   	                    <div id="chat-messages"></div>
                           </div>
   	                        <div class="answer-add">
   	                           <form action="{{ route('customer.ticket.comment') }}" method="POST" class="form">
   	                              {!! csrf_field() !!}
   	                              <input name="comment" placeholder="Write your message here">
   	                              <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
   	                              <button type="submit" class="btn btn-primary float-right">Send</button>
   	                           </form>
   	                           <span class="answer-btn answer-btn-2"></span>
   	                        </div>
   	                     </div>
   	                  </div>
   	               </div>
   	            </div>
   	         </div>
            </div>
	      </div>
	   </div>
	</div>
</div>
</section>

@endsection
@section('jslinkbottom')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>
@endsection
@section('js')
	<script type="text/javascript"> 
	 $(".chat").niceScroll();
	</script>
@endsection
