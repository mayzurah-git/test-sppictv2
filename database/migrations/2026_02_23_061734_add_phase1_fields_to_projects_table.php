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

            $table->text('objective')->nullable();
            $table->text('scope')->nullable();
            $table->string('implementation_period')->nullable();
            $table->string('funding_source')->nullable();
            $table->string('approval_reference')->nullable();

            $table->string('application_status')->default('Draf');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->dropColumn([
                'objective',
                'scope',
                'implementation_period',
                'funding_source',
                'approval_reference',
                'application_status',
            ]);

        });
    }
};
