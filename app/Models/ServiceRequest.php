<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequest extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = ['client_name', 'client_phone', 'client_email', 'vehicle_model_id', 'status', 'description'];

    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function scopeWhereFilters($query, array $searchFilters)
    {
        $filters = collect($searchFilters);

        $query->when($filters->get('search'), function ($query, $search) {
            $query->whereSearch($search);
        });
    }

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $item) {
            $query->where(function ($query) use ($item) {
                $query->where('client_name', 'like', '%' . $item . '%');
            });
        }
    }
}
