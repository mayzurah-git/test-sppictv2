<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficerContactToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('officer_name')->nullable()->after('created_by');
            $table->string('officer_position')->nullable()->after('officer_name');
            $table->string('officer_email')->nullable()->after('officer_position');
            $table->string('officer_phone')->nullable()->after('officer_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['officer_name', 'officer_position', 'officer_email', 'officer_phone']);
        });
    }
}
