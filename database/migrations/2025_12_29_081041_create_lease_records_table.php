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
        Schema::create('lease_records', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id')->nullable();

            // ===============================
            // Generales
            // ===============================
            $table->string('lessor', 100)->nullable(); // arrendador
            $table->string('rent_assignment', 100)->nullable(); // cesión de renta
            $table->string('client_legal_name', 200)->nullable(); // razón social cliente
            $table->string('trade_name', 100)->nullable(); // nombre comercial
            $table->string('subdivision', 100)->nullable(); // fraccionamiento
            $table->string('cadastral_file', 100)->nullable(); // expediente catastral
            $table->string('project_name', 100)->nullable(); // nombre del proyecto
            $table->string('location', 250)->nullable(); // ubicación

            // ===============================
            // Contract data
            // ===============================
            $table->string('enkontrol_contract_number', 50)->nullable(); // no contrato enkontrol
            $table->date('contract_sign_date')->nullable(); // fecha de firma
            $table->integer('contract_term_years')->nullable(); // vigencia en años
            $table->integer('grace_period_months')->nullable(); // periodo de gracia en meses
            $table->date('property_delivery_date')->nullable(); // a partir de la entrega del inmueble
            $table->date('grace_period_start_date')->nullable(); // inicio periodo de gracia
            $table->date('grace_period_end_date')->nullable(); // final periodo de gracia
            $table->date('opening_date')->nullable(); // fecha de apertura

            // ===============================
            // Lease detail
            // ===============================
            $table->date('first_invoice_month')->nullable(); // mes de la primera factura
            $table->float('leased_area_m2')->nullable(); // superficie arrendada (m2)
            $table->string('rent_mechanism', 200)->nullable(); // mecánica de renta
            $table->string('rent_update_month', 50)->nullable(); // mes en que se actualiza
            $table->string('incp_month', 50)->nullable(); // mes de INCP
            $table->float('total_rent_without_vat')->nullable(); // renta total sin IVA
            $table->float('vat_16_percent')->nullable(); // IVA 16%
            $table->float('total_rent_with_vat')->nullable(); // renta total con IVA
            $table->string('rent_type', 30)->nullable(); // tipo de renta
            $table->string('staggered_rent', 30)->nullable(); // escalonada
            $table->float('price_per_m2')->nullable(); // precio por m2
            $table->string('annual_update_from', 30)->nullable(); // actualización anual a partir de
            $table->string('increase_mechanism', 50)->nullable(); // mecánica de incremento
            $table->string('update_factor', 30)->nullable(); // factor de actualización
            $table->string('updated_rent_to_invoice_without_vat', 30)->nullable(); // renta actualizada sin IVA
            $table->string('updated_vat_16_percent', 30)->nullable(); // IVA 16% actualizado
            $table->string('updated_rent_to_invoice_with_vat', 30)->nullable(); // renta actualizada con IVA

            // ===============================
            // Security deposit update (without VAT)
            // ===============================
            $table->float('updated_security_deposit_amount')->nullable(); // importe actualizado del depósito
            $table->float('deposit_update_increase')->nullable(); // incremento por actualización
            $table->date('security_deposit_date')->nullable(); // fecha del depósito

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lease_records');
    }
};
