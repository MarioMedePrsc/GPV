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
        Schema::create('propertyTax', function (Blueprint $table) {
            $table->id();

            $table->string('propertyRecordNumber', 20)->nullable();
            $table->unsignedBigInteger('propertyTaxEstatusId')->nullable();
            $table->unsignedBigInteger('verifiedUserId')->nullable();

            $table->integer('taxYear')->nullable();

            $table->float('cadastralValue')->nullable();
            $table->float('cadastralValuePerArea')->nullable();
            $table->float('cadastralValuePerBuiltArea')->nullable();

            $table->string('receiptFileUrl')->nullable();

            $table->float('taxAmount')->nullable();
            $table->float('penalties')->nullable();
            $table->float('otherCharges')->nullable();
            $table->float('charges')->nullable();

            $table->float('discount')->nullable();
            $table->float('bonuses')->nullable();
            $table->float('others')->nullable();

            $table->float('totalTax')->nullable();
            $table->float('netPayable')->nullable();

            $table->timestamps();

            $table->foreign('propertyRecordNumber')
                ->references('propertyRecordNumber')
                ->on('properties')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propertyTax');
    }
};
