<?php

namespace App\Http\Controllers;

use App\Models\AppointmentPattern;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\AppointmentPatternHelper;
use App\Http\Controllers\Helpers\AppointmentPatternHelperImpl;
use Exception;

class AppointmentPatternController extends Controller
{

    public AppointmentPatternHelper $appointmentPatternHelper;

    public function __construct()
    {
        $this->appointmentPatternHelper = new AppointmentPatternHelperImpl();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function index(Doctor $doctor)
    {
        $patterns = $doctor->appointmentPatterns()->get()->all();
        return view('appointments-patterns.index')->with('patterns', $patterns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function create(Doctor $doctor)
    {
        return view('appointments-patterns.create', compact('doctor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Doctor $doctor)
    {
        $data = $request->input();
        AppointmentPattern::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @param  \App\Models\AppointmentPattern  $appointmentspattern
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor, AppointmentPattern $appointmentspattern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @param  \App\Models\AppointmentPattern  $appointmentspattern
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor, AppointmentPattern $appointmentspattern)
    {
        return view('appointments-patterns.edit', compact('doctor'))
                ->with('appointmentspattern', $appointmentspattern);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @param  \App\Models\AppointmentPattern  $appointmentspattern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor, AppointmentPattern $appointmentspattern)
    {
        $data = $request->input();
        
        $attributes = ['initial_date', 'end_date', 'initial_time', 'end_time', 'appointment_duration', 'days'];
        foreach ($attributes as $attr) {
            $appointmentspattern->$attr = $data[$attr];
        }

        try {
            $this->appointmentPatternHelper->checkConflicts($appointmentspattern);
            $appointmentspattern->save();
        } catch (Exception $exception) {
            clock($exception);
        }
        return redirect(route('admin.doctors.appointmentspatterns.index', [$doctor->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @param  \App\Models\AppointmentPattern  $appointmentspattern
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor, AppointmentPattern $appointmentspattern)
    {
        //
    }
}
