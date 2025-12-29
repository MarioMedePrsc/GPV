<?php

namespace App\Exports;

use App\Models\ContractRequest;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ContractRequestTemplateExport
{
    public static function download(ContractRequest $cr)
    {
        $templatePath = storage_path('app/templates/contract_request_template.xlsx');

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // =====================
        // DATOS GENERALES
        // =====================
        $sheet->setCellValue('B5', $cr->project?->client?->description);
        $sheet->setCellValue('B6', $cr->project?->description);
        $sheet->setCellValue('B7', $cr->commercial_activity);
        $sheet->setCellValue('B8', optional($cr->request_date)->format('d/m/Y'));

        // =====================
        // PERSONA MORAL
        // =====================
        $sheet->setCellValue('D12', $cr->pm_constitutive_act ? 'X' : '');
        $sheet->setCellValue('D13', $cr->pm_legal_power ? 'X' : '');
        $sheet->setCellValue('D14', $cr->pm_official_id ? 'X' : '');
        $sheet->setCellValue('D15', $cr->pm_address_proof ? 'X' : '');
        $sheet->setCellValue('D16', $cr->pm_rfc ? 'X' : '');
        $sheet->setCellValue('D17', $cr->pm_bank_statement ? 'X' : '');
        $sheet->setCellValue('D18', $cr->pm_other ? 'X' : '');

        // =====================
        // PERSONA FÍSICA
        // =====================
        $sheet->setCellValue('G12', $cr->pf_official_id ? 'X' : '');
        $sheet->setCellValue('G13', $cr->pf_address_proof ? 'X' : '');
        $sheet->setCellValue('G14', $cr->pf_rfc ? 'X' : '');
        $sheet->setCellValue('G15', $cr->pf_bank_statement ? 'X' : '');
        $sheet->setCellValue('G16', $cr->pf_other ? 'X' : '');

        // =====================
        // CONTACTO
        // =====================
        $sheet->setCellValue('B22', $cr->contact_name);
        $sheet->setCellValue('B23', $cr->email);
        $sheet->setCellValue('B24', $cr->phone);

        // =====================
        // GUARANTÍAS
        // =====================
        $sheet->setCellValue('B27', $cr->guarantee_type);
        $sheet->setCellValue('B28', $cr->solidary_obligor_name);

        // =====================
        // INMUEBLE
        // =====================
        $sheet->setCellValue('B35', $cr->leased_property);
        $sheet->setCellValue('B36', $cr->total_area);
        $sheet->setCellValue('B37', $cr->leased_area);
        $sheet->setCellValue('B38', $cr->property_address);

        // =====================
        // CONDICIONES ECONÓMICAS
        // =====================
        $sheet->setCellValue('B42', $cr->monthly_rent);
        $sheet->setCellValue('B43', $cr->maintenance_fee);
        $sheet->setCellValue('B44', $cr->price_per_m2);

        // Guardar temporal
        $fileName = 'Solicitud_Contrato_'.$cr->id.'.xlsx';
        $tempPath = storage_path('app/temp/'.$fileName);

        if (!is_dir(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($tempPath);

        return response()->download($tempPath)->deleteFileAfterSend();
    }
}
