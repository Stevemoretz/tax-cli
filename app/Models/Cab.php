<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cab
 *
 * @property-read \App\Models\Driver|null $driver
 * @property-read \App\Models\CarModel|null $model_id
 * @method static \Illuminate\Database\Eloquent\Builder|Cab newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cab newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cab query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $manufacturer_name
 * @property string $license_plate
 * @method static \Illuminate\Database\Eloquent\Builder|Cab whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cab whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cab whereLicensePlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cab whereManufacturerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cab whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cab whereUpdatedAt($value)
 */
class Cab extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function driver(){
        return $this->hasMany(Driver::class);
    }

    public function model_id(){
        return $this->hasOne(CarModel::class);
    }
}
