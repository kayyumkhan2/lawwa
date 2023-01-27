<?php

namespace App\Http\Controllers;

use App\FaqQuestion;
use App\FaqCategory;
use App\FaqCategoryQuestion;
use Illuminate\Http\Request;

class FaqQuestionController extends Controller
{
    
    public function index()
{
$FaqQuestions = FaqQuestion::all();
return view('admin.faqquestion.index')->with('FaqQuestions',$FaqQuestions);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
	
	$FaqQuestions = FaqCategory::all();

return view('admin.faqquestion.create',compact('FaqQuestions'));
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
 $FaqQuestion = new FaqQuestion;           
 $validatedData = $request->validate([
'question' =>'required|unique:faq_questions|max:555',
'answer' => 'required',
]);

$faq_question_id= FaqQuestion::create([
            'question' => $request->input('question'),
			'answer' => $request->input('answer')
			])->id;   
			
    $faq_category_id=$request->input('categoryname');
                FaqCategoryQuestion::create(['faq_category_id' =>$faq_category_id,'faq_question_id' => $faq_question_id]);

    toastr()->success('Faq Question Created successfully!');
    return redirect()->route('faqquestion.index');
}
/**
* Display the specified resource.
*
* @param  \App\Page  $page
* @return \Illuminate\Http\Response
*/
public function show($page)
{
$faqquestion = FaqQuestion::find($page);
return view('admin.faqquestion.show',compact('faqquestion'));
}


public function pageshow($slug)
{
$page = FaqQuestion::where('slug', "$slug")->first(); 
return view('faqquestion', compact('page'));
}
/**
* Show the form for editing the specified resource.
*
* @param  \App\Page  $page
* @return \Illuminate\Http\Response
*/
public function edit($page)
{
$faqquestion = FaqQuestion::find($page);
return view('admin.faqquestion.edit',compact('faqquestion'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\Page  $page
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$request->validate([
'question' => 'required|max:225',
'answer' => 'required',


]);
$FaqQuestion = FaqQuestion::find($id);
$FaqQuestion->question = $request->input('question');
$FaqQuestion->answer = $request->input('answer');



$FaqQuestion->save();
toastr()->success('Faq Question updated successfully!');

return redirect()->route('faqquestion.index');

}/**
* Remove the specified resource from storage.
*
* @param  \App\Page  $page
* @return \Illuminate\Http\Response
*/

   public function update_status(Request $request)
            {
             $id=$request->input('product_id');

              $Product = Page::find($id);

            if($request->input('status')==0)
            {
               $status =1;

            }
            else
            {
              $status =0;

            }
              $Product->status = $status ;
              $Product->save();
                          toastr()->success('Page Status changed Successfully!');
            return redirect()->route('faqquestion.index');

                }

            public function destroy($FaqQuestion)
            {
            $FaqQuestion = FaqQuestion::find($FaqQuestion);
            $FaqQuestion->delete();
            toastr()->success('FaqQuestion deleted successfully!');
            return redirect()->route('faqquestion.index');
            }
}
