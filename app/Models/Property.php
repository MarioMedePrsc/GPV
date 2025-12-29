<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PropertyType;
use App\Models\State;
use App\Models\Municipality;
use App\Models\ResidentialDevelopment;
use App\Models\PropertyTax;

class Property extends Model
{
    protected $fillable = [
        'estatusId',
        'propertyEstatusId',
        'propertyTypeId',
        'municipalityId',
        'stateId',
        'residentialDevelopmentId',
        'propertyRecordNumber',
        'ownerCompanyId',
        'taxPayerCompanyId',
        'address',
        'area',
        'builtArea',
        'block',
        'lot',
        'dynamic_data',
    ];

    protected $casts = [
        'dynamic_data' => 'array',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'propertyTypeId');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'stateId');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipalityId');
    }
    public function residentialDevelopment()
    {
        return $this->belongsTo(ResidentialDevelopment::class, 'residentialDevelopmentId');
    }

    public function propertyTaxes()
    {
        return $this->hasMany(PropertyTax::class, 'propertyRecordNumber');
    }

    public function projects()
    {
        return $this->belongsToMany(
            Project::class,
            'project_properties',
            'property_id',
            'project_id'
        )->withTimestamps();
    }
}
