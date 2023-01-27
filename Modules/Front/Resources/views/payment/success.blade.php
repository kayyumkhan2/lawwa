<!DOCTYPE html>
<html>
<head>
<head>
<title>
  Success 
</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
    .modal-section {
      background-color: #005cb9;
    }
    .thank-you-pop{
    	width:100%;
     	padding:20px;
    	text-align:center;
    }
    .thank-you-pop img{
    	width:76px;
    	height:auto;
    	margin:0 auto;
    	display:block;
    	margin-bottom:25px;
    }

    .thank-you-pop h1{
    	font-size: 50px;
      margin-bottom: 25px;
      color: #2b3990;
      font-weight: 600;
    }
    .thank-you-pop p{
    	font-size: 20px;
        margin-bottom: 27px;
     	color:#5C5C5C;
    }
    .thank-you-pop h3.cupon-pop{
    	font-size: 25px;
      margin-bottom: 40px;
    	color:#2B3990;
    	display:inline-block;
    	text-align:center;
    	padding:12px 30px;
    	border:2px dashed #2B3990;
    	clear:both;
    	font-weight:normal;
    }
    .thank-you-pop h3.cupon-pop span{
    	color:#D83968;
    }
    .thank-you-pop .lawwa-btn {
    	display: inline-block;
        margin: 0 auto 20px;
        padding: 9px 20px;
        color: #fff;
        text-transform: uppercase;
        font-size: 24px;
        background-color: #2B3990;
        border-radius: 4px;
        border-color: #2B3990;
        transition: all ease .8s;
        text-decoration: none;
    }
    .thank-you-pop .lawwa-btn:hover {
      background-color: #D83968;
      border-color: #D83968;
    }
    .thank-you-pop a i{
    	margin-right:5px;
    	color:#fff;
    }
    #ignismyModal .modal-header{
        border:0px;
    }
    .modal-open .modal {
      background: linear-gradient(180deg, rgba(43,57,144,1) 43%, rgba(184,41,83,1) 81%, rgba(216,57,104,1) 100%);
    }
    .modal-dialog {
      width: 680px;
      margin: 70px auto;
    }

/* Responsive Start */
@media screen and (max-width:1199px) {}
@media screen and (max-width:767px) {
  .modal-dialog {
    width: 520px;
  }
}
 @media screen and (max-width:575px) {
    .modal-dialog {
        width: 420px;
    }
 }

@media screen and (max-width:479px) {
  .modal-dialog {
    width: 350px;
  }
  .thank-you-pop {
    padding: 0;
  }
  .thank-you-pop h1 {
    font-size: 40px;
  }
}

 @media screen and (max-width:359px) {
  .modal-dialog {
    width: 300px;
  }
} 
</style>	
</head>
<body>
<div class="modal-section">
<div class="container">
    <div class="row">
       <div class="modal fade" id="ignismyModal" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>-->
                     </div>
                <div class="modal-body">
  					<div class="thank-you-pop">
                        <img src="{{ asset('front/assets/images/succsess.svg')}}" alt="">
                        <h1>Thank You!</h1>
                        @if($type=="Booking")
                            <p>You have booked a booking successfully </p>
                            <h3 class="cupon-pop">Your booking Id: <span>{{$booking_id}}</span></h3>
                            <br>
                            <a href="{{route('customer.Booking')}}" class="lawwa-btn" role="button">Continue</a>
                        @elseif($type=="Membership")
                            <p>You have successfully purchased membership</p>
                            <h3 class="cupon-pop">Membership Id: <span>{{$membership_id}}</span></h3>
                            <br>
                            <a href="{{route('customer.membership.index')}}" class="lawwa-btn" role="button">Continue </a>
                        @elseif($type=="Course")
                            <p>You have successfully buy course</p>
                            <h3 class="cupon-pop">Course Id: <span>{{$course_id}}</span></h3>
                            <br>
                            <a href="{{route('customer.orders')}}" class="lawwa-btn" role="button">Continue </a>
                        @elseif($type=="Certificate")
                            <p>You have successfully apply for Certificate</p>
                            <h3 class="cupon-pop">Certificate Id: <span>{{$certificate_id}}</span></h3>
                            <br>
                            <a href="{{route('customer.orders')}}" class="lawwa-btn" role="button">Continue </a>
                        @else
                            <p>You have placed order successfully will deliver soon</p>
                            <h3 class="cupon-pop">Your Order Id: <span>{{$order_id}}</span></h3>
                            <br>
                            <a href="{{route('customer.orders')}}" class="lawwa-btn" role="button">Continue</a>  
                        @endif   
   			        </div>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
    $(document).ready(function(){
        $("#ignismyModal").modal('show');
    });
</script>
</body>
</html> 