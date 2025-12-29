<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Phase;
use App\Models\Estatus;
use App\Models\Property;
use App\Models\ContractRequest;


class Project extends Model
{
    protected $fillable = [
        'description',
        'shortName',
        'clientId',
        'phaseId',
        'estatusId',
        'area',
        'rentalPrice',
        'rentalAreaProposed',
        'monthlyRental',
        'notes',
        'userId',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'clientId');
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class, 'phaseId');
    }

    public function estatus()
    {
        return $this->belongsTo(Estatus::class, 'estatusId');
    }

    public function properties()
    {
        return $this->belongsToMany(
            Property::class,
            'project_properties',
            'project_id',
            'property_id'
        )->withTimestamps();
    }

    protected static function booted()
    {
        static::saved(function ($project) {
            $area = $project->properties()->sum('area');
            $project->updateQuietly(['area' => $area]);
        });
    }
    public function contractRequests()
    {
        return $this->hasMany(ContractRequest::class, 'project_id');
    }


}
