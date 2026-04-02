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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->enum('title', ['PRA-JTICTNS', 'JTICTNS', 'JPICTNS']);
            $table->enum('meeting_number', ['1', '2', '3', '4', '5', '6']);
            $table->year('year');
            $table->date('date');
            $table->time('time');
            $table->string('venue');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Tidak Aktif');
            $table->date('project_update_deadline');
            $table->string('minutes_file')->nullable();
            $table->text('agenda');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
