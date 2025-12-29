<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Municipality;

class State extends Model
{
    protected $fillable = [
        'clave_estado',
        'abreviacion_estado',
        'descripcion',
    ];
    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
}
