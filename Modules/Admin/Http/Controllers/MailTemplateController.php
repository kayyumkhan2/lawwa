<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MailTemplate;


class MailTemplateController extends Controller
{
    function __construct() {
        $this->middleware('permission:Mail-Templates-list|Mail-Templates-create|Mail-Templates-edit|Mail-Templates-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:Mail-Templates-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Mail-Templates-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Mail-Templates-delete', ['only' => ['destroy']]);
        $this->middleware('permission:Mail-Templates-list', ['only' => ['index']]);
        $this->middleware('permission:Mail-Templates-show', ['only' => ['show']]);
    }
    public function index()
    {
      $datas = MailTemplate::orderBy('id','DESC')->get();
      return view('admin::mailtemplates.index',compact('datas'));
    }

    public function create()
    {
        return view('admin::mailtemplates.create');

    }
    public function store(Request $request)
    {
       $this->validate($request,
         [
            
            'title' =>'required|unique:mail_templates|max:100',
            'subject' => 'required',
            'html_template' =>'required',
            'template_for' =>'required',
            
        ]);
        $input = $request->all();
        $MailTemplate = MailTemplate::create($input);
        if( $request->has('default_status'))
        {
            MailTemplate::where('default_status','1')->update(['default_status' =>'0']);
            MailTemplate::where('id', $MailTemplate->id)->update(['default_status' =>'1']);
        }
                    
        alert()->Success('Success', 'Mail Templates Add Successfully')->autoclose(2000);
        return redirect()->route('mailtemplates.index');
    }

    public function show($id)
    {
      $data = MailTemplate::find($id);
      return view('admin::mailtemplates.show',compact('data'));

      
    }

    public function edit($id)
    {
            $data = MailTemplate::find($id);
            return view('admin::mailtemplates.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
         [
            'title'  =>  'required|max:222', 
            'subject' => 'required',
            'html_template' =>'required',
            'template_for' =>'required',
            'for' =>'required',
        ]);
        $input = $request->all();
        $MailTemplate = MailTemplate::find($id);
        $MailTemplate->update($input);
        if( $request->has('default_status'))
        {
            MailTemplate::where('default_status','1')->update(['default_status' =>'0']);
            MailTemplate::where('id', $MailTemplate->id)->update(['default_status' =>'1']);
        }
        alert()->Success('Success', 'Mail Templates Update Successfully')->autoclose(3000);
        return redirect()->route('mailtemplates.index');

    }
    public function destroy($id)
    {
        toastr()->success('User deleted Successfully!');
        User::find($id)->delete();return redirect()->route('users.index');
    }
}
