<?php

namespace App\Http\Controllers\Helpers;

use App\Models\AppointmentPattern;
use Exception;

class AppointmentPatternHelperImpl implements AppointmentPatternHelper
{

    public function checkConflicts(AppointmentPattern $appointmentPattern)
    {
        $id = $appointmentPattern->id;
        $doctor_id = $appointmentPattern->doctor_id;
        $initial_date = $appointmentPattern->initial_date;
        $end_date = $appointmentPattern->end_date;
        $initial_time = $appointmentPattern->initial_time;
        $end_time = $appointmentPattern->end_time;
        $days = $appointmentPattern->days;

        $patternsInConflict = AppointmentPattern::whereNot('id', $id)
            ->where('doctor_id', $doctor_id)
            ->where(function ($query) use ($initial_date, $end_date) {
                $query->whereDate('initial_date', '<=', $initial_date)
                    ->whereDate('end_date', '>=', $initial_date)
                    ->orWhere(function ($query) use ($end_date) {
                        $query->whereDate('initial_date', '<=', $end_date)
                            ->whereDate('end_date', '>=', $end_date);
                    });
            })
            ->where(function ($query) use ($initial_time, $end_time) {
                $query->whereTime('initial_time', '<=', $initial_time)
                    ->whereTime('end_time', '>=', $end_time)
                    ->orWhere(function ($query) use ($end_time) {
                        $query->whereTime('initial_time', '<=', $end_time)
                            ->whereTime('end_time', '>=', $end_time);
                    });
            })
            ->get()->all();

        $patternsInConflict = array_filter($patternsInConflict, function($pattern) use ($days) {
            return sizeof(array_intersect($days, $pattern->days));
        });

        clock('Estoy en checkConflictsImpl!');
        clock('Conflicts found: ');
        clock($patternsInConflict);
        return $patternsInConflict;
    }

    public function mapPatternsToErrorsString($patterns) {
        $errors = [];
        foreach ($patterns as $pattern) {
            $errors[$pattern->id] = 'Conflict with pattern '.$pattern->id.' from '.$pattern->initial_date.' to '.$pattern->end_date;
        }
        return $errors;
    }
}
