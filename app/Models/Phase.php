<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estatus;

class Phase extends Model
{
    protected $fillable = ['description'];

    public function estatuses()
    {
        return $this->hasMany(Estatus::class, 'phaseId');
    }
}
