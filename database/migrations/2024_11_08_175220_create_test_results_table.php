<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->bigIncrements('resultId');
            $table->unsignedBigInteger('patientId');
            $table->foreign('patientId')->references('patientId')->on('patients');
            $table->unsignedBigInteger('testId'); 
            $table->foreign('testId')->references('testId')->on('tests');
            $table->text('result')->nullable();
            $table->date('testDate');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
