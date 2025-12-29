<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LeaseRecord;

class LeaseRecordDetail extends Model
{
    protected $table = 'lease_records_details';

    protected $fillable = [
        'lease_record_id',
        'num',
        'year',
        'month',
        'factor',
        'increment',
        'updated_rent',
        'charge_percentage',
        'rent_to_charge',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'factor' => 'float',
        'increment' => 'float',
        'updated_rent' => 'float',
        'charge_percentage' => 'float',
        'rent_to_charge' => 'float',
    ];

    public function leaseRecord()
    {
        return $this->belongsTo(LeaseRecord::class);
    }
}
