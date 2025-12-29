<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Phase;

class Estatus extends Model
{
    protected $table = 'estatus';

    protected $fillable = ['phaseId', 'description'];

    public function phase()
    {
        return $this->belongsTo(Phase::class, 'phaseId');
    }
}
