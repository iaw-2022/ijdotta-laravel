<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTimeZone;

class DoctorAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Auth::user()->doctor()->get()->first();
        $appointments = $doctor->appointments()->paginate(10);
        return view('appointments.doctor-index')->with('appointments', $appointments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = PatientController::mapPatientIdToPatientName(Patient::all());
        $doctor = Auth::user()->doctor()->get()->first();
        $doctors = DoctorController::mapDoctorIdToDoctorName([$doctor]);
        return view('appointments.doctor-create', compact('patients', 'doctors'));
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
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $patients = PatientController::mapPatientIdToPatientName(Patient::all());
        $doctor = Auth::user()->doctor()->get()->first();
        $doctors = DoctorController::mapDoctorIdToDoctorName([$doctor]);
        return view('appointments.doctor-edit', compact('appointment', 'patients', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public static function isCancelable(Appointment $appointment) {
        $tz = new DateTimeZone('America/Argentina/Buenos_Aires');
        $today = Carbon::now($tz);
        $apDate = Carbon::createFromFormat('Y-m-d', $appointment->date, $tz);
        clock()->info('apdate: '.$apDate->toDateString());
        return $today->greaterThan($apDate);
    }
}
