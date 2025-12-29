<?php

namespace App\Exports;

use App\Models\ContractRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContractRequestsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return ContractRequest::with(['project.client'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Proyecto',
            'Arrendatario',
            'Giro Comercial',
            'Fecha Solicitud',

            'Acta Constitutiva',
            'Poder Rep. Legal',
            'ID Oficial (PM)',
            'Comprobante Domicilio (PM)',
            'RFC (PM)',
            'Estado Cuenta (PM)',
            'Otro (PM)',

            'ID Oficial (PF)',
            'Comprobante Domicilio (PF)',
            'RFC (PF)',
            'Estado Cuenta (PF)',
            'Otro (PF)',

            'Contacto',
            'Correo',
            'Teléfono',

            'Tipo Garantía',
            'Obligado Solidario',
            'Pacto Comisorio',
            'Cesión Renta FIMSA',

            'Inmueble a Arrendar',
            'Superficie Total',
            'Superficie Arrendada',

            'Primer Contrato',
            'Renovación',
            'Renta Mensual',
            'Renta Anterior',
            'Precio m²',
            'Incremento %',
            'Referencia Lista Precios',
            'Cuota de Mantenimiento',
            'Cumple Mínimo',

            'Vigencia',
            'Prórroga',
            'Automática',

            'Fecha Firma',
            'Depósito (meses)',
            'Renta Anticipada (meses)',

            'Derecho Preferencia',
        ];
    }

    public function map($r): array
    {
        return [
            $r->id,
            optional($r->project)->description,
            optional($r->project?->client)->description,
            $r->commercial_activity,
            $r->request_date,

            $r->pm_constitutive_act,
            $r->pm_legal_power,
            $r->pm_official_id,
            $r->pm_address_proof,
            $r->pm_rfc,
            $r->pm_bank_statement,
            $r->pm_other,

            $r->pf_official_id,
            $r->pf_address_proof,
            $r->pf_rfc,
            $r->pf_bank_statement,
            $r->pf_other,

            $r->contact_name,
            $r->email,
            $r->phone,

            $r->guarantee_type,
            $r->solidary_obligor_name,
            $r->pactum_commissorium,
            $r->rent_assignment_fimsa,

            $r->leased_property,
            $r->total_area,
            $r->leased_area,

            $r->first_contract,
            $r->renewal,
            $r->monthly_rent,
            $r->previous_rent,
            $r->price_per_m2,
            $r->increase_percentage,
            $r->price_list_reference,
            $r->maintenance_fee,
            $r->meets_minimum_authorized,

            $r->term,
            $r->extension,
            $r->automatic_extension,

            $r->contract_signing_date,
            $r->security_deposit_months,
            $r->advance_rent_months,

            $r->right_of_first_refusal,
        ];
    }
}
