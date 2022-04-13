<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }

    public function stories() {
        return $this->hasMany(Story::class);
    }

    public function specialities() {
        return $this->belongsToMany(Speciality::class);
    }

    public function appointmentPatterns() {
        return $this->hasMany(AppointmentPattern::class);
    }
}
