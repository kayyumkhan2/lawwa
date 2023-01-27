<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Models\Feedback;

class FeedbackController extends Controller {
    function __construct() {
        $this->middleware('permission:Feedbacks-list', ['only' => ['index']]);
        $this->middleware('permission:Feedbacks-show', ['only' => ['show']]);
    }
    public function index()
    {
        $Feedbacks = Feedback::all()->sortByDesc("id");
        return view('admin::feedback.index')->with('Feedbacks', $Feedbacks);
    }

    public function show($id)
    {
        $Feedback = Feedback::findorfail($id);
        return view('admin::feedback.show',compact('Feedback'));
    }
  
    public function destroy($id)
    {
        $query = Feedback::find($id);
        $query->delete();
        toastr()->success('Product Status changed Successfully!');
        return redirect()->route('querymanagements.index')->with('success','Page deleted successfully');
    }
}