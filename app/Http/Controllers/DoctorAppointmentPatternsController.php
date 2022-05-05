<?php

namespace App\Http\Controllers;

use App\Models\AppointmentPattern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorAppointmentPatternsController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentPattern  $appointmentspattern
     * @return \Illuminate\Http\Response
     */
    public function show(AppointmentPattern $appointmentspattern)
    {
        //
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
        //
    }
}
