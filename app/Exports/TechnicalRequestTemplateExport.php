<?php

namespace App\Exports;

use App\Models\TechnicalRequest;
use PhpOffice\PhpSpreadsheet\IOFactory;

class TechnicalRequestTemplateExport
{
    public static function download(TechnicalRequest $tr)
    {
        // Ruta de la plantilla
        $templatePath = storage_path('app/templates/technical_request_template.xlsx');

        // Cargar plantilla
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        /*
        |--------------------------------------------------------------------------
        | DATOS GENERALES
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B4', $tr->project?->description);
        $sheet->setCellValue('B5', $tr->land_status);
        $sheet->setCellValue('B6', $tr->consideration);
        $sheet->setCellValue('B7', $tr->paid_7_percent ? 'SI' : 'NO');
        $sheet->setCellValue('B8', $tr->paid_7_percent_time);

        /*
        |--------------------------------------------------------------------------
        | ELECTRICIDAD
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B11', $tr->electric_infrastructure ? 'SI' : 'NO');
        $sheet->setCellValue('B12', $tr->electric_time);

        /*
        |--------------------------------------------------------------------------
        | AGUA Y DRENAJE
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B15', $tr->water_infrastructure ? 'SI' : 'NO');
        $sheet->setCellValue('B16', $tr->ayd_incorporation_paid ? 'SI' : 'NO');
        $sheet->setCellValue('B17', $tr->ayd_contribution_paid ? 'SI' : 'NO');
        $sheet->setCellValue('B18', $tr->need_feasibility ? 'SI' : 'NO');
        $sheet->setCellValue('B19', $tr->feasibility_time);

        /*
        |--------------------------------------------------------------------------
        | GESTIONES REQUERIDAS
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B22', $tr->glg ? 'X' : '');
        $sheet->setCellValue('C22', $tr->glg_time);

        $sheet->setCellValue('B23', $tr->road_alignment ? 'X' : '');
        $sheet->setCellValue('C23', $tr->road_alignment_time);

        $sheet->setCellValue('B24', $tr->staking ? 'X' : '');
        $sheet->setCellValue('C24', $tr->staking_time);

        $sheet->setCellValue('B25', $tr->licenses ? 'X' : '');
        $sheet->setCellValue('C25', $tr->licenses_time);

        $sheet->setCellValue('B26', $tr->fusion ? 'X' : '');
        $sheet->setCellValue('C26', $tr->fusion_time);

        $sheet->setCellValue('B27', $tr->subdivision ? 'X' : '');
        $sheet->setCellValue('C27', $tr->subdivision_time);

        $sheet->setCellValue('B28', $tr->land_use ? 'X' : '');
        $sheet->setCellValue('C28', $tr->land_use_time);

        $sheet->setCellValue('B29', $tr->environmental_studies ? 'X' : '');
        $sheet->setCellValue('C29', $tr->environmental_studies_time);

        /*
        |--------------------------------------------------------------------------
        | NOTAS Y OBRAS
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B32', $tr->notes);
        $sheet->setCellValue('B33', $tr->additional_works);

        /*
        |--------------------------------------------------------------------------
        | ANEXOS TÉCNICOS
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B36', $tr->leased_polygon ? 'X' : '');
        $sheet->setCellValue('B37', $tr->prohibited_uses ? 'X' : '');
        $sheet->setCellValue('B38', $tr->restrictions ? 'X' : '');
        $sheet->setCellValue('B39', $tr->work_obligations ? 'X' : '');
        $sheet->setCellValue('B40', $tr->site_plan ? 'X' : '');
        $sheet->setCellValue('B41', $tr->property_detail ? 'X' : '');
        $sheet->setCellValue('B42', $tr->other_attachment ? 'X' : '');

        /*
        |--------------------------------------------------------------------------
        | ASPECTOS ADMINISTRATIVOS
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('E4', $tr->client_identifier);
        $sheet->setCellValue('E5', $tr->billing_name);
        $sheet->setCellValue('E6', $tr->rfc);
        $sheet->setCellValue('E7', $tr->tax_address);
        $sheet->setCellValue('E8', $tr->business_activity);
        $sheet->setCellValue('E9', $tr->trade_name);

        $sheet->setCellValue('E10', $tr->bank_key);
        $sheet->setCellValue('E11', $tr->bank);
        $sheet->setCellValue('E12', $tr->rent_payment_account);

        $sheet->setCellValue('E13', $tr->estimated_signature_date);
        $sheet->setCellValue('E14', $tr->grace_period_months);
        $sheet->setCellValue('E15', $tr->advance_rent_months);
        $sheet->setCellValue('E16', $tr->advance_rent_amount);
        $sheet->setCellValue('E17', $tr->rent_start_date);
        $sheet->setCellValue('E18', $tr->deposit_months);
        $sheet->setCellValue('E19', $tr->deposit_amount);

        /*
        |--------------------------------------------------------------------------
        | EXCEPCIÓN COMERCIAL
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('E21', $tr->commercial_exception);

        /*
        |--------------------------------------------------------------------------
        | DATOS DE CONTACTO
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('E24', $tr->contact_name);
        $sheet->setCellValue('E25', $tr->contact_email);
        $sheet->setCellValue('E26', $tr->contact_phone);
        $sheet->setCellValue('E27', $tr->internal_lead ? 'SI' : 'NO');
        $sheet->setCellValue('E28', $tr->broker_operation ? 'SI' : 'NO');
        $sheet->setCellValue('E29', $tr->commission_conditions);

        /*
        |--------------------------------------------------------------------------
        | GUARDAR Y DESCARGAR
        |--------------------------------------------------------------------------
        */
        $fileName = 'Solicitud_Tecnica_'.$tr->id.'.xlsx';
        $tempPath = storage_path('app/temp/'.$fileName);

        if (!is_dir(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($tempPath);

        return response()->download($tempPath)->deleteFileAfterSend();
    }
}
