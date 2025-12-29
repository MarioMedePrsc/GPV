<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;


class ContractRequest extends Model
{
    protected $table = 'contract_requests';

    protected $fillable = [
        'project_id',
        'commercial_activity',
        'request_date',

        'pm_constitutive_act',
        'pm_legal_power',
        'pm_official_id',
        'pm_address_proof',
        'pm_rfc',
        'pm_bank_statement',
        'pm_other',

        'pf_official_id',
        'pf_address_proof',
        'pf_rfc',
        'pf_bank_statement',
        'pf_other',

        'contact_name',
        'email',
        'phone',

        'guarantee_type',
        'solidary_obligor_name',
        'property_deed',
        'guarantee_address',
        'guarantee_official_id',
        'guarantee_address_proof',
        'guarantee_property_deed',

        'property_owners',
        'pactum_commissorium',
        'rent_assignment_fimsa',

        'leased_property',
        'purchase_deed',
        'cadastral_file',
        'total_area',
        'leased_area',
        'property_address',

        'first_contract',
        'renewal',
        'monthly_rent',
        'previous_rent',
        'price_per_m2',
        'increase_percentage',
        'price_list_reference',
        'maintenance_fee',
        'meets_minimum_authorized',

        'term',
        'extension',
        'automatic_extension',
        'mandatory_term',
        'tenant_mandatory_term',
        'annual_increase',
        'increase_from',
        'additional_increase',
        'increase_when',

        'contract_signing_date',
        'security_deposit_months',
        'advance_rent_months',
        'rent_payment_start',
        'grace_period_months',
        'meets_pg_table',
        'pg_start_when',

        'delivery_act_required',
        'proportional_property_tax',
        'right_of_first_refusal',
    ];

    protected $casts = [
        'property_owners' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}

