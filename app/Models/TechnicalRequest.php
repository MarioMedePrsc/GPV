<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class TechnicalRequest extends Model
{
    protected $fillable = [
        'project_id',
        'land_status',
        'consideration',
        'paid_7_percent',
        'paid_7_percent_time',

        'electric_infrastructure',
        'electric_time',

        'water_infrastructure',
        'ayd_incorporation_paid',
        'ayd_contribution_paid',
        'ayd_feasibility_required',
        'ayd_feasibility_time',

        'glg','glg_time',
        'road_alignment','road_alignment_time',
        'land_marking','land_marking_time',
        'licenses','licenses_time',
        'fusion','fusion_time',
        'subdivision','subdivision_time',
        'land_use','land_use_time',
        'environmental_studies','environmental_studies_time',

        'notes',
        'additional_works',

        'leased_polygon',
        'prohibited_uses',
        'restrictions',
        'work_obligations',
        'site_plan',
        'property_detail',
        'other_attachment',

        'client_identifier',
        'billing_name',
        'rfc',
        'fiscal_address',
        'business_activity',
        'trade_name',
        'bank_key',
        'bank',
        'rent_payment_account',

        'estimated_signing_date',
        'grace_period_months',
        'advance_rent_months',
        'advance_rent_amount',
        'rent_start_date',
        'deposit_months',
        'deposit_amount',
        'commercial_exception',

        'contact_name',
        'contact_email',
        'contact_phone',
        'internal_lead',
        'broker_operation',
        'commission_conditions',
    ];

    protected $casts = [
        'paid_7_percent' => 'boolean',
        'electric_infrastructure' => 'boolean',
        'water_infrastructure' => 'boolean',
        'ayd_incorporation_paid' => 'boolean',
        'ayd_contribution_paid' => 'boolean',
        'ayd_feasibility_required' => 'boolean',

        'glg' => 'boolean',
        'road_alignment' => 'boolean',
        'land_marking' => 'boolean',
        'licenses' => 'boolean',
        'fusion' => 'boolean',
        'subdivision' => 'boolean',
        'land_use' => 'boolean',
        'environmental_studies' => 'boolean',

        'leased_polygon' => 'boolean',
        'prohibited_uses' => 'boolean',
        'restrictions' => 'boolean',
        'work_obligations' => 'boolean',
        'site_plan' => 'boolean',
        'property_detail' => 'boolean',
        'other_attachment' => 'boolean',

        'internal_lead' => 'boolean',
        'broker_operation' => 'boolean',

        'estimated_signing_date' => 'date',
        'rent_start_date' => 'date',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
