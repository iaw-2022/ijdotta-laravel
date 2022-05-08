<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class DoctorPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.doctor-index')->with('patients', $patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.doctor-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Patient::create(PatientController::validatePatient($request));
        session()->flash('success', 'Patient succesfully created.');
        return redirect(route('admin.patients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $stories = $patient->stories()->get()->all();
        $appointments = $patient->appointments()->get()->all();
        $cancelableAppointments = [];
        foreach ($appointments as $appointment) {
            $cancelableAppointments[$appointment->id] = $appointment instanceof Appointment? DoctorAppointmentController::isCancelable($appointment) : false;
        }

        return view('patients.doctor-show')
                ->with('patient', $patient)
                ->with('stories', $stories)
                ->with('appointments', $appointments)
                ->with('cancellable', $cancelableAppointments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patients.doctor-edit')
                ->with('patient', $patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $patient->update(PatientController::validatePatient($request, $patient));
        session()->flash('success', 'Patient succesfully updated.');
        return redirect(route('admin.patients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        session()->flash('success', 'Patient succesfully deleted.');
        return redirect(route('admin.patients.index'));
    }
}
