<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentPatternController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\DoctorAppointmentPatternsController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorPatientController;
use App\Http\Controllers\DoctorStoryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return redirect('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Does not require auth currently.

Route::name('')->group(function() {
    Route::resources([
        // 'doctors' => DoctorController::class,
        // 'doctors.appointmentspatterns' => AppointmentPatternController::class,
        'appointments' => DoctorAppointmentController::class,
        'appointmentspatterns' => DoctorAppointmentPatternsController::class,
        'patients' => DoctorPatientController::class,
        'patients.stories' => DoctorStoryController::class,
        'patients.stories.treatments' => TreatmentController::class,
    ]);

});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resources([
        'doctors' => DoctorController::class,
        'doctors.appointmentspatterns' => AppointmentPatternController::class,
        'appointments' => AppointmentController::class,
        'patients' => PatientController::class,
        'patients.stories' => StoryController::class,
        'patients.stories.treatments' => TreatmentController::class,
        'users' => UserController::class
    ]);
});


Route::get('/main', function () {
    return view('layouts.main');
});

require __DIR__ . '/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
