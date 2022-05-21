<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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
        $appointments = $doctor->appointments()->get()->all();
        return view('appointments.doctor-index')->with('appointments', $appointments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        session()->flash('success', 'Appointment successfully deleted.');
        return redirect()->back();
    }

    public static function isCancelable(Appointment $appointment) {
        $tz = new DateTimeZone('America/Argentina/Buenos_Aires');
        $today = Carbon::now($tz);
        $apDate = Carbon::createFromFormat('Y-m-d', $appointment->date, $tz);
        clock()->info('apdate: '.$apDate->toDateString());
        return $today->greaterThan($apDate);
    }
}
