<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('noteId');
            // $table->unsignedBigInteger('userId');
            // $table->foreign('userId')->references('userId')->on('users');
            $table->string('title', 100);
            $table->text('description');
            $table->timestamp('createdAt')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
