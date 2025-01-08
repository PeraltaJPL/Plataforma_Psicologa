<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('questionId');
            $table->unsignedBigInteger('testId'); // Relación con la tabla tests
            $table->text('question_text'); // Texto de la pregunta
            $table->enum('type', ['open', 'multiple_choice'])->default('open'); // Tipo de pregunta
            $table->timestamps();

            // Llave foránea
            $table->foreign('testId')->references('testId')->on('tests')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
}