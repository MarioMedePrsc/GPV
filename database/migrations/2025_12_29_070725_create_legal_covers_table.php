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
        Schema::create('legal_covers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();

            $table->date('fecha')->nullable();
            $table->string('nombre_contrato', 100)->nullable();
            $table->string('finalidad', 100)->nullable();

            // Carátula Contrato
            $table->date('fecha_firma')->nullable();
            $table->string('arrendadora', 100)->nullable();
            $table->string('arrendataria', 200)->nullable();
            $table->string('obligado_solidario', 100)->nullable();
            $table->string('cesionario_renta', 100)->nullable();

            // Condiciones
            $table->string('objeto', 40)->nullable();
            $table->string('expediente_catastral', 50)->nullable();
            $table->string('fraccionamiento', 50)->nullable();
            $table->string('municipio', 50)->nullable();
            $table->string('estado', 50)->nullable();
            $table->float('superficie_terreno')->nullable();
            $table->float('superficie_construccion')->nullable();
            $table->float('renta_m2')->nullable();
            $table->float('renta_mensual')->nullable();
            $table->boolean('renta_mensual_iva')->nullable();
            $table->float('renta_porcentaje')->nullable();
            $table->boolean('porcentaje_incluye_ecommerce')->nullable();
            $table->string('indexacion', 20)->nullable();
            $table->date('fecha_inicio_indexacion')->nullable();
            $table->integer('periodo_gracia_meses')->nullable();
            $table->string('inicio_periodo_gracia', 50)->nullable();
            $table->date('fecha_inicio_gracia')->nullable();
            $table->float('vigencia_contrato_anios')->nullable();
            $table->date('inicio_vigencia')->nullable();
            $table->float('plazo_forzoso_arrendador')->nullable();
            $table->float('plazo_forzoso_arrendataria')->nullable();
            $table->float('prorroga_vigencia')->nullable();
            $table->string('tipo_prorroga', 50)->nullable();
            $table->integer('plazo_solicitud_prorroga_dias')->nullable();
            $table->string('incremento_renta_prorroga', 30)->nullable();
            $table->boolean('riesgo_no_pago')->nullable();
            $table->date('fecha_entrega_posesion')->nullable();
            $table->string('responsable_licencias', 30)->nullable();
            $table->date('fecha_entrega_licencias')->nullable();
            $table->string('mantenimiento')->nullable();
            $table->string('indexacion_mantenimiento')->nullable();

            // Contención riesgos económicos
            $table->integer('deposito_meses')->nullable();
            $table->float('cantidad_deposito')->nullable();
            $table->string('actualizacion_deposito', 30)->nullable();
            $table->integer('renta_anticipada_meses')->nullable();
            $table->float('cantidad_renta_anticipada')->nullable();
            $table->float('tasa_moratoria')->nullable();

            // Mitigación de riesgos
            $table->string('giro_negocio', 50)->nullable();
            $table->boolean('riesgo_distancia')->nullable();
            $table->string('distancia_vivienda', 30)->nullable();
            $table->boolean('riesgo_olores')->nullable();
            $table->string('visto_bueno_ventas', 30)->nullable();
            $table->boolean('riesgo_trafico')->nullable();
            $table->string('visto_bueno_proyectos', 30)->nullable();
            $table->boolean('riesgo_residuos')->nullable();
            $table->boolean('remediacion_suelo')->nullable();
            $table->boolean('riesgo_contaminacion')->nullable();
            $table->boolean('seguro_obligatorio')->nullable();
            $table->boolean('disminucion_renta')->nullable();
            $table->string('supuesto_disminucion', 100)->nullable();
            $table->boolean('giros_prohibidos')->nullable();
            $table->string('listado_giros_prohibidos', 30)->nullable();
            $table->string('lotes_giros_prohibidos', 50)->nullable();
            $table->boolean('exclusividad_giros')->nullable();
            $table->string('lotes_exclusividad', 50)->nullable();
            $table->string('giros_exclusivos', 50)->nullable();
            $table->boolean('incumple_exclusivos')->nullable();
            $table->string('estado_devolucion', 50)->nullable();

            // Contención de riesgos
            $table->boolean('gp_autoriza_layout')->nullable();
            $table->boolean('gp_puede_cancelar')->nullable();
            $table->string('supuesto_cancelacion_gp', 50)->nullable();
            $table->integer('plazo_cancelacion_gp_dias')->nullable();
            $table->boolean('subarrendamiento_libre')->nullable();
            $table->boolean('subarrendamiento_filiales')->nullable();
            $table->boolean('derecho_preferencia')->nullable();
            $table->integer('plazo_respuesta_preferencia')->nullable();
            $table->boolean('preferencia_filiales')->nullable();
            $table->boolean('aviso_filiales')->nullable();

            // Construcción por GP
            $table->boolean('gp_construye')->nullable();
            $table->float('superficie_construir')->nullable();
            $table->boolean('incluye_estacionamiento')->nullable();
            $table->boolean('servicio_agua')->nullable();
            $table->boolean('administra_agua')->nullable();
            $table->boolean('servicio_electricidad')->nullable();
            $table->boolean('preparacion_electrica')->nullable();
            $table->date('fecha_entrega_inmueble')->nullable();
            $table->boolean('entrega_parcial')->nullable();
            $table->boolean('terminacion_por_no_entrega')->nullable();
            $table->string('licencias_a_cargo', 50)->nullable();
            $table->boolean('construccion_totem')->nullable();
            $table->string('posicion_rotulo', 50)->nullable();

            // Obligaciones
            $table->boolean('entrega_planos')->nullable();
            $table->date('fecha_entrega_planos')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_covers');
    }
};
