<h2>Hello</h2> <br><br>

We have closed Your Query : {{ $name }} <br><br>

Your details: <br><br>

Name: {{ $name }} <br>
@if(isset($company))
	company: {{ $company }} <br> 
@endif
Email: {{ $email }} <br>
Phone: {{ $phone }} <br>
Subject: {{ $subject }} <br>
Message: {{ $user_query }} <br><br>

Thanks