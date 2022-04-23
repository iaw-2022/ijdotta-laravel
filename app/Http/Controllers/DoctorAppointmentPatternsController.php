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
        $doctor_id = Auth::user()->doctor_id; //TODO will not work until the User model and migration is modified
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentPattern  $appointmentPattern
     * @return \Illuminate\Http\Response
     */
    public function show(AppointmentPattern $appointmentPattern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppointmentPattern  $appointmentPattern
     * @return \Illuminate\Http\Response
     */
    public function edit(AppointmentPattern $appointmentPattern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppointmentPattern  $appointmentPattern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppointmentPattern $appointmentPattern)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentPattern  $appointmentPattern
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentPattern $appointmentPattern)
    {
        //
    }
}
