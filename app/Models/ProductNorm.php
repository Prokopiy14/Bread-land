<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductNorm extends Model
{
    protected $fillable = [
        'product_id',
        'equipment_id',
        'norm',
    ];
}
