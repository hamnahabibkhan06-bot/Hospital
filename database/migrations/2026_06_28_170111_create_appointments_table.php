<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('patient_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('doctor_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->date('appointment_date');

            $table->time('appointment_time');

            $table->string('token_no');

            $table->string('problem');

            $table->string('status')->default('Pending');

            $table->text('remarks')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};