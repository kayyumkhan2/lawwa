@extends('emails.layout')
@section('content')
<style type="text/css">
	@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);

body {padding-top:50px;}

.box {
    border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.01), 0 2px 10px 0 rgba(0, 0, 0, 0.09);
    padding: 10px 25px;
    text-align: right;
    display: block;
    margin-top: 60px;
}
.box-icon {
    background-color: #57a544;
    border-radius: 50%;
    display: table;
    height: 100px;
    margin: 0 auto;
    width: 100px;
    margin-top: -61px;
}
.box-icon span {
    color: #fff;
    display: table-cell;
    text-align: center;
    vertical-align: middle;
}
.info h4 {
    font-size: 26px;
    letter-spacing: 2px;
    text-transform: uppercase;
}
.info > p {
    color: #717171;
    font-size: 16px;
    padding-top: 10px;
    text-align: justify;
}
.info > a {
    background-color: #03a9f4;
    border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    color: #fff;
    transition: all 0.5s ease 0s;
}
.info > a:hover {
    background-color: #0288d1;
    box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.12);
    color: #fff;
    transition: all 0.5s ease 0s;
}
</style>
<div style="padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
   <div style="margin-right: -15px; margin-left: -15px;">
      <div style="width: 780px; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;box-sizing: border-box; margin: 20px auto 0; text-align: center;">
         <div style="border-radius: 3px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
            padding: 15px 25px; text-align: center; display: block; margin-top: 15px;margin-bottom: 10px;box-sizing: border-box;">
            <div style=" text-align: center; margin: 20px auto 0 20px;">
                <a href="{{config('app.url')}}" style="width: 250px;margin: 0;padding: 0; color: #428bca;
                   text-decoration: none; background-color: transparent;">
                <img src="{{ asset('images/final-logo.png')}}"
                   style="height: 55px;margin-top: 5px;margin:0;padding:0;" alt="logo"/>
                </a>
             </div>
            <br />
            <p style="text-align:center;font-style:normal;
               font-size: 14px;">Hi <b>{{$Feedback->name }}</b>,</p>
            <br/>
            <p style="text-align:center;
				font-size: 14px;">
				Thanks for your feedback  : {{ $Feedback->name }} <br>
				<h4 style="font-size: 14px;">Your feedback details:</h4> <br>
				Email: {{ $Feedback->email }} <br>
				Phone: {{ $Feedback->phone }} <br>
				Message: {{ $Feedback->message }} <br><br>

				Thanks</p>
               <p style="text-align:center;font-style:italic;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
				font-size: 14px;">
                  This is a notification-only email address. Please do not reply to this message.
               </p>
         </div>
      </div>
   </div>
</div>
@endsection
