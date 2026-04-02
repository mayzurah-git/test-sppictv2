<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('project_cost', 'estimated_department_cost');

            $table->decimal('estimated_department_cost', 15, 2)
                  ->nullable(false)
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('estimated_department_cost', 'project_cost');

            $table->decimal('project_cost', 15, 2)
                  ->nullable()
                  ->change();
        });
    }
};
