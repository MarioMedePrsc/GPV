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
        Schema::create('lease_records_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('lease_record_id');

            $table->integer('num')->nullable();
            $table->year('year')->nullable();
            $table->tinyInteger('month')->nullable();

            $table->float('factor')->nullable();
            $table->float('increment')->nullable();
            $table->float('updated_rent')->nullable();
            $table->float('charge_percentage')->nullable();
            $table->float('rent_to_charge')->nullable();

            $table->timestamps();

            $table->foreign('lease_record_id')
                ->references('id')
                ->on('lease_records')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lease_records_details');
    }
};
