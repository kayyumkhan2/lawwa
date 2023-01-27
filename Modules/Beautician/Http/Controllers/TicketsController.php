<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;

use App\Models\{Ticket,User,TicketCategory};
use App\Http\Requests;
use App\Mailers\AppMailer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(7);
        $categories = TicketCategory::all();
        $pagename="Tickets";
        return view('beautician::tickets.index', compact('tickets', 'categories','pagename'));
    }

    public function create()
    {
    	$categories = TicketCategory::all();

        return view('beautician::tickets.create', compact('categories'));
    }

    public function store(Request $request, AppMailer $mailer)
    {
        $validator = $request->validate([
            'title'     => 'required',
            'category'  => 'required',
            'priority'  => 'required',
            'message'   => 'required'
        ]);

        $ticket = new Ticket([
            'title'     => $request->input('title'),
            'user_id'   => Auth::user()->id,
            'ticket_id' => strtoupper(Str::random(10)),
            'category_id'  => $request->input('category'),
            'priority'  => $request->input('priority'),
            'user_name'   => Auth::user()->full_name,
            'user_info' => json_encode(Auth::user()),
            'message'   => $request->input('message'),
            'status'    => "Open",
        ]);
        $ticket->save();
        $mailer->sendTicketInformation(Auth::user(), $ticket);
        return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
    }

    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $comments = $ticket->comments;
        $category  = $ticket->category;
        return view('beautician::tickets.show', compact('ticket', 'category', 'comments'));
    }

    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = 'Closed';
        $ticket->save();
        $ticketOwner = $ticket->user;
        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}
