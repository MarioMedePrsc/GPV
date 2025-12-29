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

            $table->string('description', 50)->nullable();
            $table->string('shortName', 20)->nullable();

            $table->foreignId('clientId')->nullable()->constrained('clients');
            $table->foreignId('phaseId')->nullable()->constrained('phases');
            $table->foreignId('estatusId')->nullable()->constrained('estatus');

            $table->float('area')->nullable();
            $table->float('rentalPrice')->nullable();
            $table->float('rentalAreaProposed')->nullable();
            $table->float('monthlyRental')->nullable();

            $table->string('notes', 100)->nullable();

            $table->foreignId('userId')->constrained('users');

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
