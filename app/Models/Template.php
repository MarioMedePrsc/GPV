<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['name','label'];

    public function fields()
    {
        return $this->hasMany(DynamicField::class);
    }
}

