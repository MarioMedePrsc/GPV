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
        Schema::create('residential_developments', function (Blueprint $table) {
            $table->id();

            $table->string('description', 120);
            $table->string('short_name', 50)->nullable();

            $table->foreignId('state_id')
                ->constrained('states')
                ->cascadeOnDelete();

            $table->foreignId('municipality_id')
                ->constrained('municipalities')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residential_developments');
    }
};
