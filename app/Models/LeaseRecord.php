<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class LeaseRecord extends Model
{
    protected $table = 'lease_records';

    protected $fillable = [
        'project_id',

        // Generales
        'lessor',
        'rent_assignment',
        'client_legal_name',
        'trade_name',
        'subdivision',
        'cadastral_file',
        'project_name',
        'location',

        // Contract data
        'enkontrol_contract_number',
        'contract_sign_date',
        'contract_term_years',
        'grace_period_months',
        'property_delivery_date',
        'grace_period_start_date',
        'grace_period_end_date',
        'opening_date',

        // Lease detail
        'first_invoice_month',
        'leased_area_m2',
        'rent_mechanism',
        'rent_update_month',
        'incp_month',
        'total_rent_without_vat',
        'vat_16_percent',
        'total_rent_with_vat',
        'rent_type',
        'staggered_rent',
        'price_per_m2',
        'annual_update_from',
        'increase_mechanism',
        'update_factor',
        'updated_rent_to_invoice_without_vat',
        'updated_vat_16_percent',
        'updated_rent_to_invoice_with_vat',

        // Security deposit update
        'updated_security_deposit_amount',
        'deposit_update_increase',
        'security_deposit_date',
    ];

    protected $casts = [
        'contract_sign_date' => 'date',
        'property_delivery_date' => 'date',
        'grace_period_start_date' => 'date',
        'grace_period_end_date' => 'date',
        'opening_date' => 'date',
        'first_invoice_month' => 'date',
        'security_deposit_date' => 'date',

        'leased_area_m2' => 'float',
        'total_rent_without_vat' => 'float',
        'vat_16_percent' => 'float',
        'total_rent_with_vat' => 'float',
        'price_per_m2' => 'float',
        'updated_security_deposit_amount' => 'float',
        'deposit_update_increase' => 'float',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function details()
    {
        return $this->hasMany(LeaseRecordDetail::class);
    }

}
