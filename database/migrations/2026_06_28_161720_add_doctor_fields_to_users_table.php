<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->foreignId('department_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('gender')->nullable();

            $table->integer('age')->nullable();

            $table->string('qualification')->nullable();

            $table->string('specialization')->nullable();

            $table->integer('experience')->nullable();

            $table->decimal('consultation_fee',8,2)->nullable();

            $table->string('shift')->nullable();

            $table->string('image')->nullable();

            $table->boolean('status')->default(true);

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropConstrainedForeignId('department_id');

            $table->dropColumn([

                'gender',

                'age',

                'qualification',

                'specialization',

                'experience',

                'consultation_fee',

                'shift',

                'image',

                'status'

            ]);

        });
    }
};