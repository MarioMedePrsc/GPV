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
        Schema::create('technical_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();

            // Aspectos técnicos
            $table->string('land_status')->nullable();
            $table->string('consideration')->nullable();
            $table->boolean('paid_7_percent')->default(false);
            $table->string('paid_7_percent_time')->nullable();

            // Electricidad
            $table->boolean('electric_infrastructure')->default(false);
            $table->string('electric_time')->nullable();

            // Agua y drenaje
            $table->boolean('water_infrastructure')->default(false);
            $table->boolean('ayd_incorporation_paid')->default(false);
            $table->boolean('ayd_contribution_paid')->default(false);
            $table->boolean('ayd_feasibility_required')->default(false);
            $table->string('ayd_feasibility_time')->nullable();

            // Gestiones requeridas
            $table->boolean('glg')->default(false);
            $table->string('glg_time')->nullable();
            $table->boolean('road_alignment')->default(false);
            $table->string('road_alignment_time')->nullable();
            $table->boolean('land_marking')->default(false);
            $table->string('land_marking_time')->nullable();
            $table->boolean('licenses')->default(false);
            $table->string('licenses_time')->nullable();
            $table->boolean('fusion')->default(false);
            $table->string('fusion_time')->nullable();
            $table->boolean('subdivision')->default(false);
            $table->string('subdivision_time')->nullable();
            $table->boolean('land_use')->default(false);
            $table->string('land_use_time')->nullable();
            $table->boolean('environmental_studies')->default(false);
            $table->string('environmental_studies_time')->nullable();

            $table->string('notes', 250)->nullable();
            $table->string('additional_works', 250)->nullable();

            // Anexos técnicos
            $table->boolean('leased_polygon')->default(false);
            $table->boolean('prohibited_uses')->default(false);
            $table->boolean('restrictions')->default(false);
            $table->boolean('work_obligations')->default(false);
            $table->boolean('site_plan')->default(false);
            $table->boolean('property_detail')->default(false);
            $table->boolean('other_attachment')->default(false);

            // Aspectos administrativos
            $table->string('client_identifier', 100)->nullable();
            $table->string('billing_name', 200)->nullable();
            $table->string('rfc', 30)->nullable();
            $table->string('fiscal_address', 250)->nullable();
            $table->string('business_activity', 50)->nullable();
            $table->string('trade_name', 100)->nullable();
            $table->string('bank_key', 50)->nullable();
            $table->string('bank', 50)->nullable();
            $table->string('rent_payment_account', 50)->nullable();
            $table->date('estimated_signing_date')->nullable();
            $table->integer('grace_period_months')->nullable();
            $table->integer('advance_rent_months')->nullable();
            $table->decimal('advance_rent_amount', 12, 2)->nullable();
            $table->date('rent_start_date')->nullable();
            $table->integer('deposit_months')->nullable();
            $table->decimal('deposit_amount', 12, 2)->nullable();
            $table->string('commercial_exception', 200)->nullable();

            // Contacto
            $table->string('contact_name', 100)->nullable();
            $table->string('contact_email', 50)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->boolean('internal_lead')->default(false);
            $table->boolean('broker_operation')->default(false);
            $table->string('commission_conditions', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_requests');
    }
};
