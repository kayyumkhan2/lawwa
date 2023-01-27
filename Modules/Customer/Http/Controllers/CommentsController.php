<?php
namespace Modules\Customer\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\{TicketComment,Ticket,User};
use App\Http\Requests;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
	/**
	 * Persist comment and mail user
	 * @param  Request  $request
	 * @param  AppMailer $mailer
	 * @return Response
	 */
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
        
        return redirect()->back()->with("status", "Your comment has be submitted.");
    }
    public function GetComments()
    {
        $ticket=Ticket::where('ticket_id',"H1BWCUWWB1")->first();
        $charts="";
        foreach($ticket->comments as $comment){
                if($comment->user_id!=auth()->user()->id){
               $charts.= '<div class="answer left">
                   <div class="avatar">
                      <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User name">
                      <div class="status offline"></div>
                   </div>
                   <div class="name"> '.$comment->user->full_name.'</div>
                   <div class="text">
                      '.$comment->comment.'
                   </div>
                    <div class="time">'. $comment->created_at->diffForHumans().'
                   </div>
                </div>
                @else
                <div class="answer right">
                   <div class="avatar">
                      <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="User name">
                      <div class="status offline"></div>
                   </div>
                   <div class="name"> '.$comment->user->full_name.'</div>
                   <div class="text">
                      '.$comment->comment.'
                   </div>
                    <div class="time">'. $comment->created_at->diffForHumans().'
                   </div>
                </div>';
            }
         echo   json_encode($charts);
        }
    }
}
