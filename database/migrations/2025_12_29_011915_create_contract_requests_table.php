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
        Schema::create('contract_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->constrained('projects');

            // Datos generales
            $table->string('commercial_activity', 50)->nullable();
            $table->date('request_date')->nullable();

            // Persona moral
            $table->boolean('pm_constitutive_act')->default(false);
            $table->boolean('pm_legal_power')->default(false);
            $table->boolean('pm_official_id')->default(false);
            $table->boolean('pm_address_proof')->default(false);
            $table->boolean('pm_rfc')->default(false);
            $table->boolean('pm_bank_statement')->default(false);
            $table->boolean('pm_other')->default(false);

            // Persona física
            $table->boolean('pf_official_id')->default(false);
            $table->boolean('pf_address_proof')->default(false);
            $table->boolean('pf_rfc')->default(false);
            $table->boolean('pf_bank_statement')->default(false);
            $table->boolean('pf_other')->default(false);

            // Contacto
            $table->string('contact_name', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phone', 20)->nullable();

            // Garantía
            $table->string('guarantee_type', 50)->nullable();
            $table->string('solidary_obligor_name', 50)->nullable();
            $table->string('property_deed', 20)->nullable();
            $table->string('guarantee_address', 200)->nullable();
            $table->boolean('guarantee_official_id')->default(false);
            $table->boolean('guarantee_address_proof')->default(false);
            $table->boolean('guarantee_property_deed')->default(false);

            // Propietarios
            $table->json('property_owners')->nullable();
            $table->boolean('pactum_commissorium')->nullable();
            $table->boolean('rent_assignment_fimsa')->nullable();

            // Inmueble
            $table->string('leased_property', 50)->nullable();
            $table->string('purchase_deed', 20)->nullable();
            $table->string('cadastral_file', 20)->nullable();
            $table->float('total_area')->nullable();
            $table->float('leased_area')->nullable();
            $table->string('property_address', 200)->nullable();

            // Condiciones económicas
            $table->boolean('first_contract')->default(true);
            $table->boolean('renewal')->default(false);
            $table->float('monthly_rent')->nullable();
            $table->float('previous_rent')->nullable();
            $table->float('price_per_m2')->nullable();
            $table->float('increase_percentage')->nullable();
            $table->float('price_list_reference')->nullable();
            $table->float('maintenance_fee')->nullable();
            $table->boolean('meets_minimum_authorized')->nullable();

            // Plazos
            $table->string('term', 20)->nullable();
            $table->boolean('extension')->nullable();
            $table->boolean('automatic_extension')->nullable();
            $table->string('mandatory_term', 10)->nullable();
            $table->string('tenant_mandatory_term', 10)->nullable();
            $table->string('annual_increase', 10)->nullable();
            $table->string('increase_from', 40)->nullable();
            $table->string('additional_increase', 20)->nullable();
            $table->string('increase_when', 40)->nullable();

            // Fechas
            $table->date('contract_signing_date')->nullable();
            $table->integer('security_deposit_months')->nullable();
            $table->integer('advance_rent_months')->nullable();
            $table->date('rent_payment_start')->nullable();
            $table->integer('grace_period_months')->nullable();
            $table->boolean('meets_pg_table')->nullable();
            $table->string('pg_start_when', 30)->nullable();

            // Otros
            $table->boolean('delivery_act_required')->nullable();
            $table->boolean('proportional_property_tax')->nullable();
            $table->string('right_of_first_refusal', 120)->nullable();

            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_requests');
    }
};
