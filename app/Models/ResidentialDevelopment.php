<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\State;
use App\Models\Municipality;

class ResidentialDevelopment extends Model
{
    protected $fillable = [
        'description',
        'short_name',
        'state_id',
        'municipality_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
