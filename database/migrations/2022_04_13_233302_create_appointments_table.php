<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_pattern_id')->default(0)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('patient_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('date');
            $table->time('initial_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
