<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('patientId');
            $table->string('name', 100);
            $table->string('controlNumber', 50)->unique();
            $table->string('career', 100)->nullable();
            $table->string('schoolCycle', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
