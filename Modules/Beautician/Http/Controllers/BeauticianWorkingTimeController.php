<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\BeauticianWorkingTime;
use Illuminate\Http\Request;
use Auth;

class BeauticianWorkingTimeController extends Controller
{
  
     public function __construct() {
        // Business Owner auth

        // Validation error messages
        $this->messages = [
            'day.is_day_of_week' => 'The :attribute field must be a valid day (e.g. Monday, Tuesday).',
            'start_time.date_format' => 'The :attribute field must be in the correct 24-hour time format.',
            'end_time.date_format' => 'The :attribute field must be in the correct 24-hour time format.',
            'start_time.before' => 'The :attribute must be before the end time.',
            'end_time.after' => 'The :attribute must be after the start time.'
        ];

        // Validation rules
        $this->rules = [
            'day' => 'required|unique:business_times,day|is_day_of_week',
            'start_time' => 'required|date_format:H:i|before:end_time',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];

        // Attributes replace the field name with a more readable name
        $this->attributes = [
            'start_time' => 'start time',
            'end_time' => 'end time',
        ];
    }

    public function index(){
        $BeauticianWorkingTime= BeauticianWorkingTime::where('user_id',Auth::id())->get();
        return view('beautician::workingtime.index', ['bTimes' =>$BeauticianWorkingTime]);
    }

    public function create(){
        
    }

   
    public function store(Request $request){
        $request->validate([
            'day' => 'required',
            'start_time' => 'required|date_format:H:i|before:end_time',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $request->validate([$this->rules, $this->messages, $this->attributes]);
        $request->merge([
            'start_time' => toTime($request->start_time),
            'end_time' => toTime($request->end_time)
        ]);
        $bTime = BeauticianWorkingTime::firstOrCreate(['user_id' => Auth::id(),'day'=>$request->day],
            [
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'day' => $request->day,
                'user_id' => Auth::id(),
            ]);
        alert()->Success('Success', 'Add successfully')->autoclose(4000);
        return redirect()->route('beautician.workingtime.index');
    }

   
    public function show(BeauticianWorkingTime $beauticianWorkingTime){
        
    }

   
    public function edit($time){ 
        $bTime = BeauticianWorkingTime::find($time);
        $business = BeauticianWorkingTime::first();
        return view('beautician::workingtime.edit',compact('bTime', 'business'));

      
    }

  
    
    public function update(Request $request, $time)
    {
        //return $time;
        // Remove day rules
        unset($this->rules['day']);
        $request->validate([$this->rules, $this->messages, $this->attributes]);
        $bTime = BeauticianWorkingTime::find($time);
        // Set variables once validated
        $bTime->start_time = $request->start_time;
        $bTime->end_time = $request->end_time;

        // Save activity
        $bTime->save();


        // Delete future working times and bookings
       // $time->deleteAllFutureWorkingTimes();
       // $time->deleteAllFutureBookings();

        
        return redirect()->route('beautician.workingtime.index');
    }

    
    public function destroy($beauticianWorkingTime)
    {
        $bTime = BeauticianWorkingTime::find($beauticianWorkingTime);
        $bTime->delete();
        return redirect()->route('beautician.workingtime.index');

    }
}
