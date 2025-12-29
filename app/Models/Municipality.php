<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;

class Municipality extends Model
{
    protected $fillable = [
        'state_id',
        'clave_municipio',
        'descripcion',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
