<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DoctorStoryController extends Controller
{

    private $doctor;

    // public function __construct()
    // {
    //     clock(Auth::user());
    //     $this->doctor = Auth::user()->doctor;
    // }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $doctor = Auth::user()->doctor;
        return view('stories.doctor-create', compact('doctor', 'patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $this->doctor = Auth::user()->doctor;
        $story = Story::create($this->validateStory($request, $patient));

        session()->flash('success', 'Story successfully created.');
        return redirect(route('patients.stories.show', [$patient->id, $story->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, Story $story)
    {
        $treatments = $story->treatments()->get()->all();
        return view('stories.doctor-show')
            ->with('patient', $patient)
            ->with('story', $story)
            ->with('treatments', $treatments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, Story $story)
    {
        $doctor = Auth::user()->doctor;
        $treatments = $story->treatments;
        return view('stories.doctor-edit', compact('doctor', 'patient', 'story', 'treatments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, Story $story)
    {
        $this->doctor = Auth::user()->doctor;
        $story->update($this->validateStory($request, $patient));

        session()->flash('success', 'Story successfully updated.');
        return redirect(route('patients.stories.show', [$patient->id, $story->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, Story $story)
    {
        $story->delete();
        session()->flash('success', 'Story successfully deleted.');
        return redirect(route('patients.show', [$patient->id]));
    }

    public function validateStory(Request $request, Patient $patient, ?Story $story = null)
    {
        $attributes = $request->validate([
            'date' => ['required', 'date', Rule::in(Appointment::where('patient_id', $patient->id)->where('doctor_id', $this->doctor->id)->pluck('date')->toArray())],
            'description' => ['required'],
        ]);

        return array_merge($attributes, [
            'doctor_id' => $this->doctor->id,
            'patient_id' => $patient->id,
        ]);
    }
}
