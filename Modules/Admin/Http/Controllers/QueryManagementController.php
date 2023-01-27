<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Models\QueryManagement;
use Mail;
class QueryManagementController extends Controller {
    function __construct() {
        $this->middleware('permission:queries-list|queries-create|queries-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:queries-status-change', ['only' => ['changeStatus']]);
        $this->middleware('permission:queries-list', ['only' => ['index']]);
        $this->middleware('permission:queries-show', ['only' => ['show']]);
    } 
    public function index()
    {
        $queries = QueryManagement::all()->sortByDesc("id");
        return view('admin::queriesmanagement.index')->with('queries', $queries);
    }
    public function show($id)
    {
       $query = QueryManagement::find($id);
       return view('admin::queriesmanagement.show',compact('query'));
    }


    public function changeStatus(Request $request)
    {
        $data = QueryManagement::find($request->input('id'));
        if($data->status=='0')
        {
            $status ='1';
        }
        else
        {
            $status ='0';
        }
        $data->status = $status ;
        $data->save();
        if($data)
        {

            Mail::send('mailtemplate.queryclosemail', array(
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
                'subject' => $data->subject,
                'user_query' => $data->message,
                ), function($message) use ($data){
                $message->from('lawwaaisa@gmail.com');
                $message->to([$data->email,'lawwaaisa@gmail.com'], 'Admin')
                ->subject($data->subject);
            });
            return response()->json(['message' => 'Status update Successfully','status' => 'ok','currentstatus'=>$status]);
        } 
        else
        {
            return response()->json(['message' => 'Something is wrong','status' => 'error']);
        }
    }
}