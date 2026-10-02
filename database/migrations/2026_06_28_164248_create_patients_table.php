<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {

            $table->id();

            $table->string('patient_code')->unique();

            $table->string('name');

            $table->string('email')->nullable();

            $table->string('phone');

            $table->string('gender');

            $table->integer('age');

            $table->date('dob')->nullable();

            $table->string('blood_group')->nullable();

            $table->text('address');

            $table->string('guardian_name')->nullable();

            $table->string('guardian_phone')->nullable();

            $table->string('marital_status')->nullable();

            $table->string('occupation')->nullable();

            $table->string('image')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};