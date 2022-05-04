<?php

namespace App\Http\Controllers\Helpers;

use App\Models\AppointmentPattern;
use Exception;

class AppointmentPatternHelperImpl implements AppointmentPatternHelper {

    public function checkConflicts(AppointmentPattern $appointmentPattern) {
        /*
        Buscar patrones p tales que:
            pattern.initial_date <= p.initial_date <= pattern.end_date || pattern.initial_date <= p.end_date <= pattern.end_date
            pattern.initial_time <= p.initial_time <= pattern.end_time || pattern.initial_time <= p.end_time <= pattern.end_time

            si encuentra alguno, entonces no puede crear un patrón para ese día
         */

        clock('Estoy en checkConflictsImpl!');
        throw new Exception("Collision with existent pattern.");

    }

    
}