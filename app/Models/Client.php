<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\ClientType;

class Client extends Model
{
    protected $fillable = [
        'brandId',
        'clientTypeId',
        'description',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandId');
    }

    public function clientType()
    {
        return $this->belongsTo(ClientType::class, 'clientTypeId');
    }
}
