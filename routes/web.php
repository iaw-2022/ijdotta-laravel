<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentPatternController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\DoctorAppointmentPatternsController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorPatientController;
use App\Http\Controllers\DoctorStoryController;
use App\Http\Controllers\DoctorTreatmentController;
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
    return view('home');
})->middleware(['auth'])->name('dashboard');

// Does not require auth currently.

Route::name('')->group(function() {
    Route::resource('appointments', DoctorAppointmentController::class)->only('index', 'destroy');
    Route::resource('appointmentspatterns', DoctorAppointmentPatternsController::class)->except('index', 'show');
    Route::resource('patients', DoctorPatientController::class);
    Route::resource('patients.stories', DoctorStoryController::class)->except('index');
    Route::resource('patients.stories.treatments', DoctorTreatmentController::class)->except('index', 'show');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('doctors', DoctorController::class)->except('show');
    Route::resource('doctors.appointmentspatterns', AppointmentPatternController::class)->except('show', 'edit', 'update');
    Route::resource('appointments', AppointmentController::class)->only('index', 'destroy');
    Route::resource('patients', PatientController::class);
    Route::resource('patients.stories', StoryController::class)->only('destroy');
    Route::resource('patients.stories.treatments', TreatmentController::class)->only('destroy');
    Route::resource('users', UserController::class);
});


Route::get('/main', function () {
    return view('layouts.main');
});

require __DIR__ . '/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
