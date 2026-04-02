<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Menambah lajur untuk menyimpan lokasi fail (nullable sebab Fasa 1 belum ada fail)
            $table->string('proposal_file')->nullable()->after('application_status');
            $table->string('presentation_file')->nullable()->after('proposal_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['proposal_file', 'presentation_file']);
        });
    }
};
