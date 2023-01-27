<section class="email-template">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
        
				<div class="email-info">
          <div class="img-block">
          <img src="{{asset('images/final-logo.png')}}" alt="Lawwa">
          </div>
					<h2>Hello</h2> <br><br>

					<h3>We have got your email : {{ $name }} </h3>

					<h3>Your details: </h3>

          <ul>
            <li>Name: <span>{{ $name }}</span></li>
              @if(isset($company))
            <li>company: <span>{{ $company }}</span></li>
            @endif
            <li>Email: <span>{{ $email }}</span></li>
            <li>Phone: <span>{{ $phone }}</span></li>
            <li>Subject: <span>{{ $subject }}</span></li>
            <li>Message: <span>{{ $user_query }}</span></li>
          </ul>

					<h3>Thanks</h3>
        </div>
    </div>
    </div>
  </div>
</section>

<style>

.email-info .img-block {
  text-align: center;
  margin: 0 auto;
}
.email-info .img-block img {
  width: 180px;
}
  .email-info {
  box-shadow: 0px 0px 10px #ddd;
  background-color: #fff;
  padding: 50px;
  text-align: center;
  margin: 50px auto 0;
  max-width: 750px;
}

.email-info h2 {
  color: #000;
  font-size: 18px;
}
.email-info h3 {
  color: #000;
  font-size: 14px;
}
.email-info ul {
  padding: 0;
  margin: 0;
}
.email-info ul li {
  padding: 0;
  margin: 0;
  color: #000;
  font-size: 14px;
  list-style: none;
}


</style>