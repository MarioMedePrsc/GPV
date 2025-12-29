<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicField extends Model
{
    protected $fillable = [
        'template_id',
        'name',
        'label',
        'type',
        'options',
        'required',
    ];

    protected $casts = [
        'options' => 'array',
        'required' => 'boolean',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}

