<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentPatternController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Does not require auth currently.
Route::resources([
    'doctors' => DoctorController::class,
    'doctors.appointments' => AppointmentController::class,
    'doctors.appointmentspatterns' => AppointmentPatternController::class,
    'patients' => PatientController::class,
    'patients.stories' => StoryController::class,
    'patients.treatments' => TreatmentController::class,
]);

Route::get('/main', function() {
    return view('layouts.main');
});

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
