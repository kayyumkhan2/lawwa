<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppor Ticket Information</title>
</head>
<body>
    <p>
        Thank you {{ ucfirst($user->name) }} for contacting our support team. A support ticket has been opened for you. You will be notified when a response is made by email. The details of your ticket are shown below:
    </p>

    <p>Title: {{ $ticket->title }}</p>
    <p>Priority: {{ $ticket->priority }}</p>
    <p>Status: {{ $ticket->status }}</p>
    @php
      $role = Auth::user()->roles->first()->name;
    @endphp
    @if($role=="Customer")
      <p>
        You can view the ticket at any time at {{ url('myaccount/tickets/'. $ticket->ticket_id) }}
      </p>
    @else
      <p>
        You can view the ticket at any time at {{ url('beautician/tickets/'. $ticket->ticket_id) }}
      </p>  
    @endif
    
</body>
</html>