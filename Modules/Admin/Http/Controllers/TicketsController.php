<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\{Ticket,User,TicketCategory};
use App\Http\Requests;
use App\Mailers\AppMailer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    function __construct() {
        $this->middleware('permission:Tickets-list|Tickets-create|Tickets-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:Tickets-list', ['only' => ['index']]);
        $this->middleware('permission:Tickets-show', ['only' => ['show']]);
        $this->middleware('permission:Tickets-close',['only' => ['close']]);
    }
    public function index() 
    {
    	// $tickets = Ticket::get();
        $categories = TicketCategory::all();
        $tickets = Ticket::orderBy('id', 'DESC')->get();
        $pagename="Tickets";    
        return view('admin::tickets.index', compact('tickets', 'categories','pagename'));
    }

    public function create()
    {
    	$categories = TicketCategory::all();

        return view('beautician::tickets.create', compact('categories'));
    }

    public function store(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
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
            'message'   => $request->input('message'),
            'status'    => "Open",
        ]);
        $ticket->save();
        $mailer->sendTicketInformation(Auth::user(), $ticket);
        alert()->Success('Success', "A ticket with ID: #$ticket->ticket_id has been opened.")->autoclose(4000);
        return redirect()->back();
    }

    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $comments = $ticket->comments;
        $category  = $ticket->category;
        $pagename ="Ticket info"; 
        return view('admin::tickets.show', compact('ticket', 'category', 'comments','pagename'));
    }

    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = 'Closed';
        $ticket->save();
        if(!$ticket->user==""){
            $ticketOwner = $ticket->user;
            $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
        }
        alert()->Success('Success', "A ticket with ID: #$ticket_id has been closed.")->autoclose(4000);
        return redirect()->back();
    }
}
