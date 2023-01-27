@extends('emails.layout')
@section('content')
<!-- Style CSS -->

<!-- modal -->
<section class="table-popup">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="laawa-popup">
          <div class="logo">
            <img src="{{ asset('images/final-logo.png')}}" alt="Lawwa" width="200">
          </div>
          <h4>{{$Notification->title}}!</h4>
          <h5>Hi! {{ucfirst($Notification->UserInfo->full_name)}}</h5>
          <p>{!!$Notification->description !!}</p>
          <!-- <h5>Sincerely</h5> --> 
          <h5>Lawwa.Aisa</h5>
          <div class="footer">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('css')
  <style type="text/css">
      body {
        color: #3C424F;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        line-height: 1.42857143;
        text-rendering: auto;
        overflow-x: hidden;
      }
      .logo {
        background-color: #f2f2f2;
        padding: 15px 30px;
        box-shadow: 0px 0px 10px #ddd;
      }

      .laawa-popup {
        background-color: #fff;
        text-align: left;
        padding: 0px;
        margin: 100px auto 50px;
        box-shadow: 0px 0px 50px #ddd;
        max-width: 600px;
      }
      .laawa-popup h4 {
        text-align: left !important;
        margin: 30px 30px 0px !important;
        color: #686B77;
        font-size: 20px;
        font-weight: 600;
        margin: 0;
      }
      .laawa-popup h5 {
        padding: 10px 30px 5px;
        font-size: 16px;
        color: #686B77;
        margin: 0;
      }
      .laawa-popup p {
        font-size: 14px;
        color: #3C424F;
        line-height: 26px;
        padding: 0px 30px;
        margin: 0;
        text-align: left !important;
      }
      .laawa-popup p:first-child {
        display: none !important;
      }
    
      .footer {
        background-color: #2B3990;
        padding: 3px;
        margin-top: 100px;
      }


      .container {
        max-width: 1140px;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
      }
      .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
      }
     
      .col-md-7 {
        -ms-flex: 0 0 58.333333%;
        flex: 0 0 58.333333%;
        max-width: 58.333333%;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
      }
      .col-sm-6 {
        display: inline-block;
        width: 45%;
        padding: 15px;
      }
      .col-md-12 {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
      }
        /* Booking */
      .table-popup {
        text-align: center;
      }
      .modal-info {
        background-color: #fff;
        text-align: center;
        padding: 80px 50px;
        margin: 100px auto;
        box-shadow: 0px 0px 50px #ddd;
        max-width: 720px;
      }
      .modal-info .success-icon {
        background-color: #2b3990;
        border-radius: 100%;
        height: 150px;
        width: 150px;
        text-align: center;
        line-height: 144px;
        margin: 0 auto;
      }
      .modal-info .success-icon img {
        width: 90px;
      }
      .modal-info h4 {
        text-align: center;
        margin: 50px;
        color: #686B77;
        font-size: 26px;
        font-weight: 600;
      }
      .btn-block .lawwa-btn.larg-btn {
        display: inline-block;
        min-width: 300px;
        padding: 11px 15px 14px;
        background: #2B3990;
        border: 1px solid #2B3990;
        color: #ffffff;
        font-size: 22px;
        text-align: center;
        position: relative;
        outline: none;
        cursor: pointer;
        transition: all ease .4s;
        border-radius: 3px;
        text-decoration: none;
      }
      .btn-block .lawwa-btn.larg-btn:hover {
        background: #D83968;
      }
      .laawa-footer {
        padding: 23px 0;
        margin-top: 40px;
        background-color: #EFEFEF; 
      }
      .lawwa-copyright p {
        padding-bottom: 0;
        font-size: 14px;
        color: #686B77;
         margin: 0;
        padding-top: 2px;
      }
      .lawwa-copyright .text-md-right {
        text-align: right !important;
      }
      .lawwa-copyright p a {
        text-decoration: none;
        color: #686B77;
      }
      .lawwa-copyright p a:hover {
        color: #D83968;
      }
      .lawwa-copyright ul {
        padding: 0;
        margin: 0;
        color: #818181;
        list-style: none;
      }
      .lawwa-copyright ul li {
        display: inline-block;
        margin-left: 15px;
      }
      .lawwa-copyright ul li a {
        display: inline-block;
        color: inherit;
        text-decoration: none;
      }
      .lawwa-copyright ul li a:hover {
        color: #D83968;
      }
  </style>
@endsection

