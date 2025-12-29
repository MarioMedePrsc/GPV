<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class LegalCover extends Model
{
    protected $table = 'legal_covers';

    protected $fillable = [
        // Generales
        'project_id',
        'fecha',
        'nombre_contrato',
        'finalidad',

        // Carátula Contrato
        'fecha_firma',
        'arrendadora',
        'arrendataria',
        'obligado_solidario',
        'cesionario_renta',

        // Condiciones
        'objeto',
        'expediente_catastral',
        'fraccionamiento',
        'municipio',
        'estado',
        'superficie_terreno',
        'superficie_construccion',
        'renta_m2',
        'renta_mensual',
        'renta_mensual_iva',
        'renta_porcentaje',
        'porcentaje_incluye_ecommerce',
        'indexacion',
        'fecha_inicio_indexacion',
        'periodo_gracia_meses',
        'inicio_periodo_gracia',
        'fecha_inicio_gracia',
        'vigencia_contrato_anios',
        'inicio_vigencia',
        'plazo_forzoso_arrendador',
        'plazo_forzoso_arrendataria',
        'prorroga_vigencia',
        'tipo_prorroga',
        'plazo_solicitud_prorroga_dias',
        'incremento_renta_prorroga',
        'riesgo_no_pago',
        'fecha_entrega_posesion',
        'responsable_licencias',
        'fecha_entrega_licencias',
        'mantenimiento',
        'indexacion_mantenimiento',

        // Contención riesgos económicos
        'deposito_meses',
        'cantidad_deposito',
        'actualizacion_deposito',
        'renta_anticipada_meses',
        'cantidad_renta_anticipada',
        'tasa_moratoria',

        // Mitigación de riesgos
        'giro_negocio',
        'riesgo_distancia',
        'distancia_vivienda',
        'riesgo_olores',
        'visto_bueno_ventas',
        'riesgo_trafico',
        'visto_bueno_proyectos',
        'riesgo_residuos',
        'remediacion_suelo',
        'riesgo_contaminacion',
        'seguro_obligatorio',
        'disminucion_renta',
        'supuesto_disminucion',
        'giros_prohibidos',
        'listado_giros_prohibidos',
        'lotes_giros_prohibidos',
        'exclusividad_giros',
        'lotes_exclusividad',
        'giros_exclusivos',
        'incumple_exclusivos',
        'estado_devolucion',

        // Contención de riesgos (GP)
        'gp_autoriza_layout',
        'gp_puede_cancelar',
        'supuesto_cancelacion_gp',
        'plazo_cancelacion_gp_dias',
        'subarrendamiento_libre',
        'subarrendamiento_filiales',
        'derecho_preferencia',
        'plazo_respuesta_preferencia',
        'preferencia_filiales',
        'aviso_filiales',

        // Construcción por GP
        'gp_construye',
        'superficie_construir',
        'incluye_estacionamiento',
        'servicio_agua',
        'administra_agua',
        'servicio_electricidad',
        'preparacion_electrica',
        'fecha_entrega_inmueble',
        'entrega_parcial',
        'terminacion_por_no_entrega',
        'licencias_a_cargo',
        'construccion_totem',
        'posicion_rotulo',

        // Obligaciones
        'entrega_planos',
        'fecha_entrega_planos',
    ];

    protected $casts = [
        // Fechas
        'fecha' => 'date',
        'fecha_firma' => 'date',
        'fecha_inicio_indexacion' => 'date',
        'fecha_inicio_gracia' => 'date',
        'inicio_vigencia' => 'date',
        'fecha_entrega_posesion' => 'date',
        'fecha_entrega_licencias' => 'date',
        'fecha_entrega_inmueble' => 'date',
        'fecha_entrega_planos' => 'date',

        // Numéricos
        'superficie_terreno' => 'float',
        'superficie_construccion' => 'float',
        'renta_m2' => 'float',
        'renta_mensual' => 'float',
        'renta_porcentaje' => 'float',
        'vigencia_contrato_anios' => 'float',
        'plazo_forzoso_arrendador' => 'float',
        'plazo_forzoso_arrendataria' => 'float',
        'prorroga_vigencia' => 'float',
        'cantidad_deposito' => 'float',
        'cantidad_renta_anticipada' => 'float',
        'tasa_moratoria' => 'float',
        'superficie_construir' => 'float',

        // Booleanos
        'renta_mensual_iva' => 'boolean',
        'porcentaje_incluye_ecommerce' => 'boolean',
        'riesgo_no_pago' => 'boolean',
        'riesgo_distancia' => 'boolean',
        'riesgo_olores' => 'boolean',
        'riesgo_trafico' => 'boolean',
        'riesgo_residuos' => 'boolean',
        'remediacion_suelo' => 'boolean',
        'riesgo_contaminacion' => 'boolean',
        'seguro_obligatorio' => 'boolean',
        'disminucion_renta' => 'boolean',
        'giros_prohibidos' => 'boolean',
        'exclusividad_giros' => 'boolean',
        'incumple_exclusivos' => 'boolean',
        'gp_autoriza_layout' => 'boolean',
        'gp_puede_cancelar' => 'boolean',
        'subarrendamiento_libre' => 'boolean',
        'subarrendamiento_filiales' => 'boolean',
        'derecho_preferencia' => 'boolean',
        'preferencia_filiales' => 'boolean',
        'aviso_filiales' => 'boolean',
        'gp_construye' => 'boolean',
        'incluye_estacionamiento' => 'boolean',
        'servicio_agua' => 'boolean',
        'administra_agua' => 'boolean',
        'servicio_electricidad' => 'boolean',
        'preparacion_electrica' => 'boolean',
        'entrega_parcial' => 'boolean',
        'terminacion_por_no_entrega' => 'boolean',
        'construccion_totem' => 'boolean',
        'entrega_planos' => 'boolean',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
