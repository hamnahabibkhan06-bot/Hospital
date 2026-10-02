<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('appointment_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('symptoms');

            $table->text('diagnosis');

            $table->text('medicines');

            $table->text('tests')->nullable();

            $table->text('advice')->nullable();

            $table->date('next_visit')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};