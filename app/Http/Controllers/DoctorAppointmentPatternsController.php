<?php

namespace App\Http\Controllers;

use App\Models\AppointmentPattern;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helpers\AppointmentPatternHelper;
use App\Http\Controllers\Helpers\AppointmentPatternHelperImpl;
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
        $conflicts = $this->appointmentPatternHelper->checkConflicts($pattern);
        if (sizeof($conflicts) > 0) {
            $pattern->delete();
            $mappedErrors = $this->appointmentPatternHelper->mapPatternsToErrorsString($conflicts);
            return redirect()->back()->withErrors($mappedErrors);
        }
        session()->flash('success', 'Pattern successfully created.');
        return redirect(route('appointmentspatterns.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppointmentPattern  $appointmentspattern
     * @return \Illuminate\Http\Response
     */
    public function edit(AppointmentPattern $appointmentspattern)
    {
        return view('appointments-patterns.doctor-edit', compact('appointmentspattern'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppointmentPattern  $appointmentspattern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppointmentPattern $appointmentspattern)
    {
        //
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
        session()->flash('success', 'Pattern succesfully deleted.');
        return redirect(route('appointmentspatterns.index'));
    }

    private function validatePattern(Request $request) {
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

}
