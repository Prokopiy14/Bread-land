<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentWorkload extends Model
{
    protected $fillable = [
        'equipment_id',
        'date_of_download',
        'working_hours',
    ];

    public $timestamps = false;
}
