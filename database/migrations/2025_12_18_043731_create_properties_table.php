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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('estatusId')->nullable()
                ->comment('0=INACTIVO, 1=ACTIVO');

            $table->unsignedTinyInteger('propertyEstatusId')->nullable()
                ->comment('0=NO RENTADO, 1=RENTADO');

            $table->unsignedBigInteger('propertyTypeId')->nullable();
            $table->unsignedBigInteger('municipalityId')->nullable();
            $table->unsignedBigInteger('stateId')->nullable();
            $table->unsignedBigInteger('residentialDevelopmentId')->nullable();

            $table->string('propertyRecordNumber', 20)->nullable();

            $table->unsignedBigInteger('ownerCompanyId')->nullable();
            $table->unsignedBigInteger('taxPayerCompanyId')->nullable();

            $table->string('address', 255)->nullable();

            $table->float('area')->nullable();
            $table->float('builtArea')->nullable();

            $table->string('block', 30)->nullable();
            $table->string('lot', 30)->nullable();

            $table->json('dynamic_data')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
