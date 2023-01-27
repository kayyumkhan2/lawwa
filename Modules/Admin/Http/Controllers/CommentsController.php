<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\{TicketComment,Ticket,User};
use App\Http\Requests;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    function __construct() {
        $this->middleware('permission:Tickets-comments',['only' => ['postComment']]);
    }
    public function postComment(Request $request, AppMailer $mailer)
    {
        $validator = $request->validate([
            'comment'   => 'required'
        ]);

        $comment = TicketComment::create([
        	'ticket_id' => $request->input('ticket_id'),
        	'user_id'	=> Auth::user()->id,
            'user_name'   => Auth::user()->full_name,
        	'comment'	=> $request->input('comment'),
        ]);
        // send mail if the user commenting is not the ticket owner
        if ($comment->ticket->user->id !== Auth::user()->id) {
        	$mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }
        alert()->Success('Success', 'Your comment has be submitted.')->autoclose(2000);
        return redirect()->back()->with("status", "Your comment has be submitted.");
    }
}
