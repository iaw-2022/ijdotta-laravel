<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, Story $story)
    {
        //
    }
}
