<style type="text/css">
    .calendar {
  border: 1px solid #d3e0e9;
}

.calendar tbody > tr > td {
  padding: 8px 8px 0 8px;
}
.calendar__week {
  border-right: 1px solid #777777;
  min-width: 60px;
}
.calendar__week--label {
  padding-top: 60px !important;
  font-family: "Open Sans", sans-serif;
  font-weight: bold;
}
.calendar__day {
  color: #555555;
}

.calendar__day--block {
  background: white;
  position: relative;
  height: 150px;
  min-width: 110px;
  border: 1px solid #d3e0e9;
}
.calendar__day--now {
  background-color: #dde8fd !important;
}
.calendar__day--disabled {
  background-color: #eeeeee !important;
}

.calendar__day-label {
  position: absolute;
  top: 6px;
  right: 10px;
  color: #b3b2b2;
}
.table .item__block--calendar {
  margin-right: 25px;
}
.glyphicon-calendar:before {
  content: "\e109";
}


</style>
<table class="table no-margin calendar">
    <tr>
        <th class="calendar__day">Monday</th>
        <th class="calendar__day">Tuesday</th>
        <th class="calendar__day">Wednesday</th>
        <th class="calendar__day">Thursday</th>
        <th class="calendar__day">Friday</th>
        <th class="calendar__day">Saturday</th>
        <th class="calendar__day">Sunday</th>
    </tr>
    @for ($weeks = 0; $weeks < 5; $weeks++)
        <tr>
            @for ($days = 0; $days < 7; $days++)
                @php
                    $cDate = \Carbon\Carbon::parse($pDate->toDateString())->startOfMonth()->startOfWeek()->addDays($days)->addWeeks($weeks);
                @endphp
                <td class="calendar__day calendar__day--block {{ $cDate->month != $pDate->month ? 'calendar__day--disabled' : null }} {{ $cDate->toDateString() == getDateNow() ? 'calendar__day--now' : null }}">
                    @if ($cDate->month == $pDate->month)
                        <div class="calendar__day-label">{{ $cDate->format('d') }}</div>
                        @if ($type == 'customer')
                            <div class="item">
                                @if ($employeeID)
                                    @if ($items = $employee->availableTimes($cDate->toDateString()))
                                        @foreach ($items as $item)
                                            <section class="item__block item__block--calendar">
                                                <div class="item__name">{{ firstChar($employee->firstname, true) }} {{ $employee->lastname }}</div>
                                                <div class="item__time">{{ toTime($item['start_time'], false) }} - {{ toTime($item['end_time'], false) }}</div>
                                            </section>
                                        @endforeach
                                    @endif
                                @else
                                    @foreach (App\Models\User::all() as $employee)
                                        @if ($items = $employee->availableTimes($cDate->toDateString()))
                                            @foreach ($items as $item)
                                                <section class="item__block item__block--calendar">
                                                    <div class="item__name">{{ firstChar($employee->firstname, true) }} {{ $employee->lastname }}</div>
                                                    <div class="item__time">{{ toTime($item['start_time'], false) }} - {{ toTime($item['end_time'], false) }}</div>
                                                </section>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @elseif ($type == 'admin')
                            <div class="item">
                                @foreach ($items as $item)
                                    @if ($item->date == $cDate->toDateString())
                                        <section class="item__block  item__block--calendar item__block--padding" data-toggle="tooltip" data-placement="top" title="{{ $item->employee->firstname }} {{ $item->employee->lastname }} - {{ $item->employee->title }}">
                                            <a title="Edit this working time" href="/admin/roster/{{ $pDate->format('m-Y') }}/{{ $item->employee->id }}/{{ $item->id }}/edit" class="item__edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            <a title="Delete this working time" href="/admin/roster/{{ $item->id }}" class="item__remove" data-method="delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                            <div class="item__name">
                                                {{ substr($item->employee->firstname, 0, 1) . '. ' . $item->employee->lastname }}
                                            </div>
                                            <div class="item__time">{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</div>
                                        </section>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endif
                </td>
            @endfor
        </tr>
    @endfor
</table>
