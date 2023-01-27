<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BeauticianWorkingTime;
use Carbon\Carbon as Time;

class BusinessTime extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function deleteAllFutureWorkingTimes()
    {
        // Count the amount of working times removed
        $wTimeCount = 0;
        // Delete remaining working times after today on a day of week
        foreach(BeauticianWorkingTime::where('date', '>=', getDateNow())->get() as $wTime) {
            if(strtoupper(Time::parse($wTime->date)->format('l')) == $this->day) {
                $wTime->delete();
                $wTimeCount++;
            }
        }
    }
    public function deleteAllFutureBookings()
    {
        // Count the amount of bookings removed
        $bookingCount = 0;
        // Delete remaining booking after today on a day of week
        foreach (Booking::where('date', '>=', getDateNow())->get() as $booking) {
            if (strtoupper(Time::parse($booking->date)->format('l')) == $this->day) {
                $booking->delete();
                $bookingCount++;
            }
        }
    }
}
