<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_answers', function (Blueprint $table) {
            $table->bigIncrements('answerId'); // Identificador único de la respuesta
            $table->unsignedBigInteger('resultId'); // Relación con test_results
            $table->unsignedBigInteger('questionId'); // Relación con questions
            $table->unsignedBigInteger('optionId')->nullable(); // Para preguntas de opción múltiple
            $table->text('answerText')->nullable(); // Para preguntas abiertas
            $table->timestamps();

            // Relaciones
            $table->foreign('resultId')->references('resultId')->on('test_results')->onDelete('cascade');
            $table->foreign('questionId')->references('questionId')->on('questions')->onDelete('cascade');
            $table->foreign('optionId')->references('optionId')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_answers');
    }
}
