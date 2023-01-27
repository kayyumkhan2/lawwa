<?php 
namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\{Booking,BusinessTime};
use Carbon\Carbon as Time;

class BusinessTimeController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin::businesstimes.index', [
            'bTimes' => BusinessTime::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info("An attempt to create a business time from the Business Owner Dashboard", $request->all());
        Log::debug("Validating Business Owner input");

        // Validate form
        $this->validate($request, $this->rules, $this->messages, $this->attributes);

        // Convert start time to proper time format
        $request->merge([
            'start_time' => toTime($request->start_time),
            'end_time' => toTime($request->end_time)
        ]);

        // Create business time
        $bTime = BusinessTime::create([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'day' => $request->day,
        ]);

        Log::notice("Business time was created by Business Owner ID " . Auth::id(), $bTime->toArray());

        // Session flash
        session()->flash('message', 'Business time has successfully been created.');
        return redirect()->route('businesstimes.index')->with('success','Business time has successfully been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessTime  $time
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessTime $time)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessTime  $time
     * @return \Illuminate\Http\Response
     */
    public function edit( $time)
    {
        $bTime= BusinessTime::find($time);
        return view('admin::businesstimes.edit', compact(['bTime']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessTime  $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $time)
    {
        // Remove day rules
            $time= BusinessTime::find($time);
        unset($this->rules['day']);

        Log::debug("Validating Activity input");

        // Validate form
        $this->validate($request, $this->rules, $this->messages, $this->attributes);

        $bTime = BusinessTime::find($time->id);

        // Set variables once validated
        $bTime->start_time = $request->start_time;
        $bTime->end_time = $request->end_time;

        // Save activity
        $bTime->save();

        Log::notice("Business time ID " . $bTime->id . " was updated", $bTime->toArray());

        // Delete future working times and bookings
     //   $time->deleteAllFutureWorkingTimes();
       // $time->deleteAllFutureBookings();

        // Session flash
        session()->flash('message', 'Business time successfully edited.');

        session()->flash('message', 'Business time has successfully been created.');
        return redirect()->route('businesstimes.index')->with('success','Business time has successfully been created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessTime  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessTime $time)
    {
        // Remove selected business time
        $time->delete();

        // Delete future working times and bookings
        $time->deleteAllFutureWorkingTimes();
        $time->deleteAllFutureBookings();

        // Session flash
        session()->flash('message', 'Business time successfully removed.');

        // Redirect to activity page
        return redirect('/admin/times');
    }
}
