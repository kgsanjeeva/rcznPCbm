<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $guarded = ['id'];

    public function vehicleMake()
    {
      return $this->belongsTo(VehicleMake::class);
    }
}
