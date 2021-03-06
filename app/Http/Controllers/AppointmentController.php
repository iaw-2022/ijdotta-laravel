<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctor_id = $request->query('doctor_id');
        if ($doctor_id) {
            $appointments = Appointment::where('doctor_id', $doctor_id)->all();
        }
        else {
            $appointments = Appointment::all();
        }
        return view('appointments.index')->with('appointments', $appointments);
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

}
