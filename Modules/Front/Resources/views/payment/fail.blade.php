<!DOCTYPE html>
<html>
<head>
<head>
<title>
  @if($type=="Booking") Booking failed @else Order failed @endif 
</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style type="text/css">
/*--thank you pop starts here--*/
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
  color: #D83968;
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
	color:#222;
	display:inline-block;
	text-align:center;
	padding:10px 20px;
	border:2px dashed #222;
	clear:both;
	font-weight:normal;
}
.thank-you-pop h3.cupon-pop span{
	color:#03A9F4;
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
  color: #fff;
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
  width: 780px;
  margin: 70px auto;
}

/*--thank you pop ends here--*/
/* Responsive Start */
@media screen and (max-width:1199px) {}
@media screen and (max-width:767px) {}
@media screen and (max-width:991px) { }

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
  							<img src="{{ asset('front/assets/images/close-back.svg')}}" alt="">
                @if($type=="Booking")
  							 <h1>Sorry!</h1>
  							 <p>Something went wrong please go back and try again </p>
                 <a href="javascript:history.go(-4)" class="lawwa-btn" role="button">Back</a>
                @else
                 <h1>Sorry!</h1>
                 <p>Something went wrong please go back and try again </p>
                 <a href="javascript:history.go(-4)" class="lawwa-btn"  role="button">Back</a>
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
        $('#ignismyModal').modal({backdrop: 'static', keyboard: false})  
    });
</script>
</body>
</html> 