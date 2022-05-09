<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Doctor extends Model
{
    use HasFactory;

    protected function email(): Attribute {
        return Attribute::make(
            get: fn ($value) => $this->user()->get()->first()->email
        );
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

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
