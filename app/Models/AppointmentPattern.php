<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentPattern extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $casts = [
        'days' => 'array',
    ];

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
