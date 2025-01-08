<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('test_results', function (Blueprint $table) {
            $table->unsignedBigInteger('patientId')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('test_results', function (Blueprint $table) {
            $table->unsignedBigInteger('patientId')->nullable(false)->change();
        });
    }

};
