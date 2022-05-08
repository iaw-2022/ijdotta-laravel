<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index')->with('patients', $patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Patient::create($this->validatePatient($request));
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

        return view('patients.show')
                ->with('patient', $patient)
                ->with('stories', $stories)
                ->with('appointments', $appointments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit')
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
        $patient->update($this->validatePatient($request, $patient));
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

    public static function mapPatientIdToPatientName($patients) {
        $patientsMap = [];
        foreach ($patients as $patient) {
            $patientsMap[$patient->id] = $patient->lastname.', '.$patient->name;
        }
        return $patientsMap;
    }

    public static function validatePatient(Request $request, ?Patient $patient = null) {

        $patient ??= new Patient();

        return $request->validate([
            'name' => ['required', 'max:100', 'regex:/[\w ]+/'],
            'lastname' => ['required', 'max:100', 'regex:/[\w ]+/'],
            'email' => ['required', Rule::unique('patients', 'email')->ignore($patient)],
            'health_insurance_company' => ['max:100'],
            'health_insurance_id' => ['max:100'],
        ]);
    }
}
