<?php 
namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\{Booking,BusinessTime,BeauticianWorkingTime,User,WorkingTime};


use Carbon\Carbon as Time;

class WorkingTimeController extends Controller
{
        
        public function __construct() {
        
        // Custom error messages
        $this->messages = [
            'employee_id.exists' => 'The :attribute does not exist.',
            'start_time.date_format' => 'The :attribute field must be in the correct time format.',
            'end_time.date_format' => 'The :attribute field must be in the correct time format.',
            'date.unique' => 'The employee can only have one working time per day.',
            'date.after' => 'The :attribute must be before today ' . toDate(getNow(), true) . '.',
            'date.is_business_open' => 'The :attribute field be within open business times.',
        ];

        // Validation rules
        $this->rules = [
            // Employee ID is required and must exist in employees table
            'employee_id' => 'required|exists:users,id',

            // Start time is required
            'start_time' => 'required|before:end_time|date_format:H:i',

            // End time is required and must be AFTER the start time (they can't be the same either)
            'end_time' => 'required|after:start_time|date_format:H:i',

            // Date must be unique where employee ID is unique
            'date' => 'required|date|after:' . getDateNow() . '|is_business_open',
        ];

        // Attributes replace the field name with a more readable name
        $this->attributes = [
            'employee_id' => 'employee',
        ];
    }


    /**
     * Roster index
     *
     * @param  String $monthYear    month year string from URL (mm-yyyy)
     * @param  String $employeeID   employee ID
     * @return view
     */
    public function show($monthYear, $employeeID)
    {
        return "sdf";
        // Current time
        $date = monthYearToDate($monthYear);

        // Find employee
        $employee = Employee::find($employeeID);

        // Find working time by employee ID
        $workingTimes = WorkingTime::where('employee_id', $employeeID)->get();

        return view('admin::admin.roster', [
            'business'      => User::first(),
            'employeeID'    => $employeeID,
            'employee'      => $employee,
            'roster'        => $workingTimes,
            'date'          => $date,
            'dateString'    => $date->format('m-Y'),
            'months'        => getMonthList($monthYear)
        ]);
    }

    /**
     * Roster index
     *
     * @param  String $monthYear    month year string from URL (mm-yyyy)
     * @return view
     */
    public function index($monthYear)
    {
       
        // Current time
        $date = monthYearToDate($monthYear);

        return view('admin::workingtime.roster', [
            'business'      => User::first(),
            'roster'        => WorkingTime::all(),
            'employeeID'    => null,
            'employee'      => null,
            'date'          => $date,
            'dateString'    => $date->format('m-Y'),
            'months'        => getMonthList($monthYear)
        ]);
    }

    public function roster()
    {return "sd";
        return view('admin::admin.workingtime.roster', [
            'business' => User::first(),
            'roster' => WorkingTime::getRoster()
        ]);
    }

    // Create a new working time
	public function store(Request $request, $monthYear = null)
	{
        Log::info("An attempt was made to create a new working time", $request->all());

        if ($request->month_year) {
            $temp = explode('-', $request->month_year);
            $date = Time::createFromDate($temp[1], $temp[0], $request->day)->toDateString();
            $request->merge(['date' => $date]);
        }
        else {
            $date = toDate($request->date);
        }

        // Add date rule here since it depends on request
        $this->rules['date'] .= '|unique:working_times,date,NULL,id,employee_id,' . $request->employee_id;

		// Validate form
        
        $this->validate($request, $this->rules, $this->messages, $this->attributes);

        // Convert start time to proper time format
        $request->merge([
            'start_time' => toTime($request->start_time),
            'end_time' => toTime($request->end_time)
        ]);

        // Create a working time
        $workingTime = WorkingTime::create([
            'employee_id' => $request->employee_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'date' => $date,
        ]);

        Log::notice("A new working time was created for employee with id " . $workingTime->employee_id . " for times: " .
            $workingTime->date . " => " . $workingTime->start_time . " - " . $workingTime->end_time, $workingTime->toArray());

        // Session flash
        session()->flash('message', 'New working time has been added.');
  // Redirect to the business owner employee page
        return redirect('admin/roster/' . $monthYear);
	}

    /**
     * View edit booking page
     */
    public function edit($monthYear, $employeeID, $workingTimeID)
    {
        // Find working time by ID
        $workingTime = WorkingTime::find($workingTimeID);

        $business = User::first();

        return view('admin.edit.working_time', compact(['workingTime', 'business']));
    }

    /**
     * Update a working time by ID
     * Sent by PUT/PATCH request
     */
    public function update(Request $request, WorkingTime $wTime)
    {
        // Overwrite rules from default
        unset($this->rules['date']);

        // Validate form
        $this->validate($request, $this->rules, $this->messages, $this->attributes);

        // Unassign employee that was previously working on a booking
        Booking::where('start_time', '>=', $wTime->start_time)
            ->where('end_time', '<=', $wTime->end_time)
            ->delete();

        // Save data
        $wTime->employee_id = $request->employee_id;
        $wTime->start_time = toTime($request->start_time);
        $wTime->end_time = toTime($request->end_time);
        $wTime->updated_at = getDateTimeNow();
        $wTime->save();

        // Session flash
        session()->flash('message', 'Working time successfully edited.');

        // Redirect to the business owner employee page
        return redirect('/admin/roster/' . getMonthYearNow());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkingTime  $wTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingTime $wTime)
    {
        // Remove selected working time
        $wTime->delete();

        // Delete future bookings
        $wTime->deleteBookings();

        // Session flash
        session()->flash('message', 'Working time successfully removed.');

        // Redirect to activity page
        return redirect('/admin/roster/' . getMonthYearNow());
    }
}
