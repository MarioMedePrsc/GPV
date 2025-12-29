<?php

namespace App\Exports;

use App\Models\LeaseRecord;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class LeaseRecordTemplateExport
{
    protected LeaseRecord $leaseRecord;

    public function __construct(LeaseRecord $leaseRecord)
    {
        $this->leaseRecord = $leaseRecord;
    }

    public function export(): string
    {
        $templatePath = storage_path('app/templates/lease_record_template.xlsx');

        /** @var Spreadsheet $spreadsheet */
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        /*
        |--------------------------------------------------------------------------
        | Generales
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B2', $this->leaseRecord->lessor);
        $sheet->setCellValue('B3', $this->leaseRecord->rent_assignment);
        $sheet->setCellValue('B4', $this->leaseRecord->client_legal_name);
        $sheet->setCellValue('B5', $this->leaseRecord->trade_name);
        $sheet->setCellValue('B6', $this->leaseRecord->subdivision);
        $sheet->setCellValue('B7', $this->leaseRecord->cadastral_file);
        $sheet->setCellValue('B8', $this->leaseRecord->project_name);
        $sheet->setCellValue('B9', $this->leaseRecord->location);

        /*
        |--------------------------------------------------------------------------
        | Datos del contrato
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B12', $this->leaseRecord->enkontrol_contract_number);
        $sheet->setCellValue('B13', optional($this->leaseRecord->contract_sign_date)?->format('Y-m-d'));
        $sheet->setCellValue('B14', $this->leaseRecord->contract_term_years);
        $sheet->setCellValue('B15', $this->leaseRecord->grace_period_months);
        $sheet->setCellValue('B16', optional($this->leaseRecord->property_delivery_date)?->format('Y-m-d'));
        $sheet->setCellValue('B17', optional($this->leaseRecord->grace_period_start_date)?->format('Y-m-d'));
        $sheet->setCellValue('B18', optional($this->leaseRecord->grace_period_end_date)?->format('Y-m-d'));
        $sheet->setCellValue('B19', optional($this->leaseRecord->opening_date)?->format('Y-m-d'));

        /*
        |--------------------------------------------------------------------------
        | Detalle de arrendamiento
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B22', optional($this->leaseRecord->first_invoice_month)?->format('Y-m-d'));
        $sheet->setCellValue('B23', $this->leaseRecord->leased_area_m2);
        $sheet->setCellValue('B24', $this->leaseRecord->rent_mechanism);
        $sheet->setCellValue('B25', $this->leaseRecord->rent_update_month);
        $sheet->setCellValue('B26', $this->leaseRecord->incp_month);
        $sheet->setCellValue('B27', $this->leaseRecord->total_rent_without_vat);
        $sheet->setCellValue('B28', $this->leaseRecord->vat_16_percent);
        $sheet->setCellValue('B29', $this->leaseRecord->total_rent_with_vat);
        $sheet->setCellValue('B30', $this->leaseRecord->rent_type);
        $sheet->setCellValue('B31', $this->leaseRecord->staggered_rent);
        $sheet->setCellValue('B32', $this->leaseRecord->price_per_m2);
        $sheet->setCellValue('B33', $this->leaseRecord->annual_update_from);
        $sheet->setCellValue('B34', $this->leaseRecord->increase_mechanism);
        $sheet->setCellValue('B35', $this->leaseRecord->update_factor);
        $sheet->setCellValue('B36', $this->leaseRecord->updated_rent_to_invoice_without_vat);
        $sheet->setCellValue('B37', $this->leaseRecord->updated_vat_16_percent);
        $sheet->setCellValue('B38', $this->leaseRecord->updated_rent_to_invoice_with_vat);

        /*
        |--------------------------------------------------------------------------
        | Actualización de depósito en garantía (sin IVA)
        |--------------------------------------------------------------------------
        */
        $sheet->setCellValue('B41', $this->leaseRecord->updated_security_deposit_amount);
        $sheet->setCellValue('B42', $this->leaseRecord->deposit_update_increase);
        $sheet->setCellValue('B43', optional($this->leaseRecord->security_deposit_date)?->format('Y-m-d'));

        /*
        |--------------------------------------------------------------------------
        | Guardar archivo temporal
        |--------------------------------------------------------------------------
        */
        $fileName = 'lease_record_' . $this->leaseRecord->id . '.xlsx';
        $tempPath = storage_path('app/temp/' . $fileName);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($tempPath);

        return $tempPath;
    }
}
