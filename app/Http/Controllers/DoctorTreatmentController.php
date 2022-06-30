<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Treatment;
use App\Models\Patient;
use Illuminate\Http\Request;

class DoctorTreatmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient, Story $story)
    {
        return view('treatments.doctor-create', compact('patient', 'story'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient, Story $story)
    {
        Treatment::create($this->validateTreatment($request, $story));
        session()->flash('success', 'Treatment successfully created.');
        return redirect(route('patients.stories.show', [$patient->id, $story->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, Story $story, Treatment $treatment)
    {
        $treatment->delete();
        session()->flash('success', 'Treatment successfully deleted.');
        return redirect(route('patients.stories.show', [$patient->id, $story->id]));
    }

    public function validateTreatment(Request $request, Story $story) {
        $attributes = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);

        return array_merge($attributes, [
            'story_id' => $story->id,
        ]);
    }
}
