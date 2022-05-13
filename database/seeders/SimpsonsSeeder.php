<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentPattern;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Role;
use App\Models\Story;
use App\Models\Treatment;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use DateTimeZone;

class SimpsonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_id = Role::where('role', 'doctor')->get()->first()->id;

        $user = User::create([
            'name' => 'Julius',
            'email' => 'dr.julius.hibbert@gmail.com',
            'password' => '12345678',
            'role_id' => $role_id,
        ]);

        $doctor = Doctor::create([
            'id' => '13524',
            'user_id' => $user->id,
            'name' => 'Julius',
            'lastname' => 'Hibbert'
        ]);

        $initial_date = Carbon::now(new DateTimeZone('America/Argentina/Buenos_Aires'));
        $initial_date->setDate(2022, 04, 1);
        $initial_date->setTime(9, 0);
        $end_date = $initial_date->copy()->addDays(60);
        $end_date->setTime(12, 0);
        

        $pattern = AppointmentPattern::create([
            'doctor_id' => $doctor->id,
            'initial_date' => $initial_date->toDateString(),
            'end_date' => $end_date->toDateString(),
            'initial_time' => $initial_date->toTimeString(),
            'end_time' => $end_date->toTimeString(),
            'appointment_duration' => '00:30:00',
            'days' => ['Mon', 'Tue', 'Wed'],
        ]);

        $current_date = $initial_date->copy();
        while ($current_date->lessThan($end_date)) {

            $dayOfWeek = $current_date->dayOfWeek;
            if ($dayOfWeek != Carbon::SATURDAY && $dayOfWeek != Carbon::SUNDAY) {
                
                $initial_date_time = $current_date->copy();
                $initial_date_time->setTime($initial_date->hour, $initial_date->minute);
                $end_date_time = $current_date->copy();
                $end_date_time->setTime($end_date->hour, $end_date->minute);
                
                while ($initial_date_time->notEqualTo($end_date_time)) {
                    Appointment::create([
                        'doctor_id' => $doctor->id,
                        'appointment_pattern_id' => $pattern->id,
                        'date' => $current_date->toDateString(),
                        'initial_time' => $initial_date_time->toTimeString(),
                        'end_time' => $initial_date_time->addMinutes(30)->toTimeString()
                    ]);
                }
            }
            
            $current_date->addDay();
        }

        $patient = Patient::create([
            'name' => 'Homer',
            'lastname' => 'Simpson',
            'email' => 'chunkylover53@aol.com',
            'password' => bcrypt(12345678),
            'health_insurance_company' => 'Springfield Health',
            'health_insurance_id' => 345761247
        ]);

        for ($i = 0; $i < 10; $i++) {
            $appointment = $doctor->appointments()->get()->random(1)->first();
            $appointment->patient_id = $patient->id;
            $appointment->save();
        }

        $stories = [
            "El paciente sufre la explosión de una lata de cerveza Duff. Permanece en coma.",
            "El paciente sufre la amputación del pulgar por intentar comer un pastel",
            "El paciente sufre golpes en el estómago por bolas de cañón.",
            "El paciente cae de un risco por saltar en patineta.",
            "Se retira un crayón del cerebro del paciente.",
        ];
        $assigned_appointments = $doctor->appointments()->where('patient_id', $patient->id)->get()->all();
        foreach($assigned_appointments as $appointment) {
            $story = Story::create([
                'date' => $appointment->date,
                'doctor_id' => $doctor->id,
                'patient_id' => $patient->id,
                'description' => $stories[array_rand($stories)]
            ]);


            $treatment = Treatment::create([
                'story_id' => $story->id,
                'title' => 'SOME TITLE',
                'description' => 'Reposo por 1 mes.'
            ]);

        }

    }

}
