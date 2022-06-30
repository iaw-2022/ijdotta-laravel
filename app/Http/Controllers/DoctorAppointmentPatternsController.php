<?php

namespace App\Http\Controllers;

use App\Models\AppointmentPattern;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helpers\AppointmentPatternHelper;
use App\Http\Controllers\Helpers\AppointmentPatternHelperImpl;
use App\Models\Appointment;
use Carbon\Carbon;

class DoctorAppointmentPatternsController extends Controller
{
    public AppointmentPatternHelper $appointmentPatternHelper;

    public function __construct()
    {
        $this->appointmentPatternHelper = new AppointmentPatternHelperImpl();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Auth::user()->doctor()->get()->first();
        $patterns = $doctor->appointmentPatterns()->get()->all();
        return view('appointments-patterns.doctor-index', compact('doctor', 'patterns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appointments-patterns.doctor-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pattern = AppointmentPattern::create($this->validatePattern($request));
        clock($pattern);
        $conflicts = $this->appointmentPatternHelper->checkConflicts($pattern);
        if (sizeof($conflicts) > 0) {
            $pattern->delete();
            $mappedErrors = $this->appointmentPatternHelper->mapPatternsToErrorsString($conflicts);
            return redirect()->back()->withErrors($mappedErrors);
        }
        $this->createAppointments($pattern);
        session()->flash('success', 'Pattern and appointments successfully created.');
        return redirect(route('appointmentspatterns.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentPattern  $appointmentspattern
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentPattern $appointmentspattern)
    {
        $appointmentspattern->delete();
        session()->flash('success', 'Pattern and associated appointments succesfully deleted.');
        return redirect(route('appointmentspatterns.index'));
    }

    private function validatePattern(Request $request)
    {
        $data = $request->validate([
            'initial_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:initial_date'],
            'initial_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:initial_time'],
            'appointment_duration' => ['required', 'digits_between:1,2'],
            'days' => ['required', 'array'],
        ]);

        $doctor = ['doctor_id' => Auth::user()->doctor->id];
        return array_merge($data, $doctor);
    }

    private function createAppointments(AppointmentPattern $pattern)
    {
        $initial_date = Carbon::createFromFormat('Y-m-d H:i', $pattern->initial_date . ' ' . $pattern->initial_time);
        clock('init_date_time: ', $initial_date);
        $end_date = Carbon::createFromFormat('Y-m-d H:i', $pattern->end_date . ' ' . $pattern->end_time);
        clock('end_date_time', $end_date);
        $appointment_duration = $pattern->appointment_duration;

        $current_date = $initial_date->copy();
        while ($current_date->lessThan($end_date)) {

            $daysOfWeek = $this->getDaysOfWeek($pattern);
            $dayOfWeek = $current_date->dayOfWeek;
            if (in_array($dayOfWeek, $daysOfWeek)) {

                $initial_date_time = $current_date->copy();
                $initial_date_time->setTime($initial_date->hour, $initial_date->minute);
                $end_date_time = $current_date->copy();
                $end_date_time->setTime($end_date->hour, $end_date->minute);


                while ($initial_date_time->lessThanOrEqualTo($end_date_time)) {
                    Appointment::create([
                        'doctor_id' => $pattern->doctor_id,
                        'appointment_pattern_id' => $pattern->id,
                        'date' => $current_date->toDateString(),
                        'initial_time' => $initial_date_time->toTimeString(),
                        'end_time' => $initial_date_time->addMinutes($appointment_duration)->toTimeString()
                    ]);
                }
            }

            $current_date->addDay();
        }
    }

    private function getDaysOfWeek(AppointmentPattern $pattern)
    {
        $daysOfWeek = [];
        foreach ($pattern->days as $day) {
            switch ($day) {
                case 'Mon':
                    array_push($daysOfWeek, Carbon::MONDAY);
                    break;
                case 'Tue':
                    array_push($daysOfWeek, Carbon::TUESDAY);
                    break;
                case 'Wed':
                    array_push($daysOfWeek, Carbon::WEDNESDAY);
                    break;
                case 'Thu':
                    array_push($daysOfWeek, Carbon::THURSDAY);
                    break;
                case 'Fri':
                    array_push($daysOfWeek, Carbon::FRIDAY);
                    break;
                case 'Sat':
                    array_push($daysOfWeek, Carbon::SATURDAY);
                    break;
                case 'Sun':
                    array_push($daysOfWeek, Carbon::SUNDAY);
                    break;
            }
        }

        return $daysOfWeek;
    }
}
