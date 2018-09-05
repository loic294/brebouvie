<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnneeToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->integer('annee')->after('id');
        });
        Schema::table('threads', function (Blueprint $table) {
            $table->integer('annee')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('annee');
        });
        Schema::table('threads', function (Blueprint $table) {
            $table->dropColumn('annee');
        });
    }
}
