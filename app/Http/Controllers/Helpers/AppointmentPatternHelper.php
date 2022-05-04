<?php

namespace App\Http\Controllers\Helpers;

use App\Models\AppointmentPattern;

interface AppointmentPatternHelper {
    public function checkConflicts(AppointmentPattern $appointmentPattern);
}