<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('optionId');
            $table->unsignedBigInteger('questionId'); // Relación con la tabla questions
            // $table->integer('option_value'); // Valor de la opción (1 a 5)
            $table->string('optionText', 255); // Texto de la opción
            $table->boolean('isCorrect')->default(false); // Indica si la opción es correcta
            $table->timestamps(); // created_at y updated_at

            // Llave foránea
            $table->foreign('questionId')->references('questionId')->on('questions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('options');
    }
}
