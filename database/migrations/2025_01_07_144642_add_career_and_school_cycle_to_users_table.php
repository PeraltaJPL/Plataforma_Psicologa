<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCareerAndSchoolCycleToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('career')->nullable()->after('email'); // Columna career
            $table->string('schoolCycle')->nullable()->after('career'); // Columna schoolCycle
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['career', 'schoolCycle']); // Elimina ambas columnas
        });
    }
}
