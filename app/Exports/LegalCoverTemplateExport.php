<?php

namespace App\Exports;

use App\Models\LegalCover;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LegalCoverTemplateExport
{
    public static function download(LegalCover $legalCover)
    {
        $templatePath = storage_path('app/templates/legal_cover_template.xlsx');

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        /*
        |--------------------------------------------------------------------------
        | Generales
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B2', $legalCover->fecha);
        $sheet->setCellValue('B3', $legalCover->nombre_contrato);
        $sheet->setCellValue('B4', $legalCover->finalidad);

        /*
        |--------------------------------------------------------------------------
        | Carátula contrato
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B6', $legalCover->fecha_firma);
        $sheet->setCellValue('B7', $legalCover->arrendadora);
        $sheet->setCellValue('B8', $legalCover->arrendataria);
        $sheet->setCellValue('B9', $legalCover->obligado_solidario);
        $sheet->setCellValue('B10', $legalCover->cesionario_renta);

        /*
        |--------------------------------------------------------------------------
        | Condiciones
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B12', $legalCover->objeto);
        $sheet->setCellValue('B13', $legalCover->expediente_catastral);
        $sheet->setCellValue('B14', $legalCover->fraccionamiento);
        $sheet->setCellValue('B15', $legalCover->municipio);
        $sheet->setCellValue('B16', $legalCover->estado);
        $sheet->setCellValue('B17', $legalCover->superficie_terreno);
        $sheet->setCellValue('B18', $legalCover->superficie_construccion);
        $sheet->setCellValue('B19', $legalCover->renta_m2);
        $sheet->setCellValue('B20', $legalCover->renta_mensual);
        $sheet->setCellValue('B21', $legalCover->renta_mensual_iva ? 'Sí' : 'No');
        $sheet->setCellValue('B22', $legalCover->renta_porcentaje);
        $sheet->setCellValue('B23', $legalCover->porcentaje_incluye_ecommerce ? 'Sí' : 'No');
        $sheet->setCellValue('B24', $legalCover->indexacion);
        $sheet->setCellValue('B25', $legalCover->fecha_inicio_indexacion);
        $sheet->setCellValue('B26', $legalCover->periodo_gracia_meses);
        $sheet->setCellValue('B27', $legalCover->inicio_periodo_gracia);
        $sheet->setCellValue('B28', $legalCover->fecha_inicio_gracia);
        $sheet->setCellValue('B29', $legalCover->vigencia_contrato_anios);
        $sheet->setCellValue('B30', $legalCover->inicio_vigencia);
        $sheet->setCellValue('B31', $legalCover->plazo_forzoso_arrendador);
        $sheet->setCellValue('B32', $legalCover->plazo_forzoso_arrendataria);
        $sheet->setCellValue('B33', $legalCover->prorroga_vigencia);
        $sheet->setCellValue('B34', $legalCover->tipo_prorroga);
        $sheet->setCellValue('B35', $legalCover->plazo_solicitud_prorroga_dias);
        $sheet->setCellValue('B36', $legalCover->incremento_renta_prorroga);
        $sheet->setCellValue('B37', $legalCover->riesgo_no_pago ? 'Sí' : 'No');
        $sheet->setCellValue('B38', $legalCover->fecha_entrega_posesion);
        $sheet->setCellValue('B39', $legalCover->responsable_licencias);
        $sheet->setCellValue('B40', $legalCover->fecha_entrega_licencias);
        $sheet->setCellValue('B41', $legalCover->mantenimiento);
        $sheet->setCellValue('B42', $legalCover->indexacion_mantenimiento);

        /*
        |--------------------------------------------------------------------------
        | Contención de riesgos económicos
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B44', $legalCover->deposito_meses);
        $sheet->setCellValue('B45', $legalCover->cantidad_deposito);
        $sheet->setCellValue('B46', $legalCover->actualizacion_deposito);
        $sheet->setCellValue('B47', $legalCover->renta_anticipada_meses);
        $sheet->setCellValue('B48', $legalCover->cantidad_renta_anticipada);
        $sheet->setCellValue('B49', $legalCover->tasa_moratoria);

        /*
        |--------------------------------------------------------------------------
        | Mitigación de riesgos
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B51', $legalCover->giro_negocio);
        $sheet->setCellValue('B52', $legalCover->riesgo_distancia ? 'Sí' : 'No');
        $sheet->setCellValue('B53', $legalCover->distancia_vivienda);
        $sheet->setCellValue('B54', $legalCover->riesgo_olores ? 'Sí' : 'No');
        $sheet->setCellValue('B55', $legalCover->visto_bueno_ventas);
        $sheet->setCellValue('B56', $legalCover->riesgo_trafico ? 'Sí' : 'No');
        $sheet->setCellValue('B57', $legalCover->visto_bueno_proyectos);
        $sheet->setCellValue('B58', $legalCover->riesgo_residuos ? 'Sí' : 'No');
        $sheet->setCellValue('B59', $legalCover->remediacion_suelo ? 'Sí' : 'No');
        $sheet->setCellValue('B60', $legalCover->riesgo_contaminacion ? 'Sí' : 'No');
        $sheet->setCellValue('B61', $legalCover->seguro_obligatorio ? 'Sí' : 'No');
        $sheet->setCellValue('B62', $legalCover->disminucion_renta ? 'Sí' : 'No');
        $sheet->setCellValue('B63', $legalCover->supuesto_disminucion);
        $sheet->setCellValue('B64', $legalCover->giros_prohibidos ? 'Sí' : 'No');
        $sheet->setCellValue('B65', $legalCover->listado_giros_prohibidos);
        $sheet->setCellValue('B66', $legalCover->lotes_giros_prohibidos);
        $sheet->setCellValue('B67', $legalCover->exclusividad_giros ? 'Sí' : 'No');
        $sheet->setCellValue('B68', $legalCover->lotes_exclusividad);
        $sheet->setCellValue('B69', $legalCover->giros_exclusivos);
        $sheet->setCellValue('B70', $legalCover->incumple_exclusivos ? 'Sí' : 'No');
        $sheet->setCellValue('B71', $legalCover->estado_devolucion);

        /*
        |--------------------------------------------------------------------------
        | Contención de riesgos GP
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B73', $legalCover->gp_autoriza_layout ? 'Sí' : 'No');
        $sheet->setCellValue('B74', $legalCover->gp_puede_cancelar ? 'Sí' : 'No');
        $sheet->setCellValue('B75', $legalCover->supuesto_cancelacion_gp);
        $sheet->setCellValue('B76', $legalCover->plazo_cancelacion_gp_dias);
        $sheet->setCellValue('B77', $legalCover->subarrendamiento_libre ? 'Sí' : 'No');
        $sheet->setCellValue('B78', $legalCover->subarrendamiento_filiales ? 'Sí' : 'No');
        $sheet->setCellValue('B79', $legalCover->derecho_preferencia ? 'Sí' : 'No');
        $sheet->setCellValue('B80', $legalCover->plazo_respuesta_preferencia);
        $sheet->setCellValue('B81', $legalCover->preferencia_filiales ? 'Sí' : 'No');
        $sheet->setCellValue('B82', $legalCover->aviso_filiales ? 'Sí' : 'No');

        /*
        |--------------------------------------------------------------------------
        | Construcción por GP
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B84', $legalCover->gp_construye ? 'Sí' : 'No');
        $sheet->setCellValue('B85', $legalCover->superficie_construir);
        $sheet->setCellValue('B86', $legalCover->incluye_estacionamiento ? 'Sí' : 'No');
        $sheet->setCellValue('B87', $legalCover->servicio_agua ? 'Sí' : 'No');
        $sheet->setCellValue('B88', $legalCover->administra_agua ? 'Sí' : 'No');
        $sheet->setCellValue('B89', $legalCover->servicio_electricidad ? 'Sí' : 'No');
        $sheet->setCellValue('B90', $legalCover->preparacion_electrica ? 'Sí' : 'No');
        $sheet->setCellValue('B91', $legalCover->fecha_entrega_inmueble);
        $sheet->setCellValue('B92', $legalCover->entrega_parcial ? 'Sí' : 'No');
        $sheet->setCellValue('B93', $legalCover->terminacion_por_no_entrega ? 'Sí' : 'No');
        $sheet->setCellValue('B94', $legalCover->licencias_a_cargo);
        $sheet->setCellValue('B95', $legalCover->construccion_totem ? 'Sí' : 'No');
        $sheet->setCellValue('B96', $legalCover->posicion_rotulo);

        /*
        |--------------------------------------------------------------------------
        | Obligaciones arrendataria
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B98', $legalCover->entrega_planos ? 'Sí' : 'No');
        $sheet->setCellValue('B99', $legalCover->fecha_entrega_planos);

        // Guardar temporal
        $fileName = 'Caratula_Legal_'.$legalCover->id.'.xlsx';
        $tempPath = storage_path('app/temp/'.$fileName);

        if (!is_dir(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($tempPath);

        return response()->download($tempPath)->deleteFileAfterSend();
    }
}
