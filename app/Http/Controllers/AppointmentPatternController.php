<?php

namespace App\Http\Controllers;

use App\Models\AppointmentPattern;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentPatternController extends Controller
{
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @param  \App\Models\AppointmentPattern  $appointmentPattern
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor, AppointmentPattern $appointmentPattern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @param  \App\Models\AppointmentPattern  $appointmentPattern
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor, AppointmentPattern $appointmentPattern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @param  \App\Models\AppointmentPattern  $appointmentPattern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor, AppointmentPattern $appointmentPattern)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @param  \App\Models\AppointmentPattern  $appointmentPattern
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor, AppointmentPattern $appointmentPattern)
    {
        //
    }
}
