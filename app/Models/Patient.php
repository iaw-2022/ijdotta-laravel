<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public $guarded = [];

    public function stories() {
        return $this->hasMany(Story::class);
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
