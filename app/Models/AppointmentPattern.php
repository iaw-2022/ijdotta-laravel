<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentPattern extends Model
{
    use HasFactory;

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
