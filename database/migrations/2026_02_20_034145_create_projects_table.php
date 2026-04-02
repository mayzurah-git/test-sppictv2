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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('project_title');
        $table->string('project_code')->unique();
        $table->text('description')->nullable();
        $table->decimal('estimated_department_cost', 15, 2);
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();

        $table->foreignId('agency_id')
              ->constrained()
              ->onDelete('cascade');

        $table->foreignId('created_by')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

        $table->string('status')->default('Perancangan');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
