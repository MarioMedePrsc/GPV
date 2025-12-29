<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTax extends Model
{
    protected $table = 'propertytax';

    protected $fillable = [
        'propertyRecordNumber',
        'propertyTaxEstatusId',
        'verifiedUserId',
        'taxYear',
        'cadastralValue',
        'cadastralValuePerArea',
        'cadastralValuePerBuiltArea',
        'receiptFileUrl',
        'taxAmount',
        'penalties',
        'otherCharges',
        'charges',
        'discount',
        'bonuses',
        'others',
        'totalTax',
        'netPayable',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'propertyRecordNumber');
    }
}
