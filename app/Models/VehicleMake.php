<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleMake extends Model
{
  protected $guarded = ['id'];

  public function vehicleModels()
  {
    return $this->hasMany(VehicleModel::class);
  }
}
